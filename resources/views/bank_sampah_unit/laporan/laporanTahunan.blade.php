@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-10 text-3xl font-bold tracking-wider mt-14">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8" />
                </svg>
            </div>
            <h1>Laporan Tahunan</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="bg-white mt-5 h-fit mx-10 rounded-md p-5">
            <div class="flex justify-between gap-2">
                <form id="filter-form" action="{{ route('setoran.rekapTahunan') }}" method="GET">
                    <select name="tahun" id="tahun-filter" class="border border-gray-300 rounded py-1 px-2">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">Filter</button>
                </form>
                <div>
                    <button id="export-pdf" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-2 rounded">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                        </svg>
                    </button>
                    <button id="export-excel"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1.5 px-2 rounded">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <table class="min-w-full bg-white border border-gray-200 mt-4">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="py-2 px-4 border-b border-r" rowspan="2">Bulan</th>
                        @foreach ($types as $type)
                            <th class="py-2 px-4 border-b" colspan="2">{{ ucfirst($type) }}</th>
                        @endforeach
                        <th class="py-2 px-4 border-b" colspan="2">Total</th>
                    </tr>
                    <tr>
                        @foreach ($types as $type)
                            <th class="py-2 px-4 border-b">Kg</th>
                            <th class="py-2 px-4 border-b">Rp</th>
                        @endforeach
                        <th class="py-2 px-4 border-b">Kg</th>
                        <th class="py-2 px-4 border-b">Rp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekapBulanan as $bulan => $data)
                        @if ($data['total_kg'] !== '-')
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $bulan }}</td>
                                @foreach ($types as $type)
                                    <td class="py-2 px-4 border-b">{{ $data[strtolower($type) . '_kg'] }} kg</td>
                                    <td class="py-2 px-4 border-b">Rp
                                        {{ $data[strtolower($type) . '_rp'] == '-' ? '-' : number_format(floatval($data[strtolower($type) . '_rp']), 0, ',', '.') }}
                                    </td>
                                @endforeach
                                <td class="py-2 px-4 border-b">{{ $data['total_kg'] }} kg</td>
                                <td class="py-2 px-4 border-b">Rp
                                    {{ $data['total_rp'] == '-' ? '-' : number_format(floatval($data['total_rp']), 0, ',', '.') }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $bulan }}</td>
                                @foreach ($types as $type)
                                    <td class="py-2 px-4 border-b">-</td>
                                    <td class="py-2 px-4 border-b">-</td>
                                @endforeach
                                <td class="py-2 px-4 border-b">-</td>
                                <td class="py-2 px-4 border-b">-</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('export-pdf').addEventListener('click', function() {
                let tahun = document.getElementById('tahun-filter').value;
                let url = `{{ route('rekap.export.pdf') }}?tahun=${tahun}`;
                window.location.href = url;
            });

            document.getElementById('export-excel').addEventListener('click', function() {
                let tahun = document.getElementById('tahun-filter').value;
                let url = `{{ route('rekap.export.excel') }}?tahun=${tahun}`;
                window.location.href = url;
            });
        });
    </script>
@endsection
