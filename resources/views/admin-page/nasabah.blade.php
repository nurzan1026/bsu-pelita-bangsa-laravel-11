@extends('components.admin.layout-admin')

@section('content')
    <!-- Main Content -->
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">
            Data Nasabah Bank Sampah Pelita Bangsa
        </h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            {{-- <div>
                <button id="tambahNasabahBtn"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                    Tambah Nasabah
                </button>
            </div> --}}
            <div class="flex justify-between mb-4">
                <button id="tambahNasabahBtn" class="bg-primary text-white font-bold py-2 px-4 rounded-md hover:bg-green-600">
                    <span class="material-icons align-middle">add</span>
                    <span class="align-middle">Tambah Nasabah</span>
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari nama nasabah..."
                    class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            No
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            No. Induk
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Nama
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Alamat
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Jumlah Orang/KK
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">1</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">12345</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">Budi Santoso</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">Jl. Merdeka No.1</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">4</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            <button class="text-blue-600 hover:text-blue-900 mr-2" onclick="openModal('lihatModal')">
                                <i class="fas fa-eye  bg-blue-500 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-yellow-600 hover:text-yellow-900 mr-2" onclick="openModal('editModal')">
                                <i class="fas fa-edit bg-yellow-500 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900" onclick="openModal('hapusModal')">
                                <i class="fas fa-trash bg-red-500 p-2 text-white rounded-md"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH NASABAH -->
    <div id="modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Nasabah</h3>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="noInduk" class="block text-sm font-medium text-gray-700">No. Induk</label>
                        <input type="text" id="noInduk"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jumlahOrang" class="block text-sm font-medium text-gray-700">Jumlah Orang/KK</label>
                        <input type="text" id="jumlahOrang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            id="closeModalBtn2">Cancel</button>
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
                    <h3 class="text-2xl leading-6 font-bold text-primary">Lihat Data Nasabah</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div>
                    <!-- Tampilkan data nasabah di sini -->
                    <p>No. Induk: 12345</p>
                    <p>Nama: Budi Santoso</p>
                    <p>Alamat: Jl. Merdeka No.1</p>
                    <p>Jumlah Orang/KK: 4</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400"
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
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Data Nasabah</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="editNoInduk" class="block text-sm font-medium text-gray-700">No. Induk</label>
                        <input type="text" id="editNoInduk"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm"
                            value="12345" />
                    </div>
                    <div class="mb-4">
                        <label for="editNama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="editNama"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm"
                            value="Budi Santoso" />
                    </div>
                    <div class="mb-4">
                        <label for="editAlamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="editAlamat"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm"
                            value="Jl. Merdeka No.1" />
                    </div>
                    <div class="mb-4">
                        <label for="editJumlahOrang" class="block text-sm font-medium text-gray-700">Jumlah
                            Orang/KK</label>
                        <input type="text" id="editJumlahOrang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm"
                            value="4" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Save</button>
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
                    <h3 class="text-2xl leading-6 font-bold text-primary">Hapus Data Nasabah</h3>
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
        // TAMBAH NASABAH
        document.getElementById("tambahNasabahBtn").addEventListener("click", function() {
            document.getElementById("modal").classList.remove("hidden");
        });

        document.getElementById("closeModalBtn").addEventListener("click", function() {
            document.getElementById("modal").classList.add("hidden");
        });

        document.getElementById("closeModalBtn2").addEventListener("click", function() {
            document.getElementById("modal").classList.add("hidden");
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
