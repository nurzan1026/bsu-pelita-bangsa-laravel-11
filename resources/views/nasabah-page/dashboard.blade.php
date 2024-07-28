@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="flex flex-col space-y-6">
        <!-- Dashboard Header -->
        <div class="bg-primary text-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold">Dashboard Nasabah</h1>
            <p class="mt-2 text-lg">Selamat datang, [Nama Nasabah]!</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-900">Total Setoran</h2>
                <p class="mt-2 text-2xl font-bold text-gray-800">120 kg</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-900">Total Poin</h2>
                <p class="mt-2 text-2xl font-bold text-gray-800">1500 Poin</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-900">Total Transaksi</h2>
                <p class="mt-2 text-2xl font-bold text-gray-800">15 Transaksi</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-900">Aktivitas Terbaru</h2>
            <div class="mt-4">
                <ul class="space-y-4">
                    <li class="border-b pb-2">
                        <p class="text-gray-800">Setoran sampah pada 2024-07-01: 10 kg Plastik</p>
                        <p class="text-gray-600 text-sm">Total Poin: 100</p>
                    </li>
                    <li class="border-b pb-2">
                        <p class="text-gray-800">Setoran sampah pada 2024-06-15: 15 kg Kertas</p>
                        <p class="text-gray-600 text-sm">Total Poin: 150</p>
                    </li>
                    <!-- Tambahkan lebih banyak aktivitas sesuai kebutuhan -->
                </ul>
            </div>
        </div>
    </div>
@endsection
