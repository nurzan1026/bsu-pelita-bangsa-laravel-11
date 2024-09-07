@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="flex flex-col space-y-6">
        <!-- Dashboard Header -->
        <div class="bg-primary text-white p-6 rounded-lg shadow-md flex flex-col">
            <h1 class="text-3xl font-bold">Dashboard Nasabah</h1>
            <p class="mt-2 text-lg">Selamat datang, {{ $nasabah->nama }}!</p>
        </div>


        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border border-blue-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Total Setoran</h2>
                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalBerat }} kg</p>
                </div>
                <div class="bg-blue-100 p-2 rounded-full">
                    <span class="material-icons text-blue-600 p-2">recycling</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border border-green-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Total Poin</h2>
                    <p class="mt-2 text-2xl font-bold text-gray-800">{{ $totalPoin }} Poin</p>
                </div>
                <div class="bg-green-100 p-2 rounded-full">
                    <span class="material-icons text-green-600 p-2">star</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between border border-yellow-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Total Tabungan</h2>
                    <p class="mt-2 text-2xl font-bold text-gray-800">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</p>
                </div>
                <div class="bg-yellow-100 p-2 rounded-full">
                    <span class="material-icons text-yellow-600 p-2">receipt_long</span>
                </div>
            </div>
        </div>
    </div>
@endsection
