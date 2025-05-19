<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; text-align: center; }
        .date { text-align: right; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f2f2f2; text-align: left; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { margin-top: 30px; text-align: center; font-size: 0.8em; color: #666; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="date">Ficheiro criado em: {{ $date }}</div>
    
    <table>
        <thead>
            <tr>
                <th>Data/Hora</th>
                <th>Luminosidade (lx)</th>
                <th>Temperatura (°C)</th>
                <th>Humidade (%)</th>
                <th>Estado LED</th>
                <th>Movimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $item->light }}</td>
                <td>{{ $item->temperature }}</td>
                <td>{{ $item->humidity }}</td>
                <td>{{ $item->led_state }}</td>
                <td>{{ $item->motion ? 'Sim' : 'Não' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Sistema de Monitorização dos Sensores - PDF Gerado automaticamente
    </div>
</body>
</html>