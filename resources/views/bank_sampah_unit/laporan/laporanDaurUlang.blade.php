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
            <h1>Laporan Daur Ulang</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="bg-white mt-5 h-fit mx-10 rounded-md p-5">
            <div class="flex justify-end gap-2">
                <button
                    class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded"
                    id="openDaurUlangModalButton">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="pb-1">Daur Ulang Baru</p>
                </button>
                <button class="bg-red-500 hover:bg-red-700 font-bold py-1.5 px-2 rounded">
                    <a href="{{ route('daur_ulang.exportPdf') }}" class="flex items-center gap-2 text-white">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                        </svg>
                    </a>
                </button>
                <button class="bg-green-500 hover:bg-green-700 font-bold py-1.5 px-2 rounded">
                    <a href="{{ route('daur_ulang.exportExcel') }}" class="flex items-center gap-2 text-white">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                    </a>
                </button>
            </div>
            <table class="min-w-full bg-white border border-gray-200 mt-4">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="border border-gray-200 px-4 py-2">No</th>
                        <th class="border border-gray-200 px-4 py-2">Tanggal</th>
                        <th class="border border-gray-200 px-4 py-2">Jenis Sampah</th>
                        <th class="border border-gray-200 px-4 py-2">Berat Sampah (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rowIndex = 1; @endphp
                    @foreach ($daurUlangs as $daurUlang)
                        @foreach ($daurUlang->detailDaurUlangs as $detailIndex => $detail)
                            <tr>
                                @if ($detailIndex === 0)
                                    <td class="border border-gray-200 px-4 py-2"
                                        rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                                        {{ $rowIndex++ }}
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2"
                                        rowspan="{{ $daurUlang->detailDaurUlangs->count() }}">
                                        {{ $daurUlang->tanggal_daur_ulang }}
                                    </td>
                                @endif
                                <td class="border border-gray-200 px-4 py-2">{{ $detail->sampah->jenis }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $detail->berat }} kg</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @include('bank_sampah_unit.laporan.partials._modals')
@endsection

@section('scripts')
    @include('bank_sampah_unit.laporan.partials._scripts')
@endsection
