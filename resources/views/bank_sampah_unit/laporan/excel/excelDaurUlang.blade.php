<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daur Ulang Sampah</title>
</head>

<body>
    <table>
        <tr>
            <td colspan="4" style="font-size: 16pt; font-weight: bold; text-align: center;">Laporan Daur Ulang Sampah
            </td>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jenis Sampah</th>
            <th>Berat Sampah (kg)</th>
        </tr>
        @php $rowIndex = 1; @endphp
        @foreach ($daurUlangs as $index => $daurUlang)
            @foreach ($daurUlang->detailDaurUlangs as $detailIndex => $detail)
                <tr>
                    @if ($detailIndex === 0)
                        <td rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                            {{ $rowIndex++ }}</td>
                        <td rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                            {{ $daurUlang->tanggal_daur_ulang }}</td>
                    @endif
                    <td style="text-align: left;">{{ $detail->sampah->jenis }}</td>
                    <td style="text-align: center;">{{ $detail->berat }} kg</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</body>

</html>
