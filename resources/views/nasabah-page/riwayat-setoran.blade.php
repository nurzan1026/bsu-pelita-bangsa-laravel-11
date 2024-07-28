@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Setoran</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <input type="text" placeholder="Cari setoran..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            No
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Jenis Sampah
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Berat (kg)
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Total Poin
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">1</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">2024-07-01</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Plastik</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">10 kg</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">100</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                            <button class="text-blue-500 hover:text-blue-900" onclick="openModal('lihatModal')">
                                <i class="fas fa-eye bg-blue-500 p-2 text-white rounded-md"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL LIHAT -->
    <div id="lihatModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Lihat Setoran</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <p class="mt-1 text-gray-900">2024-07-01</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                    <p class="mt-1 text-gray-900">Plastik</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                    <p class="mt-1 text-gray-900">10 kg</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Total Poin</label>
                    <p class="mt-1 text-gray-900">100</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('lihatModal')">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
