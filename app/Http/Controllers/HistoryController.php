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

        // Busca os últimos 100 registos (em memória, como coleção)
        $histories = History::orderBy('created_at', 'desc')->take(100)->get();

        // Transforma os itens em eventos
        $allEvents = $histories->flatMap(function ($item) {
            $events = [];

            if ($item->led_state === 'ON') {
                $events[] = [
                    'icon' => 'lightbulb',
                    'icon_color' => 'indigo',
                    'title' => 'LED ligado',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' .
                        ($item->motion ? 'Detecção de movimento' : 'Luminosidade baixa'),
                    'time' => $item->created_at->diffForHumans()
                ];
            } elseif ($item->led_state === 'OFF') {
                $events[] = [
                    'icon' => 'lightbulb',
                    'icon_color' => 'gray',
                    'title' => 'LED desligado',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - Luminosidade adequada',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            if ($item->motion) {
                $events[] = [
                    'icon' => 'walking',
                    'icon_color' => 'green',
                    'title' => 'Movimento detectado',
                    'description' => date('H:i', strtotime($item->created_at)),
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            if ($item->light < 150) {
                $events[] = [
                    'icon' => 'sun',
                    'icon_color' => 'blue',
                    'title' => 'Luminosidade baixa',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' . $item->light . ' lx',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

            if ($item->temperature > 25) {
                $events[] = [
                    'icon' => 'thermometer-half',
                    'icon_color' => 'red',
                    'title' => 'Temperatura alta',
                    'description' => date('H:i', strtotime($item->created_at)) . ' - ' . $item->temperature . '°C',
                    'time' => $item->created_at->diffForHumans()
                ];
            }

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
        });

        // Paginação manual da coleção
        $total = $allEvents->count();
        $paginated = $allEvents->forPage($page, $perPage)->values();

        return response()->json([
            'activities' => $paginated,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => (int) $page,
                'last_page' => ceil($total / $perPage),
                'next_page_url' => $page < ceil($total / $perPage) ? url()->current() . '?page=' . ($page + 1) : null,
                'prev_page_url' => $page > 1 ? url()->current() . '?page=' . ($page - 1) : null
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
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = History::orderBy('created_at', 'desc');

        // Aplicar filtro de pesquisa
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('led_state', 'like', '%' . $search . '%')
                    ->orWhere('motion', 'like', '%' . $search . '%')
                    ->orWhere('light', 'like', '%' . $search . '%')
                    ->orWhere('temperature', 'like', '%' . $search . '%')
                    ->orWhere('humidity', 'like', '%' . $search . '%');
            });
        }

        // Pegar os últimos 250 registros (ou mais se necessário)
        $histories = $query->paginate($perPage, ['*'], 'page', $page);

        $formattedData = $histories->map(function ($item) {
            $events = [];

            // Evento LED
            $events[] = [
                'type' => 'LED',
                'details' => $item->led_state === 'ON' ? 'Luz ligada' : 'Luz desligada',
                'value' => $item->led_state ?? 'Dado inválido',
                
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            // Evento Movimento
            $events[] = [
                'type' => 'Movimento',
                'details' => $item->motion == '1' ? 'Movimento detectado' : 'Sem movimento',
                'value' => $item->motion == '1' ? 'Sim' : 'Não',
                
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            // Evento Luminosidade
            $events[] = [
                'type' => 'Luminosidade',
                'details' => 'Leitura de sensor',
                'value' => $item->light !== null ? round($item->light, 1) . ' lx' : 'Dado inválido',
                
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            // Evento Temperatura
            $events[] = [
                'type' => 'Temperatura',
                'details' => 'Leitura de sensor',
                'value' => $item->temperature !== null ? round($item->temperature, 1) . '°C' : 'Dado inválido',
                
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            // Evento Humidade
            $events[] = [
                'type' => 'Humidade',
                'details' => 'Leitura de sensor',
                'value' => $item->humidity !== null ? round($item->humidity, 1) . '%' : 'Dado inválido',
                
                'time' => $item->created_at->format('d/m/Y H:i')
            ];

            return $events;
        })->flatten(1);

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

    //funcao para a pagina relatorios dos valores em real time dos sensores em media de valores
    public function getSensorAverages()
    {
        //  últimos 50 registros
        $latestData = History::orderBy('created_at', 'desc')->take(50)->get();

        if ($latestData->isEmpty()) {
            return response()->json([
                'energy' => 0,
                'light' => 0,
                'temperature' => 0,
                'humidity' => 0
            ]);
        }

        // Calcular médias
        $averages = [
            'energy' => round(($latestData->where('led_state', 'ON')->count() / $latestData->count()) * 100, 1), // % de tempo com LED ligado
            'light' => round($latestData->avg('light'), 1),
            'temperature' => round($latestData->avg('temperature'), 1),
            'humidity' => round($latestData->avg('humidity'), 1)
        ];

        return response()->json($averages);
    }

    public function getMotionData()
    {
        // últimos 50 registros
        $latestData = History::orderBy('created_at', 'desc')->take(50)->get();

        if ($latestData->isEmpty()) {
            return response()->json([]);
        }

        // Formatamos os dados para o gráfico
        $data = $latestData->map(function ($item) {
            return [
                'motion' => $item->motion == '1' ? 1 : 0, // 1 para movimento, 0 para sem movimento
                'time' => $item->created_at->format('H:i:s')
            ];
        })->reverse()->values(); // Invertemos para ordem cronológica

        return response()->json($data);
    }


    public function getEnergyHistory()
{
    // Busca todos os registros (ou um número maior) e inverte para ordem cronológica
    $allData = History::orderBy('created_at', 'desc')->take(100)->get()->reverse()->values();

    if ($allData->isEmpty()) {
        return response()->json([]);
    }

    $historyPoints = [];
    $windowSize = 50; // Tamanho da janela para a média móvel

    // Se tivermos menos registros que o tamanho da janela, ajustamos
    if ($allData->count() < $windowSize) {
        $onCount = $allData->where('led_state', 'ON')->count();
        $percentageOn = round(($onCount / $allData->count()) * 100, 1);

        return response()->json([
            [
                'energy' => $percentageOn,
                'time' => $allData->last()->created_at->format('H:i:s')
            ]
        ]);
    }

    // Geração de médias móveis
    for ($i = 0; $i <= $allData->count() - $windowSize; $i++) {
        $chunk = $allData->slice($i, $windowSize);
        $onCount = $chunk->where('led_state', 'ON')->count();
        $percentageOn = round(($onCount / $windowSize) * 100, 1);

        $timestamp = $chunk->last()->created_at->format('H:i:s');

        $historyPoints[] = [
            'energy' => $percentageOn,
            'time' => $timestamp
        ];
    }

    return response()->json($historyPoints);
}
    
}
