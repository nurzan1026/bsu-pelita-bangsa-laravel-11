<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Sampah</title>
</head>

<body>
    <table>
        <tr>
            <td colspan="6" style="text-align: center; font-size: 20px; font-weight: bold;">Laporan Penjualan Sampah
            </td>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal Jual</th>
            <th>Pembeli</th>
            <th>Jenis Sampah</th>
            <th>Berat Sampah (kg)</th>
            <th>Total Harga (Rp)</th>
        </tr>
        @foreach ($penjualans as $indexPenjualan => $penjualan)
            @foreach ($penjualan->detailPenjualans as $index => $detail)
                <tr>
                    @if ($index === 0)
                        <td rowspan="{{ $penjualan->detailPenjualans->count() }}">{{ $indexPenjualan + 1 }}</td>
                        <td rowspan="{{ $penjualan->detailPenjualans->count() }}">{{ $penjualan->tanggal_jual }}</td>
                        <td rowspan="{{ $penjualan->detailPenjualans->count() }}">{{ $penjualan->pembeli }}</td>
                    @endif
                    <td>{{ $detail->sampah->jenis }}</td>
                    <td>{{ $detail->berat }} kg</td>
                    @if ($index === 0)
                        <td rowspan="{{ $penjualan->detailPenjualans->count() }}">Rp
                            {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </table>
</body>

</html>
