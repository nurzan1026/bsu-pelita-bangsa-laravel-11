<table>
    <tr>
        <td colspan="9" style="text-align: center; font-weight: bold; font-size: 17px;">Laporan Setoran Sampah</td>
    </tr>
    <tr>
        <td colspan="9"></td>
    </tr>
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
        @php
            $no = 1;
            $currentNasabah = null;
            $currentTanggal = null;
            $rowSpan = 1;
        @endphp
        @foreach ($setorans as $setoran)
            @foreach ($setoran->detailSetoran as $index => $detail)
                <tr>
                    @if ($setoran->nasabah->nama !== $currentNasabah || $setoran->tanggal_setor !== $currentTanggal)
                        @php
                            $currentNasabah = $setoran->nasabah->nama;
                            $currentTanggal = $setoran->tanggal_setor;
                            $rowSpan = $setoran->detailSetoran->count();
                        @endphp
                        <td rowspan="{{ $rowSpan }}">{{ $no++ }}</td>
                        <td rowspan="{{ $rowSpan }}">{{ $setoran->nasabah->nama }}</td>
                        <td rowspan="{{ $rowSpan }}">{{ $setoran->nasabah->nomor_induk }}</td>
                        <td rowspan="{{ $rowSpan }}">{{ $setoran->tanggal_setor }}</td>
                    @endif
                    <td>{{ $detail->sampah->jenis ?? 'Data sampah tidak ditemukan' }}</td>
                    <td>{{ $detail->berat }} kg</td>
                    @if ($loop->first)
                        @php
                            $totalBerat = $setoran->detailSetoran->sum('berat');
                            $totalPoin = $setoran->detailSetoran->sum('poin');
                            $totalHarga = $setoran->detailSetoran->sum(function ($d) {
                                return ($d->sampah->harga->harga ?? 0) * $d->berat;
                            });
                        @endphp
                        <td rowspan="{{ $rowSpan }}">{{ $totalBerat }} kg</td>
                        <td rowspan="{{ $rowSpan }}">{{ $totalPoin }}</td>
                        <td rowspan="{{ $rowSpan }}">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
