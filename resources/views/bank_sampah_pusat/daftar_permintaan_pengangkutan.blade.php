<!-- resources/views/bank_sampah_pusat/daftar_permintaan_pengangkutan.blade.php -->
@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Permintaan Pengangkutan</h1>
    <div class="bg-white shadow-md rounded my-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($permintaanPengangkutan->isEmpty())
            <div class="p-4 text-center text-gray-500">
                Tidak ada permintaan pengangkutan.
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
                    @foreach($permintaanPengangkutan as $item)
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
                            <td class="py-3 px-6 text-left">
                                @if ($item->status == 'Menunggu Konfirmasi')
                                    <span class="text-red-500">{{ $item->status }}</span>
                                @elseif ($item->status == 'Diproses')
                                    <span class="text-yellow-600">{{ $item->status }}</span>
                                @elseif ($item->status == 'Mengatur Jadwal Penjemputan')
                                    <span class="text-yellow-500">{{ $item->status }}</span>
                                @elseif ($item->status == 'Tanggal Pengambilan Telah Terbit')
                                    <span class="text-blue-500">{{ $item->status }}</span>
                                @elseif ($item->status == 'Menuju Tempat Anda')
                                    <span class="text-green-500">{{ $item->status }}</span>
                                @elseif ($item->status == 'Selesai')
                                    <span class="text-green-500">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex flex-col space-y-2">
                                    @if ($item->status == 'Menunggu Konfirmasi')
                                        <form action="{{ route('pusat.konfirmasi_pengangkutan', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Konfirmasi</button>
                                        </form>
                                    @elseif ($item->status == 'Diproses')
                                        <form action="{{ route('pusat.jadwalkan_pengangkutan', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="flex flex-col space-y-2">
                                                <input type="date" name="tanggal_pengambilan" required class="border rounded px-2 py-1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                <input type="time" name="waktu_pengambilan" required class="border rounded px-2 py-1">
                                            </div>
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Jadwalkan</button>
                                        </form>
                                    @elseif ($item->status == 'Tanggal Pengambilan Telah Terbit')
                                        <form action="{{ route('pusat.menuju_tempat', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded">Menuju</button>
                                        </form>
                                    @elseif ($item->status == 'Menuju Tempat Anda')
                                        <div class="flex flex-row space-x-2">
                                            <form action="{{ route('pusat.selesai_pengangkutan', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Selesai</button>
                                            </form>
                                            <a href="{{ route('pusat.permintaan_pengangkutan.edit', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Tidak ada aksi</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
