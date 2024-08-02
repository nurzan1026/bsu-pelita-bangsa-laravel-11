<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tahunan</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="{{ count($types) * 2 + 3 }}" style="text-align: center; font-size: 16px; font-weight: bold;">
                    Rekap Setoran Tahunan</th>
            </tr>
            <tr>
                <th rowspan="2">Bulan</th>
                @foreach ($types as $type)
                    <th colspan="2">{{ ucfirst($type) }}</th>
                @endforeach
                <th colspan="2">Total</th>
            </tr>
            <tr>
                <th></th>
                @foreach ($types as $type)
                    <th>Kg</th>
                    <th>Rp</th>
                @endforeach
                <th>Kg</th>
                <th>Rp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapBulanan as $bulan => $data)
                <tr>
                    <td>{{ $bulan }}</td>
                    @foreach ($types as $type)
                        <td>{{ $data[strtolower($type) . '_kg'] === '-' ? '-' : $data[strtolower($type) . '_kg'] . ' kg' }}
                        </td>
                        <td>{{ $data[strtolower($type) . '_rp'] === '-' ? '-' : 'Rp ' . number_format($data[strtolower($type) . '_rp'], 0, ',', '.') }}
                        </td>
                    @endforeach
                    <td>{{ $data['total_kg'] === '-' ? '-' : $data['total_kg'] . ' kg' }}</td>
                    <td>{{ $data['total_rp'] === '-' ? '-' : 'Rp ' . number_format($data['total_rp'], 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
