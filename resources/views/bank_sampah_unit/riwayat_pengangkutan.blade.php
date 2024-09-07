@extends('bank_sampah_unit.layout')

@section('content')
<div class="container mx-auto p-4  mt-14">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Riwayat Permintaan Pengangkutan Sampah</h2>
        <a href="{{ route('permintaan.pengangkutan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Kembali ke Permintaan Pengangkutan</a>
    </div>
    
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Akun</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Sampah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Sampah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Permintaan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Permintaan</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @forelse($permintaans as $permintaan)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $permintaan->id }}</td>
                    <td class="px-4 py-2">{{ $permintaan->account_name }}</td>
                    <td class="px-4 py-2">
                        @php
                            $groupedSampah = collect($permintaan->sampah)->groupBy('kategori_sampah');
                        @endphp
                        @foreach($groupedSampah as $kategori => $sampahGroup)
                            <div class="mb-2 pb-1 @if(!$loop->last) border-b @endif"><strong>{{ $kategori }}</strong></div>
                        @endforeach
                    </td>
                    <td class="px-4 py-2">
                        @foreach($groupedSampah as $kategori => $sampahGroup)
                            <div class="mb-2 pb-1 @if(!$loop->last) border-b @endif">
                                @foreach($sampahGroup as $sampah)
                                    <div class="mb-2">{{ $sampah['nama_sampah'] }}</div>
                                @endforeach
                            </div>
                        @endforeach
                    </td>
                    <td class="px-4 py-2">
                        @foreach($groupedSampah as $kategori => $sampahGroup)
                            <div class="mb-2 pb-1 @if(!$loop->last) border-b @endif">
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
                    <td class="px-4 py-2">
                        @if($total_berat > 0)
                            {{ $total_berat }} Kg<br>
                        @endif
                        @if($total_volume > 0)
                            {{ $total_volume }} L
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($permintaan->created_at)->setTimezone('Asia/Makassar')->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($permintaan->created_at)->setTimezone('Asia/Makassar')->format('H:i') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-white font-semibold
                            @if($permintaan->status == 'Menunggu Konfirmasi') bg-red-500 
                            @elseif($permintaan->status == 'Diproses') bg-yellow-600
                            @elseif($permintaan->status == 'Tanggal Pengambilan Telah Terbit') bg-blue-500 
                            @elseif($permintaan->status == 'Menuju Tempat Anda') bg-green-700 
                            @elseif($permintaan->status == 'Selesai') bg-green-500 
                            @endif">
                            {{ $permintaan->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        @if($permintaan->status != 'Selesai')
                            @php
                                $detailPermintaan = "Nama Akun: {$permintaan->account_name}%0ATanggal Permintaan: " . \Carbon\Carbon::parse($permintaan->created_at)->setTimezone('Asia/Makassar')->format('d M Y') . "%0AWaktu Permintaan: " . \Carbon\Carbon::parse($permintaan->created_at)->setTimezone('Asia/Makassar')->format('H:i') . "%0A%0AKategori Sampah:%0A";
                                foreach ($groupedSampah as $kategori => $sampahGroup) {
                                    $detailPermintaan .= "- {$kategori}:%0A";
                                    foreach ($sampahGroup as $sampah) {
                                        $detailPermintaan .= "  - {$sampah['nama_sampah']} ({$sampah['berat']} " . ($kategori == 'Minyak' ? 'L' : 'Kg') . ")%0A";
                                    }
                                }
                                $detailPermintaan .= "%0A%0ATotal:%0A";
                                if ($total_berat > 0) {
                                    $detailPermintaan .= "{$total_berat} Kg%0A";
                                }
                                if ($total_volume > 0) {
                                    $detailPermintaan .= "{$total_volume} L%0A";
                                }
                            @endphp
                            <a href="https://wa.me/+6281343937565?text=Halo%20Bank%20Sampah%20Pusat,%20saya%20ingin%20menanyakan%20status%20permintaan%20pengangkutan%20sampah%20dengan%20ID%20{{ $permintaan->id }}.%0A%0A{{ $detailPermintaan }}"
                               class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                                Hubungi
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-4 py-2 text-center">Tidak ada riwayat permintaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
