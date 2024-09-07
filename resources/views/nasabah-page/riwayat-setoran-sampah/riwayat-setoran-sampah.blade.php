@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Setoran</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">No</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Jenis
                            Sampah</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Berat
                            (kg)</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Total
                            Poin</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Total
                            Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @foreach ($setoranSampah as $setoran)
                        @php
                            $jenisSampah = [];
                            $totalBerat = 0;
                            $totalPoin = 0;
                            $totalHarga = 0;
                        @endphp
                        @foreach ($setoran->detailSetoran as $detail)
                            @php
                                $jenisSampah[] = $detail->sampah->jenis;
                                $totalBerat += $detail->berat;
                                $totalPoin += $detail->poin;
                                if ($detail->sampah && $detail->sampah->harga) {
                                    $totalHarga += $detail->berat * $detail->sampah->harga->price;
                                }
                            @endphp
                        @endforeach
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->tanggal_setor }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ implode(', ', $jenisSampah) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $totalBerat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $totalPoin }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $totalHarga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
