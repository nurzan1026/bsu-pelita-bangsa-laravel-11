@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-4 md:px-10 text-2xl md:text-3xl font-bold tracking-wider mt-14">
        <div class="w-full sm:w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                </svg>
            </div>
            <h1 class="text-center sm:text-left">Setoran Sampah</h1>
        </div>
    </div>
    <div class="w-full px-4 md:px-10">
        <div class="bg-white mt-5 h-fit rounded-md p-5">
            <div class="flex flex-col md:flex-row justify-between mb-6 w-full">
                <form action="" class="flex items-center mb-4 md:mb-0" id="search-form">
                    <input type="search" id="search-input" placeholder="Cari setoran..."
                        class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-80">
                </form>
                <div class="flex items-center justify-center md:justify-start gap-3">
                    <button id="add-button"
                        class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="pb-1">Setoran Baru</p>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="border border-gray-200 text-gray-700 px-4 py-2 text-left text-xs md:text-sm">No</th>
                            <th class="border border-gray-200 text-gray-700 px-4 py-2 text-left text-xs md:text-sm">Tanggal
                                Setor</th>
                            <th class="border border-gray-200 text-gray-700 px-4 py-2 text-left text-xs md:text-sm">Nasabah
                            </th>
                            <th class="border border-gray-200 text-gray-700 px-4 py-2 text-left text-xs md:text-sm">Jumlah
                                Setoran</th>
                            <th class="border border-gray-200 text-gray-700 px-4 py-2 text-left text-xs md:text-sm">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="setoran-table-body">
                        @foreach ($setoran as $index => $item)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-200 px-4 py-2 text-xs md:text-sm">{{ $index + 1 }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-xs md:text-sm">{{ $item->tanggal_setor }}
                                </td>
                                <td class="border border-gray-200 px-4 py-2 text-xs md:text-sm">{{ $item->nasabah->nama }}
                                </td>
                                <td class="border border-gray-200 px-4 py-2 text-xs md:text-sm">
                                    {{ $item->detailSetoran->sum('berat') }} kg</td>
                                <td class="border border-gray-200 px-4 py-2 flex justify-center gap-2 text-xs md:text-sm">
                                    <button
                                        class="flex items-center justify-center w-8 h-8 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 delete-button"
                                        data-id="{{ $item->id }}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="flex items-center justify-center w-8 h-8 rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 edit-button"
                                        data-id="{{ $item->id }}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="flex items-center justify-center w-8 h-8 rounded-md bg-yellow-400 text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 see-button"
                                        data-id="{{ $item->id }}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $setoran->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @include('bank_sampah_unit.setoran.partials._modals')
@endsection

@section('scripts')
    @include('bank_sampah_unit.setoran.partials._scripts')
@endsection
