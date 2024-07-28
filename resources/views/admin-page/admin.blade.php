@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Manajemen Admin</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="tambahAdminBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                    Tambah Admin
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari admin..." class="px-4 py-2 border border-gray-300 rounded-lg" />
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
                            Nama
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Alamat
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            No. HP/WA
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Email
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Jabatan
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            1
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            Admin 1
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            Jl. Merdeka No.1
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            081234567890
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            admin1@example.com
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            Superadmin
                        </td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            <button class="text-blue-600 hover:text-blue-900 mr-2" onclick="openModal('lihatModal')">
                                <i class="fas fa-eye  bg-blue-500 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-yellow-600 hover:text-yellow-900 mr-2" onclick="openModal('editModal')">
                                <i class="fas fa-edit  bg-yellow-600 p-2 text-white rounded-md"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900" onclick="openModal('hapusModal')">
                                <i class="fas fa-trash  bg-red-600 p-2 text-white rounded-md"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH ADMIN --}}
    <div id="tambahModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('tambahModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="namaAdmin" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="namaAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="alamatAdmin" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamatAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="noHpAdmin" class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                        <input type="text" id="noHpAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="emailAdmin" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="emailAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jabatanAdmin" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select id="jabatanAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm">
                            <option value="Admin">Admin</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Sekretaris">Sekretaris</option>
                        </select>
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

    {{-- MODAL LIHAT ADMIN --}}
    <div id="lihatModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Lihat Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <p class="mt-1 text-gray-900">Admin 1</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <p class="mt-1 text-gray-900">Jl. Merdeka No.1</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                    <p class="mt-1 text-gray-900">081234567890</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-gray-900">admin1@example.com</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <p class="mt-1 text-gray-900">Superadmin</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('lihatModal')">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT ADMIN --}}
    <div id="editModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="editNamaAdmin" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="editNamaAdmin" value="Admin 1"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editAlamatAdmin" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="editAlamatAdmin" value="Jl. Merdeka No.1"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editNoHpAdmin" class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                        <input type="text" id="editNoHpAdmin" value="081234567890"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editEmailAdmin" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="editEmailAdmin" value="admin1@example.com"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editJabatanAdmin" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select id="editJabatanAdmin"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm">
                            <option value="Admin">Admin</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Sekretaris">Sekretaris</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS ADMIN --}}
    <div id="hapusModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Hapus Admin</h3>
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
        // Open Modal Function
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove("hidden");
        }

        // Close Modal Function
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }

        // Tambah Admin Button
        document.getElementById("tambahAdminBtn").addEventListener("click", function() {
            openModal('tambahModal');
        });
    </script>
@endsection
