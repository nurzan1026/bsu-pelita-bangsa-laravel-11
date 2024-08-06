@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Penarikan Poin</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        @if (isset($riwayat) && $riwayat->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">No
                            </th>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Nama
                            </th>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Tanggal</th>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Jumlah Poin</th>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Opsi
                            </th>
                            <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center">
                        @foreach ($riwayat as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->tanggal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->opsi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No data available.</p>
        @endif
    </div>
@endsection
