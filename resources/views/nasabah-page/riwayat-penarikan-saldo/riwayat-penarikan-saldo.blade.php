@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Penarikan Saldo</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">No</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Jumlah
                            Penarikan</th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">1</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">2024-07-01</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Rp 500.000</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Selesai</td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
