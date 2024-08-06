@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Penarikan Poin</h1>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('nasabah.penarikan-poin.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="namaNasabah" class="block text-sm font-medium text-gray-700">Nama Nasabah</label>
                <input type="text" id="namaNasabah" name="nama"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required />
            </div>
            <div class="mb-4">
                <label for="tanggalPenarikan" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="tanggalPenarikan" name="tanggal"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required />
            </div>
            <div class="mb-4">
                <label for="opsiPenarikanPoin" class="block text-sm font-medium text-gray-700">Pilih Opsi Penarikan
                    Poin</label>
                <select id="opsiPenarikanPoin" name="opsi"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required>
                    <option value="">Pilih Opsi</option>
                    <option value="minyak">Minyak</option>
                    <option value="sembako">Sembako</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="jumlahPenarikan" class="block text-sm font-medium text-gray-700">Jumlah Poin</label>
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
