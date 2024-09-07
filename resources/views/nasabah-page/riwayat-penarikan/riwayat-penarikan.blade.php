@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Penarikan</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Tanggal
                            Penarikan</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Jenis
                            Penarikan</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Jumlah
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @foreach ($penarikanPoin as $penarikan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                {{ $penarikan->tanggal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                {{ $penarikan->rewardItem->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                {{ $penarikan->rewardItem->poin }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ ucfirst($penarikan->status) }}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($penarikanSaldo as $penarikan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                {{ $penarikan->tanggal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Saldo</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $penarikan->jumlah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ ucfirst($penarikan->status) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
