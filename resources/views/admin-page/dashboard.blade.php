@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Dashboard</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div
            class="bg-gradient-to-r from-green-200 to-blue-200 p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
            <h3 class="text-lg font-bold text-slate-700 mb-2">
                Penjualan Sampah
            </h3>
            <p class="text-4xl font-bold">RP. 1.000.000</p>
            <p class="mt-2">
                <span class="text-sm text-gray-900">+10% per bulan</span>
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
            <h3 class="text-lg font-bold text-slate-700 mb-2">
                Sampah Terangkut
            </h3>
            <p class="text-4xl font-bold">120 KG</p>
            <p class="mt-2">
                <span class="text-sm text-gray-900">+20% per bulan</span>
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 border-l-8 border-l-hijau">
            <h3 class="text-lg font-bold text-slate-700 mb-2">
                Jumlah Nasabah
            </h3>
            <p class="text-3xl font-bold">50 Orang</p>
            {{-- <p class="mt-2">
                <span class="text-sm text-gray-900">+10% per bulan</span>
            </p> --}}
        </div>
    </div>
@endsection
