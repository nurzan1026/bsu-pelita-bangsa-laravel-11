@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Jadwal Pengangkutan</h1>
    <div class="bg-white shadow-md rounded my-6">
        @if($jadwalPengangkutan->isEmpty())
            <div class="p-4 text-center text-gray-500">
                Tidak ada jadwal pengangkutan.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left border-b">Bank Sampah</th>
                            <th class="py-3 px-6 text-left border-b">Kategori Sampah</th>
                            <th class="py-3 px-6 text-left border-b">Jenis Sampah</th>
                            <th class="py-3 px-6 text-left border-b">Berat</th>
                            <th class="py-3 px-6 text-left border-b">Total Berat</th>
                            <th class="py-3 px-6 text-left border-b">Tanggal Pengambilan</th>
                            <th class="py-3 px-6 text-left border-b">Waktu Pengambilan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($jadwalPengangkutan as $item)
                            @php
                                $groupedSampah = collect($item->sampah)->groupBy('kategori_sampah');
                            @endphp
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $item->account_name }}</td>
                                <td class="py-3 px-6 text-left">
                                    @foreach($groupedSampah as $kategori => $sampahGroup)
                                        <div>{{ ucfirst($kategori) }}</div>
                                    @endforeach
                                </td>
                                <td class="py-3 px-6 text-left">
                                    @foreach($groupedSampah as $kategori => $sampahGroup)
                                        @foreach($sampahGroup as $sampah)
                                            <div>{{ ucfirst(str_replace('_', ' ', $sampah['nama_sampah'])) }}</div>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td class="py-3 px-6 text-left">
                                    @foreach($groupedSampah as $kategori => $sampahGroup)
                                        @foreach($sampahGroup as $sampah)
                                            <div>{{ $sampah['berat'] }} @if($kategori == 'Minyak') L @else Kg @endif</div>
                                        @endforeach
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
                                <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->tanggal_pengambilan)->format('d M Y') }}</td>
                                <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->waktu_pengambilan)->format('H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
