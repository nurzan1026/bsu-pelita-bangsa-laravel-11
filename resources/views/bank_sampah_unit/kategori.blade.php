@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-10 text-3xl font-bold tracking-wider">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 9h6m-6 3h6m-6 3h6M6.996 9h.01m-.01 3h.01m-.01 3h.01M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                </svg>
            </div>
            <h1>Kategori</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="bg-white mt-5 h-fit mx-10 rounded-md p-5">
            @foreach ($sampahByKategori as $kategori => $sampahs)
                <section class="mb-8">
                    <h3
                        class="text-xl font-bold mb-4 text-white text-center py-2 rounded-md {{ $kategoriColors[$kategori] ?? 'bg-gray-500' }}">
                        {{ strtoupper($kategori) }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($sampahs as $sampah)
                            <div class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl">
                                <img src="{{ asset('img/fotoJenisSampah/sampah.jpg') }}" alt="{{ $sampah->jenis }}"
                                    class="w-full h-40 object-cover rounded-md mb-2">
                                <h4 class="text-lg font-semibold">{{ $sampah->jenis }}</h4>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                                    </svg> :
                                    Rp {{ number_format($sampah->harga->harga, 0, ',', '.') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white mr-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z" />
                                    </svg> :
                                    {{ $sampah->poin }} pts
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </div>
@endsection
