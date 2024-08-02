@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-10 text-3xl font-bold tracking-wider">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8" />
                </svg>
            </div>
            <h1>Laporan Pengelolaan</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="bg-white mt-5 h-fit mx-10 rounded-md p-5">
            <div class="flex justify-end">
                <div class="flex justify-end gap-2">
                    <button class="bg-red-500 hover:bg-red-700 font-bold py-1.5 px-2 rounded">
                        <a href="{{ route('pengelolaan.export.pdf') }}">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                            </svg>
                        </a>
                    </button>
                    <button class="bg-green-500 hover:bg-green-700 font-bold py-1.5 px-2 rounded">
                        <a href="{{ route('pengelolaan.export.excel') }}">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                            </svg>
                        </a>
                    </button>
                </div>
            </div>
            <table class="min-w-full bg-white border border-gray-200 mt-4">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="border border-gray-200 px-4 py-3">Bulan</th>
                        <th class="border border-gray-200 px-4 py-3">Total Sampah Masuk (kg)</th>
                        <th class="border border-gray-200 px-4 py-3">Total Sampah Terangkut (kg)</th>
                        <th class="border border-gray-200 px-4 py-3">Total Sampah Daur Ulang (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekapPengelolaan as $bulan => $data)
                        <tr>
                            <td class="border border-gray-200 px-4 py-2">{{ $bulan }}</td>
                            <td class="border border-gray-200 px-4 py-2">
                                {{ $data['sampah_masuk'] === '-' ? '-' : number_format($data['sampah_masuk'], 2, ',', '.') . ' kg' }}
                            </td>
                            <td class="border border-gray-200 px-4 py-2">
                                {{ $data['sampah_terangkut'] === '-' ? '-' : number_format($data['sampah_terangkut'], 2, ',', '.') . ' kg' }}
                            </td>
                            <td class="border border-gray-200 px-4 py-2">
                                {{ $data['sampah_daur_ulang'] === '-' ? '-' : number_format($data['sampah_daur_ulang'], 2, ',', '.') . ' kg' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
