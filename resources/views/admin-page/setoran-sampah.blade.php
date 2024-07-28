@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Setoran sampah</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="tambahSetoranBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                    Tambah Setoran
                </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Cetak
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
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
                            Nasabah
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Setor
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Jumlah Setoran
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Total Poin
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Total Setoran
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">1</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Ali Ahmad</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">2024-07-01</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">100 kg</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">10.000</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">50</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">$100</td>
                        <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                            <button class="text-blue-500 hover:text-blue-900 mr-2" onclick="openModal('lihatModal')">
                                <i class="fas fa-eye bg-blue-500 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-yellow-500 hover:text-yellow-900 mr-2" onclick="openModal('editModal')">
                                <i class="fas fa-edit bg-yellow-500 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-900" onclick="openModal('hapusModal')">
                                <i class="fas fa-trash bg-red-500 p-2 text-white rounded-md"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH SETORAN -->
    <div id="tambahModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Setoran</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('tambahModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="nasabah" class="block text-sm font-medium text-gray-700">Nasabah</label>
                        <input type="text" id="nasabah"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="tanggal"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="setor" class="block text-sm font-medium text-gray-700">Setor</label>
                        <input type="text" id="setor"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jumlahSetoran" class="block text-sm font-medium text-gray-700">Jumlah
                            Setoran</label>
                        <input type="text" id="jumlahSetoran"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="totalPoin" class="block text-sm font-medium text-gray-700">Total Poin</label>
                        <input type="text" id="totalPoin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="totalSetoran" class="block text-sm font-medium text-gray-700">Total Setoran</label>
                        <input type="text" id="totalSetoran"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('tambahModal')">Cancel</button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Save</button>
                    </div>
                </form>
            </div>
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
                    <label class="block text-sm font-medium text-gray-700">Nasabah</label>
                    <p class="mt-1 text-gray-900">Ali Ahmad</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <p class="mt-1 text-gray-900">2024-07-01</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Setor</label>
                    <p class="mt-1 text-gray-900">100 kg</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jumlah Setoran</label>
                    <p class="mt-1 text-gray-900">10.000</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Total Poin</label>
                    <p class="mt-1 text-gray-900">50</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Total Setoran</label>
                    <p class="mt-1 text-gray-900">$100</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('lihatModal')">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="editModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Setoran</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="editNasabah" class="block text-sm font-medium text-gray-700">Nasabah</label>
                        <input type="text" id="editNasabah" value="Ali Ahmad"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="editTanggal" value="2024-07-01"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editSetor" class="block text-sm font-medium text-gray-700">Setor</label>
                        <input type="text" id="editSetor" value="100 kg"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editJumlahSetoran" class="block text-sm font-medium text-gray-700">Jumlah
                            Setoran</label>
                        <input type="text" id="editJumlahSetoran" value="10.000"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTotalPoin" class="block text-sm font-medium text-gray-700">Total Poin</label>
                        <input type="text" id="editTotalPoin" value="50"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTotalSetoran" class="block text-sm font-medium text-gray-700">Total
                            Setoran</label>
                        <input type="text" id="editTotalSetoran" value="$100"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit"
                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS -->
    <div id="hapusModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Hapus Setoran</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('hapusModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div>
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('hapusModal')">Tidak</button>
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">Ya</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // TAMBAH SETORAN
        document.getElementById("tambahSetoranBtn").addEventListener("click", function() {
            document.getElementById("tambahModal").classList.remove("hidden");
        });

        // Open Modal Function
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove("hidden");
        }

        // Close Modal Function
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }
    </script>
@endsection
