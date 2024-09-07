@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-4 sm:px-10 text-xl sm:text-2xl md:text-3xl font-bold tracking-wider mt-14">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 sm:w-7 sm:h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 9h6m-6 3h6m-6 3h6M6.996 9h.01m-.01 3h.01m-.01 3h.01M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                </svg>
            </div>
            <h1>Kategori</h1>
        </div>
    </div>
    <div class="w-full px-4 sm:px-0">
        <div class="bg-white mt-5 h-fit sm:mx-10 rounded-md p-4 sm:p-5">
            <div class="overflow-x-auto">
                <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-300 text-black text-xs sm:text-sm md:text-base">
                        <tr>
                            <th class="px-2 py-2 text-center font-bold uppercase tracking-wider border border-gray-300">ID
                            </th>
                            <th class="px-2 py-2 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Kategori</th>
                            <th class="px-2 py-2 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Jenis Sampah</th>
                            <th class="px-2 py-2 text-center font-bold uppercase tracking-wider border border-gray-300">
                                Harga</th>
                            <th class="px-2 py-2 text-center font-bold uppercase tracking-wider border border-gray-300">Poin
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-center text-xs sm:text-sm md:text-base">
                        @foreach ($sampahByKategori as $kategori => $sampahs)
                            @foreach ($sampahs as $sampah)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap border border-gray-300">{{ $sampah->id }}</td>
                                    <td class="px-2 py-2 text-white whitespace-nowrap border border-gray-300">
                                        <span
                                            class="inline-block px-2 py-1 rounded-md {{ $kategoriColors[$kategori] ?? 'bg-gray-500' }}">
                                            {{ $kategori }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap border border-gray-300">{{ $sampah->jenis }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap border border-gray-300">Rp
                                        {{ number_format($sampah->harga->price, 0, ',', '.') }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap border border-gray-300">{{ $sampah->poin }} pts
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
