<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian Sampah Anorganik</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="font-sans antialiased">
    <div class="text-center my-4">
        <h2 class="text-xl font-bold">UPT BANK SAMPAH KOTA MAKASSAR</h2>
        <p class="font-semibold">NOTA PEMBELIAN SAMPAH</p>
    </div>

    <div class="mx-auto p-4">
        <table class="w-full border-collapse border">
            <tr>
                <td class="border p-2">Hari/Tanggal</td>
                <td class="border p-2">{{ $permintaan->tanggal_pengambilan }}</td>
            </tr>
            <tr>
                <td class="border p-2">Nama BSU</td>
                <td class="border p-2">{{ $permintaan->account_name }}</td>
            </tr>
        </table>

        <br>

        <table class="w-full border-collapse border mt-4">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Kategori Sampah</th>
                    <th class="border p-2">Jenis Sampah</th>
                    <th class="border p-2">Waste ID</th>
                    <th class="border p-2">Berat (Kg)</th>
                    <th class="border p-2">Harga per Kg (IDR)</th>
                    <th class="border p-2">Subtotal (IDR)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $lastCategory = '';
                @endphp
                @foreach ($permintaan->sampah as $sampah)
                    <tr>
                        <td class="border p-2">
                            @if ($sampah['kategori'] != $lastCategory)
                                {{ $sampah['kategori'] }}
                                @php
                                    $lastCategory = $sampah['kategori'];
                                @endphp
                            @endif
                        </td>
                        <td class="border p-2">{{ $sampah['nama_sampah'] }}</td>
                        <td class="border p-2">{{ $sampah['waste_id'] }}</td>
                        <td class="border p-2">{{ $sampah['berat'] }}</td>
                        <td class="border p-2">{{ $sampah['harga'] }}</td>
                        <td class="border p-2">{{ $sampah['berat'] * $sampah['harga'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="border p-2"><strong>Total</strong></td>
                    <td class="border p-2"><strong>{{ $permintaan->total_berat }} Kg</strong></td>
                    <td class="border p-2"></td>
                    <td class="border p-2"><strong>IDR {{ $permintaan->total_harga }}</strong></td>
                </tr>
            </tbody>
        </table>

        <br>

        <div class="mt-6">
            <p class="font-semibold text-center">Terbilang: {{ terbilang($permintaan->total_harga) }} Rupiah</p>
        </div>

        <div class="mt-6 flex justify-between">
            <div class="text-center">
                <img src="{{ asset('images/ttd.jpg') }}" alt="Tanda Tangan Pengurus BSU" class="w-100 mx-auto"> <!-- Mengubah class untuk memperbesar gambar -->
            </div>
        </div>
    </div>
</body>
</html>

@php
function terbilang($angka) {
    $angka = abs($angka);
    $baca = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $terbilang = "";
    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } elseif ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " Belas";
    } elseif ($angka < 100) {
        $terbilang = terbilang((int)($angka / 10)) . " Puluh" . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $terbilang = " Seratus" . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $terbilang = terbilang((int)($angka / 100)) . " Ratus" . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $terbilang = " Seribu" . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $terbilang = terbilang((int)($angka / 1000)) . " Ribu" . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $terbilang = terbilang((int)($angka / 1000000)) . " Juta" . terbilang($angka % 1000000);
    }

    return $terbilang;
}
@endphp
