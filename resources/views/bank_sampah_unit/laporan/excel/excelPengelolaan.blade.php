<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pengelolaan Sampah</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Pengelolaan Sampah</h1>
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Sampah Masuk (kg)</th>
                <th>Total Sampah Terangkut (kg)</th>
                <th>Total Sampah Daur Ulang (kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapPengelolaan as $bulan => $data)
                <tr>
                    <td>{{ $bulan }}</td>
                    <td>{{ $data['sampah_masuk'] === '-' ? '-' : number_format($data['sampah_masuk'], 2, ',', '.') . ' kg' }}
                    </td>
                    <td>{{ $data['sampah_terangkut'] === '-' ? '-' : number_format($data['sampah_terangkut'], 2, ',', '.') . ' kg' }}
                    </td>
                    <td>{{ $data['sampah_daur_ulang'] === '-' ? '-' : number_format($data['sampah_daur_ulang'], 2, ',', '.') . ' kg' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
