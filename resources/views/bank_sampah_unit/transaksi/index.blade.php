@extends('bank_sampah_unit.layout')

@section('content')
    <div class="w-full px-4 md:px-10 text-2xl md:text-3xl font-bold tracking-wider mt-14">
        <div class="w-fit pb-2 flex items-center gap-2">
            <div class="w-10 h-10 bg-purple-400 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                </svg>
            </div>
            <h1 class="text-center sm:text-left">Transaksi Penarikan</h1>
        </div>
    </div>
    <div class="w-full px-4 md:px-10">
        <div class="bg-white mt-5 h-fit rounded-md p-5">
            <h2 class="text-xl md:text-2xl font-bold mb-4">Penarikan Poin</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-300">
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Tanggal Penarikan</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Jenis Penarikan</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Nasabah</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Jumlah Poin</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm text-center">Aksi</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penarikansPoin as $penarikanPoin)
                            <tr>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanPoin->tanggal }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanPoin->rewardItem->name }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanPoin->nasabah->nama }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanPoin->rewardItem->poin }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <form
                                            action="{{ route('unit.penarikan-approval.poin.approve', $penarikanPoin->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-500 hover:text-green-700">
                                                <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('unit.penarikan-approval.poin.reject', $penarikanPoin->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ ucfirst($penarikanPoin->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h2 class="text-xl md:text-2xl font-bold mt-10 mb-4">Penarikan Saldo</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-300">
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Tanggal Penarikan</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Jenis Penarikan</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Nasabah</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Jumlah Penarikan</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm text-center">Aksi</th>
                            <th class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penarikansSaldo as $penarikanSaldo)
                            <tr>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanSaldo->tanggal }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">Saldo</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanSaldo->nasabah->nama }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ $penarikanSaldo->jumlah }}</td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <form
                                            action="{{ route('unit.penarikan-approval.saldo.approve', $penarikanSaldo->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-500 hover:text-green-700">
                                                <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form
                                            action="{{ route('unit.penarikan-approval.saldo.reject', $penarikanSaldo->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="border border-gray-200 px-2 md:px-4 py-2 text-xs md:text-sm">
                                    {{ ucfirst($penarikanSaldo->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
