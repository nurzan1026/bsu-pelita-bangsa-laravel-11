@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-10 text-3xl font-bold tracking-wider">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
            </div>
            <h1>Nasabah</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="bg-white mt-5 h-fit mx-10 rounded-md p-5">
            <div class="flex justify-between mb-3 w-full">
                <form action="" class="flex items-center">
                    <input type="search" placeholder="Cari nasabah..."
                        class="border border-gray-300 rounded py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 w-80">
                </form>
                <div class="flex items-center gap-3">
                    <button
                        class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-2 rounded"
                        id="add-nasabah">
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p class="pb-1">Nasabah Baru</p>
                    </button>
                </div>
            </div>
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">Nama</th>
                        <th class="py-2 px-4 border-b">Nomor Induk</th>
                        <th class="py-2 px-4 border-b">Alamat</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nasabahs as $index => $nasabah)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b">{{ $nasabah->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $nasabah->nomor_induk }}</td>
                            <td class="py-2 px-4 border-b">{{ Str::limit($nasabah->alamat, 50) }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        class="flex items-center justify-center w-8 h-8 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 delete-button"
                                        data-id="{{ $nasabah->id }}">
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
                                        data-id="{{ $nasabah->id }}" data-nama="{{ $nasabah->nama }}"
                                        data-nomor_induk="{{ $nasabah->nomor_induk }}"
                                        data-username="{{ $nasabah->username }}" data-email="{{ $nasabah->email }}"
                                        data-alamat="{{ $nasabah->alamat }}" data-foto="{{ $nasabah->foto }}">
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
                                        data-id="{{ $nasabah->id }}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $nasabahs->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @include('bank_sampah_unit.nasabah.partials._modals')
@endsection

@section('scripts')
    @include('bank_sampah_unit.nasabah.partials._scripts')
@endsection
