<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HistoryExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return History::orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Data/Hora',
            'Luminosidade (lx)',
            'Temperatura (°C)',
            'Humidade (%)',
            'Estado LED',
            'Movimento',
        ];
    }

    public function map($history): array
    {
        return [
            $history->created_at->format('d/m/Y H:i'),
            $history->light,
            $history->temperature,
            $history->humidity,
            $history->led_state,
            $history->motion ? 'Sim' : 'Não',
        ];
    }
}