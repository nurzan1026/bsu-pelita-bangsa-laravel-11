<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengangkutan Sampah</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">GRAFIK PEMBELIAN SAMPAH ANORGANIK</h2>
            <h3 class="text-xl font-semibold text-gray-700">UPT BANK SAMPAH DINAS LINGKUNGAN HIDUP KOTA MAKASSAR</h3>
            <p class="text-gray-600">TAHUN 2022 s/d 2022</p>
        </div>
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2 text-center">No.</th>
                    <th class="border p-2 text-center">Bulan</th>
                    @foreach($kategoriSampahList as $kategori)
                        <th colspan="2" class="border p-2 text-center">{{ $kategori }}</th>
                    @endforeach
                    <th colspan="2" class="border p-2 text-center">Jumlah</th>
                </tr>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-center"></th>
                    <th class="border p-2 text-center"></th>
                    @foreach($kategoriSampahList as $kategori)
                        <th class="border p-2 text-center">Kg</th>
                        <th class="border p-2 text-center">Rp</th>
                    @endforeach
                    <th class="border p-2 text-center">Kg</th>
                    <th class="border p-2 text-center">Rp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($months as $monthNumber => $monthName)
                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border p-2 text-center">{{ $monthName }}</td>
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
                            <td class="border p-2 text-right">{{ number_format($berat, 2, ',', '.') }}</td>
                            <td class="border p-2 text-right">{{ number_format($harga, 0, ',', '.') }}</td>
                        @endforeach
                        <td class="border p-2 text-right font-bold">{{ number_format($totalBeratPerBulan, 2, ',', '.') }}</td>
                        <td class="border p-2 text-right font-bold">{{ number_format($totalHargaPerBulan, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-300">
                    <td colspan="2" class="border p-2 font-bold text-center">JUMLAH TOTAL</td>
                    @foreach($kategoriSampahList as $kategori)
                        @php
                            $totalCategoryBerat = array_sum(array_map(function($data) use ($kategori) {
                                return $data[$kategori]['total_berat'] ?? 0;
                            }, $monthlyData));
                            $totalCategoryHarga = array_sum(array_map(function($data) use ($kategori) {
                                return $data[$kategori]['total_harga'] ?? 0;
                            }, $monthlyData));
                        @endphp
                        <td class="border p-2 text-right font-bold">{{ number_format($totalCategoryBerat, 2, ',', '.') }}</td>
                        <td class="border p-2 text-right font-bold">{{ number_format($totalCategoryHarga, 0, ',', '.') }}</td>
                    @endforeach
                    <td class="border p-2 text-right font-bold">
                        {{ number_format(array_sum(array_map(function($data) {
                            return array_sum(array_column($data, 'total_berat'));
                        }, $monthlyData)), 2, ',', '.') }}
                    </td>
                    <td class="border p-2 text-right font-bold">
                        {{ number_format(array_sum(array_map(function($data) {
                            return array_sum(array_column($data, 'total_harga'));
                        }, $monthlyData)), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
