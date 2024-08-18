@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6 text-center">
        <h1 class="font-bold text-3xl text-gray-900">Penarikan Saldo</h1>
    </div>

    <!-- Membatasi lebar form -->
    <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
        @if (session('success'))
            <div class="bg-green-700 text-white p-4 rounded-md mb-4 font-semibold">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('nasabah.penarikan-saldo.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tanggalPenarikan" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggalPenarikan" name="tanggal"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required />
            </div>
            <div class="mb-4">
                <label for="jumlahPenarikan" class="block text-sm font-medium text-gray-700">Jumlah Penarikan</label>
                <input type="number" id="jumlahPenarikan" name="jumlah"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required />
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary">Ajukan
                    Penarikan</button>
            </div>
        </form>
    </div>
@endsection
