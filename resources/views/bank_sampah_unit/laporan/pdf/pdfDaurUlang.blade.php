<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daur Ulang Sampah</title>
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
    <h1 class="judul">Laporan Daur Ulang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Sampah</th>
                <th>Berat Sampah (kg)</th>
            </tr>
        </thead>
        <tbody>
            @php $rowIndex = 1; @endphp
            @foreach ($daurUlangs as $daurUlang)
                @foreach ($daurUlang->detailDaurUlangs as $detailIndex => $detail)
                    <tr>
                        @if ($detailIndex === 0)
                            <td rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                                {{ $rowIndex++ }}
                            </td>
                            <td rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                                {{ \Carbon\Carbon::parse($daurUlang->tanggal_daur_ulang)->format('d M Y') }}
                            </td>
                        @endif
                        <td>{{ $detail->sampah->jenis }}</td>
                        <td>{{ $detail->berat }} kg</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>

    </table>
</body>

</html>
