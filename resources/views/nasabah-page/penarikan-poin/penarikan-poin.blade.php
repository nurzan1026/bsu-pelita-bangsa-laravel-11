@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6 text-center">
        <h1 class="font-bold text-3xl text-gray-900">Penarikan Poin</h1>
        <p class="text-gray-600 mt-2">Ajukan penarikan poin Anda dan tukarkan dengan hadiah yang tersedia.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
        @if (session('success'))
            <div class="bg-green-700 text-white p-4 rounded-md mb-4 font-semibold">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('nasabah.penarikan-poin.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="tanggalPenarikan" class="block text-sm font-medium text-gray-700">Tanggal Penarikan</label>
                <input type="date" id="tanggalPenarikan" name="tanggal"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required />
            </div>
            <div class="mb-4">
                <label for="rewardItem" class="block text-sm font-medium text-gray-700">Pilih Hadiah</label>
                <select id="rewardItem" name="reward_item_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                    required>
                    <option value="" disabled selected>Pilih Hadiah</option>
                    @foreach ($rewardItems as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->poin }} Poin)</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <div class="border-t border-gray-300 my-4"></div>
                <p class="text-gray-500 text-sm">Pastikan data yang Anda masukkan sudah benar sebelum mengajukan penarikan.
                </p>
            </div>
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark focus:ring-2 focus:ring-primary focus:ring-opacity-50">Ajukan
                    Penarikan</button>
            </div>
        </form>
    </div>
@endsection
