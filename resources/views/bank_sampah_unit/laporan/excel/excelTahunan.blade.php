<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Setoran Sampah Tahunan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .subheader {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 class="header">Rekap Setoran Sampah Tahunan</h1>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Bulan</th>
                @foreach ($types as $type)
                    <th colspan="2">{{ ucfirst($type) }}</th>
                @endforeach
                <th colspan="2">Total</th>
            </tr>
            <tr>
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
                        <td>{{ $data[strtolower($type) . '_kg'] !== '-' ? $data[strtolower($type) . '_kg'] . ' kg' : '-' }}
                        </td>
                        <td>
                            @if ($data[strtolower($type) . '_rp'] !== '-')
                                Rp
                                {{ number_format((float) str_replace(',', '', $data[strtolower($type) . '_rp']), 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                    <td>{{ $data['total_kg'] !== '-' ? $data['total_kg'] . ' kg' : '-' }}</td>
                    <td>
                        @if ($data['total_rp'] !== '-')
                            Rp {{ number_format((float) str_replace(',', '', $data['total_rp']), 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
