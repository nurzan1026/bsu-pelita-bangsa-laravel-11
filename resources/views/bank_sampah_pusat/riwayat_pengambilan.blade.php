@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Riwayat Pengangkutan Sampah</h1>
    <div class="bg-white shadow-md rounded my-6">
        @if($permintaanSelesai->isEmpty())
            <div class="p-4 text-center text-gray-500">
                Tidak ada riwayat pengangkutan.
            </div>
        @else
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Bank Sampah</th>
                        <th class="py-3 px-6 text-left">Kategori Sampah</th>
                        <th class="py-3 px-6 text-left">Jenis Sampah</th>
                        <th class="py-3 px-6 text-left">Berat</th>
                        <th class="py-3 px-6 text-left">Total Berat</th>
                        <th class="py-3 px-6 text-left">Tanggal</th>
                        <th class="py-3 px-6 text-left">Waktu</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($permintaanSelesai as $item)
                        @php
                            $groupedSampah = collect($item->sampah)->groupBy('kategori_sampah');
                        @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $item->account_name }}</td>
                            <td class="py-3 px-6 text-left">
                                @foreach($groupedSampah as $kategori => $sampahGroup)
                                    <div class="mb-2 pb-1 @if(!$loop->last) border-b-2 border-gray-400 @endif"><strong>{{ $kategori }}</strong></div>
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left">
                                @foreach($groupedSampah as $kategori => $sampahGroup)
                                    <div class="mb-2 pb-1 @if(!$loop->last) border-b-2 border-gray-400 @endif">
                                        @foreach($sampahGroup as $sampah)
                                            <div class="mb-2">{{ $sampah['nama_sampah'] }}</div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left">
                                @foreach($groupedSampah as $kategori => $sampahGroup)
                                    <div class="mb-2 pb-1 @if(!$loop->last) border-b-2 border-gray-400 @endif">
                                        @foreach($sampahGroup as $sampah)
                                            <div class="mb-2">{{ $sampah['berat'] }} 
                                            @if($kategori == 'Minyak')
                                                L
                                            @else
                                                Kg
                                            @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </td>
                            @php
                                $total_berat = $groupedSampah->filter(function($group, $key) {
                                    return $key !== 'Minyak';
                                })->flatten(1)->sum('berat');

                                $total_volume = $groupedSampah->filter(function($group, $key) {
                                    return $key === 'Minyak';
                                })->flatten(1)->sum('berat');
                            @endphp
                            <td class="py-3 px-6 text-left">
                                @if($total_berat > 0)
                                    {{ $total_berat }} Kg<br>
                                @endif
                                @if($total_volume > 0)
                                    {{ $total_volume }} L
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Makassar')->format('d M Y') }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Makassar')->format('H:i:s') }}</td>
                            <td class="py-3 px-6 text-left"><span class="text-green-500">{{ $item->status }}</span></td>
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('bank_sampah_pusat.cetak_pdf', $item->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded inline-block">Cetak PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
