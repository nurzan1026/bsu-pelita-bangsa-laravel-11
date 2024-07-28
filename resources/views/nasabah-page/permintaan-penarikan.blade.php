@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Permintaan Penarikan</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="tambahPenarikanBtn" class="bg-primary text-white px-4 py-2 rounded-lg mr-2 hover:bg-primary">
                    Ajukan Penarikan
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari penarikan..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            No
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Jumlah Penarikan
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Status
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
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">$500</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Pending</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                            <button class="text-pribg-primary hover:text-pribg-primary mr-2"
                                onclick="openModal('lihatPenarikanModal')">
                                <i class="fas fa-eye bg-primary p-2 text-white rounded-md"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH PENARIKAN -->
    <div id="tambahPenarikanModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Ajukan Penarikan</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('tambahPenarikanModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="tanggalPenarikan" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="tanggalPenarikan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pribg-primary focus:border-pribg-primary sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jumlahPenarikan" class="block text-sm font-medium text-gray-700">Jumlah
                            Penarikan</label>
                        <input type="text" id="jumlahPenarikan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-pribg-primary focus:border-pribg-primary sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('tambahPenarikanModal')">Cancel</button>
                        <button type="submit"
                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL LIHAT PENARIKAN -->
    <div id="lihatPenarikanModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Detail Penarikan</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatPenarikanModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <p class="mt-1 text-gray-900">2024-07-01</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jumlah Penarikan</label>
                    <p class="mt-1 text-gray-900">$500</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-gray-900">Pending</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('lihatPenarikanModal')">Close</button>
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

        document.getElementById('tambahPenarikanBtn').addEventListener('click', function() {
            openModal('tambahPenarikanModal');
        });
    </script>
@endsection
