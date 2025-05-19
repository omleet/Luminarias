<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;
use PDF;

class HistoryController extends Controller
{
    public function store(Request $request)
    {
        History::create([
            'light' => $request->light,
            'temperature' => $request->temperature,
            'led_state' => $request->led_state,
            'motion' => $request->motion,
            'humidity' => $request->humidity,
        ]);

        return response()->json(['message' => 'Saved']);
    }

    public function index()
    {
        $intervalSeconds = 15; // Intervalo de agregação em segundos

        $data = History::selectRaw("
    FLOOR(UNIX_TIMESTAMP(created_at)/?) as time_interval,
    AVG(light) as light,
    AVG(temperature) as temperature,
    MAX(CASE WHEN led_state = 'ON' THEN 1 ELSE 0 END) as led_state,
    MAX(motion) as motion,
    AVG(humidity) as humidity,
    MIN(created_at) as min_time,
    MAX(created_at) as max_time
    ", [$intervalSeconds])
            ->groupBy('time_interval')
            ->orderBy('time_interval', 'desc')
            ->take(50)
            ->get()
            ->map(function ($item) {
                $avgTimestamp = (strtotime($item->min_time) + strtotime($item->max_time)) / 2;

                return [
                    'light' => $item->light,
                    'temperature' => $item->temperature,
                    'led_state' => $item->led_state,
                    'motion' => $item->motion,
                    'humidity' => $item->humidity,
                    'display_date' => date('d/m/Y', $avgTimestamp),
                    'display_time' => date('H:i', $avgTimestamp),
                    'full_datetime' => date('d/m/Y H:i', $avgTimestamp),
                ];
            });

        return response()->json($data);
    }


    public function recentActivity(Request $request)
    {
        $perPage = 10; // Itens por página
        $page = $request->get('page', 1); // Página atual, padrão é 1

        // Busca os últimos 100 eventos ordenados por data
        $query = History::orderBy('created_at', 'desc')->take(100);

        // Pagina os resultados (10 por página)
        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        // Transforma os itens
        $activities = $paginator->getCollection()->map(function ($item) {
            $events = [];

            // Evento de LED
            if ($item->led_state === 'ON') {
                $events[] = [
                    'icon' => 'lightbulb',
                    'icon_color' => 'indigo',
                    'title' => 'LED ligado',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' .
                        ($item->motion ? 'Detecção de movimento' : 'Luminosidade baixa'),
                    'time' => $item->created_at->diffForHumans()
                ];
            } else if ($item->led_state === 'OFF') {
                $events[] = [
                    'icon' => 'lightbulb',
                    'icon_color' => 'gray',
                    'title' => 'LED desligado',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' .
                        'Luminosidade adequada',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            // Evento de movimento
            if ($item->motion) {
                $events[] = [
                    'icon' => 'walking',
                    'icon_color' => 'green',
                    'title' => 'Movimento detectado',
                    'description' => date('H:i', strtotime($item->created_at)),
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            // Evento de luminosidade
            if ($item->light < 150) {
                $events[] = [
                    'icon' => 'sun',
                    'icon_color' => 'blue',
                    'title' => 'Luminosidade baixa',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' . $item->light . ' lx',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            // Evento de temperatura
            if ($item->temperature > 25) {
                $events[] = [
                    'icon' => 'thermometer-half',
                    'icon_color' => 'red',
                    'title' => 'Temperatura alta',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' . $item->temperature . '°C',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            // Evento de humidade
            if ($item->humidity > 80) {
                $events[] = [
                    'icon' => 'tint',
                    'icon_color' => 'blue',
                    'title' => 'Humidade alta',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' . $item->humidity . '%',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            return $events;
        })
            ->flatten(1)
            ->take(10) // Garante no máximo 10 eventos por página
            ->values()
            ->all();

        return response()->json([
            'activities' => $activities,
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $perPage,
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'next_page_url' => $paginator->nextPageUrl(),
                'prev_page_url' => $paginator->previousPageUrl()
            ]
        ]);
    }

    public function reportData(Request $request)
    {
        $period = $request->input('period', '7d');
        $sensorType = $request->input('sensor', 'all');

        // Definir datas com base no período
        $endDate = now();
        switch ($period) {
            case '24h':
                $startDate = now()->subDay();
                break;
            case '7d':
                $startDate = now()->subDays(7);
                break;
            case '30d':
                $startDate = now()->subDays(30);
                break;
            case 'custom':
                $startDate = Carbon::parse($request->input('start_date'));
                $endDate = Carbon::parse($request->input('end_date'));
                break;
            default:
                $startDate = now()->subDays(7);
        }

        // Query base
        $query = History::whereBetween('created_at', [$startDate, $endDate]);

        // Filtrar por tipo de sensor se necessário
        if ($sensorType !== 'all') {
            $query->whereNotNull($sensorType);
        }

        // Agregar dados por hora/dia dependendo do período
        if ($period === '24h') {
            $groupBy = 'HOUR(created_at)';
            $dateFormat = 'H:i';
        } else {
            $groupBy = 'DATE(created_at)';
            $dateFormat = 'd/m/Y';
        }

        $data = $query->selectRaw("
        {$groupBy} as time_group,
        AVG(light) as light_avg,
        AVG(temperature) as temp_avg,
        AVG(humidity) as humidity_avg,
        SUM(motion) as motion_count,
        SUM(CASE WHEN led_state = 'ON' THEN 1 ELSE 0 END) as led_on_count,
        COUNT(*) as total_readings,
        MIN(created_at) as min_time,
        MAX(created_at) as max_time
    ")
            ->groupBy('time_group')
            ->orderBy('time_group')
            ->get()
            ->map(function ($item) use ($dateFormat) {
                return [
                    'time_label' => date($dateFormat, strtotime($item->min_time)),
                    'light' => round($item->light_avg, 2),
                    'temperature' => round($item->temp_avg, 2),
                    'humidity' => round($item->humidity_avg, 2),
                    'motion' => $item->motion_count,
                    'led_on' => $item->led_on_count,
                    'total_readings' => $item->total_readings
                ];
            });

        return response()->json($data);
    }

    public function eventHistory(Request $request)
    {
        $perPage = 10;
        $page = $request->get('page', 1);

        $query = History::orderBy('created_at', 'desc');

        // Aplicar filtros se existirem
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('led_state', 'like', '%' . $request->search . '%')
                    ->orWhere('motion', 'like', '%' . $request->search . '%');
            });
        }

        $histories = $query->paginate($perPage, ['*'], 'page', $page);

        $formattedData = $histories->map(function ($item) {
            $events = [];

            if ($item->led_state === 'ON') {
                $events[] = [
                    'type' => 'LED',
                    'icon' => 'lightbulb',
                    'icon_color' => 'indigo',
                    'details' => 'Luzes ligadas',
                    'value' => '-',
                    'time' => $item->created_at->format('d/m/Y H:i')
                ];
            }

            if ($item->motion) {
                $events[] = [
                    'type' => 'Movimento',
                    'icon' => 'walking',
                    'icon_color' => 'green',
                    'details' => 'Movimento detectado',
                    'value' => '-',
                    'time' => $item->created_at->format('d/m/Y H:i')
                ];
            }

            $events[] = [
                'type' => 'Luminosidade',
                'icon' => 'sun',
                'icon_color' => 'yellow',
                'details' => 'Leitura',
                'value' => $item->light . ' lx',
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            $events[] = [
                'type' => 'Temperatura',
                'icon' => 'thermometer-half',
                'icon_color' => 'red',
                'details' => 'Leitura',
                'value' => $item->temperature . '°C',
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            $events[] = [
                'type' => 'Humidade',
                'icon' => 'tint',
                'icon_color' => 'blue',
                'details' => 'Leitura',
                'value' => $item->humidity . '%',
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            return $events;
        })
            ->flatten(1)
            ->take($perPage);

        return response()->json([
            'data' => $formattedData,
            'pagination' => [
                'total' => $histories->total(),
                'per_page' => $histories->perPage(),
                'current_page' => $histories->currentPage(),
                'last_page' => $histories->lastPage()
            ]
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new HistoryExport, 'historico-sensores.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new HistoryExport, 'historico-sensores.csv');
    }

    public function exportPDF(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $query = History::orderBy('created_at', 'desc');

        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $validated['start_date']);
        }

        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $validated['end_date']);
        }

        // Limitar a 1000 registros no máximo
        $data = $query->take(369)->get();

        if ($data->count() === 369) {
            // Adicionar aviso no PDF que há mais dados disponíveis
            $warning = "Atenção: Mostrando apenas os primeiros 1000 registros. Use filtros mais específicos.";
        }

        $pdf = PDF::loadView('exports.history-pdf', [
            'data' => $data,
            'title' => 'Relatório de Sensores',
            'date' => now()->format('d/m/Y H:i'),
            'warning' => $warning ?? null,
            'filter_period' => $request->has('start_date')
                ? 'Período: ' . $validated['start_date'] . ' a ' . $validated['end_date']
                : 'Todos os registros'
        ]);

        return $pdf->download('relatorio-sensores.pdf');
    }
}
