<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Setoran Sampah Tahunan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop {
            margin-bottom: 20px;
            text-align: center;
        }

        .kop table {
            width: 100%;
            border: none;
        }

        .kop h1,
        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
        }

        .kop h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .kop h2 {
            font-size: 20px;
            font-weight: bold;
        }

        .kop h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .kop p {
            font-size: 14px;
        }

        .kop .divider {
            border-top: 3px solid black;
            margin: 10px 0;
        }

        .no-border {
            border: none;
        }

        .kop td {
            vertical-align: top;
        }

        .kop .border1 {
            width: 100%;
            border: 2px solid black;
        }

        .kop .border2 {
            width: 100%;
            border: 1px solid black;
        }

        .judul {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="kop">
        <table class="no-border">
            <tr class="no-border">
                <td class="no-border" style="width: 20%;"><img width="160px" height="160px"
                        src="{{ asset('img/logobsu.png') }}" alt="Logo"></td>
                <td class="no-border" style="width: 60%; text-align: center;">
                    <h1>BANK SAMPAH UNIT ( BSU )</h1>
                    <h2>PELITA BANGSA</h2>
                    <h3>KELURAHAN BALLAPARANG</h3>
                    <h3>KECAMATAN RAPPOCINI</h3>
                    <h3>KOTA MAKASSAR</h3>
                    <p>Alamat : Jl. Pelita Raya Ir. 2 No.3a Makassar – 90222 Telp/WA : 081 356 656 456</p>
                    <div class="divider"></div>
                </td>
                <td class="no-border" style="width: 20%;"></td>
            </tr>
        </table>
        <div class="border1"></div>
        <div class="border2"></div>
    </div>
    <h1 class="judul">Rekap Setoran Sampah Tahunan</h1>
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
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
                @if ($data['total_kg'] !== '-')
                    <tr>
                        <td>{{ $bulan }}</td>
                        @foreach ($types as $type)
                            <td>{{ $data[strtolower($type) . '_kg'] }} kg</td>
                            <td>Rp
                                {{ $data[strtolower($type) . '_rp'] == '-' ? '-' : number_format($data[strtolower($type) . '_rp'], 0, ',', '.') }}
                            </td>
                        @endforeach
                        <td>{{ $data['total_kg'] }} kg</td>
                        <td>Rp {{ $data['total_rp'] == '-' ? '-' : number_format($data['total_rp'], 0, ',', '.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $bulan }}</td>
                        @foreach ($types as $type)
                            <td>-</td>
                            <td>-</td>
                        @endforeach
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
