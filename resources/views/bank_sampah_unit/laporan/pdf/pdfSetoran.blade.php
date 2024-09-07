<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Setoran Sampah</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: rgb(68, 68, 68);
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .totals {
            color: black;
            text-align: left;
        }

        .header-date {
            text-align: right;
            color: gray;
            margin-bottom: 5px;
        }

        .header-date span {
            color: black;
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
                <td class="no-border" style="width: 18%;"><img width="160px" height="160px"
                        src="{{ asset('img/logobsu.png') }}" alt="Logo"></td>
                <td class="no-border" style="width: 65%; text-align: center;">
                    <h1>BANK SAMPAH UNIT ( BSU )</h1>
                    <h2>PELITA BANGSA</h2>
                    <h3>KELURAHAN BALLAPARANG</h3>
                    <h3>KECAMATAN RAPPOCINI</h3>
                    <h3>KOTA MAKASSAR</h3>
                    <p>Alamat : Jl. Pelita Raya Ir. 2 No.3a Makassar – 90222 Telp/WA : 081 356 656 456</p>
                    <div class="divider"></div>
                </td>
                <td class="no-border" style="width: 17%;"></td>
            </tr>
        </table>
        <div class="border1"></div>
        <div class="border2"></div>
    </div>
    <div class="header-date"><span>Tanggal : </span>{{ \Carbon\Carbon::now()->format('d M Y') }}</div>
    <h1>Setoran Sampah</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Nomor Induk</th>
                <th>Tanggal Setor</th>
                <th>Jenis Sampah</th>
                <th>Jumlah Setoran</th>
                <th>Total Setoran</th>
                <th>Total Poin</th>
                <th>Total Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($setoran as $item)
                @php
                    $totalSetoran = $item->detailSetoran->sum('berat');
                    $totalPoin = $item->detailSetoran->sum('poin');
                    $totalHargaSetoran = $item->detailSetoran->sum(function ($detail) {
                        return ($detail->sampah->harga->price ?? 0) * $detail->berat; // Menggunakan 'price' sesuai perubahan sebelumnya
                    });
                @endphp
                <tr>
                    <td rowspan="{{ count($item->detailSetoran) }}">{{ $no++ }}</td>
                    <td rowspan="{{ count($item->detailSetoran) }}">{{ $item->nasabah->nama }}</td>
                    <td rowspan="{{ count($item->detailSetoran) }}">{{ $item->nasabah->nomor_induk }}</td>
                    <td rowspan="{{ count($item->detailSetoran) }}">
                        {{ \Carbon\Carbon::parse($item->tanggal_setor)->format('Y-m-d') }}</td>
                    @foreach ($item->detailSetoran as $index => $detail)
                        @if ($index > 0)
                <tr>
            @endif
            <td>{{ $detail->sampah ? $detail->sampah->jenis : 'Jenis sampah tidak ditemukan' }}</td>
            <td>{{ $detail->berat }} kg</td>
            @if ($index === 0)
                <td rowspan="{{ count($item->detailSetoran) }}">{{ $totalSetoran }} kg</td>
                <td rowspan="{{ count($item->detailSetoran) }}">{{ $totalPoin }}</td>
                <td rowspan="{{ count($item->detailSetoran) }}">Rp
                    {{ number_format($totalHargaSetoran, 0, ',', '.') }}
                </td>
            @endif
            @if ($index < count($item->detailSetoran) - 1)
                </tr>
            @endif
            @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
