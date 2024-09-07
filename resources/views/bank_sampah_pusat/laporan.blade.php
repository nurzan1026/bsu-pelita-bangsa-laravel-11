@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Laporan Pengangkutan Sampah Tahun {{ $year }}</h1>

    <form method="GET" action="{{ route('pusat.laporan') }}" class="mb-4 flex items-center">
        <label for="tahun" class="mr-2">Pilih Tahun:</label>
        <select name="tahun" id="tahun" class="border rounded p-2 mr-4">
            @for($i = 2020; $i <= now()->year; $i++)
                <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <label for="bulan" class="mr-2">Pilih Bulan:</label>
        <select name="bulan" id="bulan" class="border rounded p-2 mr-4">
            <option value="">Semua Bulan</option>
            @foreach($months as $monthNumber => $monthName)
                <option value="{{ $monthNumber }}" {{ $monthNumber == $selectedMonth ? 'selected' : '' }}>{{ $monthName }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded mr-4">Tampilkan</button>
        <a href="{{ route('pusat.laporan.excel', ['tahun' => $year, 'bulan' => $selectedMonth]) }}" class="bg-green-500 text-white p-2 rounded">Export Excel</a>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-500">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2" rowspan="2">No.</th>
                    <th class="border border-gray-300 px-4 py-2" rowspan="2">Bulan</th>
                    @foreach($kategoriSampahList as $kategori)
                        <th class="border border-gray-300 px-4 py-2 text-center" colspan="2">{{ $kategori }}</th>
                    @endforeach
                    <th class="border border-gray-300 px-4 py-2" colspan="3">Jumlah</th>
                </tr>
                <tr>
                    @foreach($kategoriSampahList as $kategori)
                        <th class="border border-gray-300 px-4 py-2">Kg</th>
                        <th class="border border-gray-300 px-4 py-2">Rp</th>
                    @endforeach
                    <th class="border border-gray-300 px-4 py-2">Kg</th>
                    <th class="border border-gray-300 px-4 py-2">Rp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($months as $monthNumber => $monthName)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $monthName }}</td>
                        @php
                            $totalBeratPerBulan = 0;
                            $totalHargaPerBulan = 0;
                        @endphp
                        @foreach($kategoriSampahList as $kategori)
                            @php
                                $berat = $monthlyData[$monthNumber][$kategori]['total_berat'] ?? 0;
                                $harga = $monthlyData[$monthNumber][$kategori]['total_harga'] ?? 0;
                                $totalBeratPerBulan += $berat;
                                $totalHargaPerBulan += $harga;
                            @endphp
                            <td class="border px-4 py-2">{{ number_format($berat) }}</td>
                            <td class="border px-4 py-2">{{ number_format($harga) }}</td>
                        @endforeach
                        <td class="border px-4 py-2 font-bold">{{ number_format($totalBeratPerBulan) }}</td>
                        <td class="border px-4 py-2 font-bold">{{ number_format($totalHargaPerBulan) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-200">
                <tr>
                    <td class="border px-4 py-2 text-center font-bold" colspan="2">JUMLAH TOTAL</td>
                    @foreach($kategoriSampahList as $kategori)
                        @php
                            $totalCategoryBerat = array_sum(array_map(function($data) use ($kategori) {
                                return $data[$kategori]['total_berat'] ?? 0;
                            }, $monthlyData));
                            $totalCategoryHarga = array_sum(array_map(function($data) use ($kategori) {
                                return $data[$kategori]['total_harga'] ?? 0;
                            }, $monthlyData));
                        @endphp
                        <td class="border px-4 py-2 text-right font-bold">{{ number_format($totalCategoryBerat) }}</td>
                        <td class="border px-4 py-2 text-right font-bold">{{ number_format($totalCategoryHarga) }}</td>
                    @endforeach
                    <td class="border px-4 py-2 text-right font-bold">
                        {{ number_format(array_sum(array_map(function($data) {
                            return array_sum(array_column($data, 'total_berat'));
                        }, $monthlyData))) }}
                    </td>
                    <td class="border px-4 py-2 text-right font-bold">
                        {{ number_format(array_sum(array_map(function($data) {
                            return array_sum(array_column($data, 'total_harga'));
                        }, $monthlyData))) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
