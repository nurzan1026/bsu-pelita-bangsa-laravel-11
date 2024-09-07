<!-- resources/views/bank_sampah_pusat/edit_permintaan.blade.php -->
@extends('bank_sampah_pusat.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Permintaan Pengangkutan</h1>
    <div class="bg-white shadow-md rounded my-6 p-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form id="editPermintaanForm" action="{{ route('pusat.permintaan_pengangkutan.update', $permintaan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            @foreach($permintaan->sampah as $index => $sampah)
                <div class="mb-4">
                    <label for="sampah-{{ $index }}-kategori" class="block text-sm font-medium text-gray-700">Kategori Sampah</label>
                    <input type="text" id="sampah-{{ $index }}-kategori" name="sampah[{{ $index }}][kategori_sampah]" value="{{ $sampah['kategori_sampah'] }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div class="mb-4">
                    <label for="sampah-{{ $index }}-nama" class="block text-sm font-medium text-gray-700">Nama Sampah</label>
                    <input type="text" id="sampah-{{ $index }}-nama" name="sampah[{{ $index }}][nama_sampah]" value="{{ $sampah['nama_sampah'] }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div class="mb-4">
                    <label for="sampah-{{ $index }}-berat" class="block text-sm font-medium text-gray-700">Berat</label>
                    <input type="number" step="0.01" id="sampah-{{ $index }}-berat" name="sampah[{{ $index }}][berat]" value="{{ $sampah['berat'] }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" oninput="calculateTotalBerat()">
                </div>
            @endforeach

            <div class="mb-4">
                <label for="total_berat" class="block text-sm font-medium text-gray-700">Total Berat</label>
                <input type="number" step="0.01" id="total_berat" name="total_berat" value="{{ $permintaan->total_berat }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" readonly>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="Menunggu Konfirmasi" @if($permintaan->status == 'Menunggu Konfirmasi') selected @endif>Menunggu Konfirmasi</option>
                    <option value="Diproses" @if($permintaan->status == 'Diproses') selected @endif>Diproses</option>
                    <option value="Tanggal Pengambilan Telah Terbit" @if($permintaan->status == 'Tanggal Pengambilan Telah Terbit') selected @endif>Tanggal Pengambilan Telah Terbit</option>
                    <option value="Menuju Tempat Anda" @if($permintaan->status == 'Menuju Tempat Anda') selected @endif>Menuju Tempat Anda</option>
                    <option value="Selesai" @if($permintaan->status == 'Selesai') selected @endif>Selesai</option>
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('pusat.permintaan_pengangkutan') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function calculateTotalBerat() {
        let totalBerat = 0;
        document.querySelectorAll('input[id^="sampah-"][id$="-berat"]').forEach(input => {
            totalBerat += parseFloat(input.value) || 0;
        });
        document.getElementById('total_berat').value = totalBerat.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        calculateTotalBerat();
    });
</script>
@endsection
