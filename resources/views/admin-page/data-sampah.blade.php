@extends('components.admin.layout-admin')

@section('content')
    <!-- Main conten -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Tombol Aksi -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex justify-between mb-4">
                <button id="addWasteButton" class="bg-hijau text-white font-bold py-2 px-4 rounded-md hover:bg-green-600">
                    <span class="material-icons align-middle">add</span>
                    <span class="align-middle">Tambah Jenis Sampah</span>
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <!-- Tabel Data Sampah -->
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-hijau text-white">
                <tr>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        No</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Tanggal</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Kategori</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Jenis Sampah</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        KG</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Debet</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Kredit</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Saldo</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white" id="wasteTableBody">
                <tr>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">1</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">01/01/2023</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">Plastik</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">Botol Plastik</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">10</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">50000</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">30000</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">20000</td>
                    <td class="px-6 py-4 text-center border-2 border-gray-300">
                        <button class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="openEditModal()">
                            <span class="material-icons align-middle">edit</span>
                        </button>
                        <button class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 ml-2"
                            onclick="openDeleteModal()">
                            <span class="material-icons align-middle">delete</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Sampah -->
    <div id="addWasteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"
                    onclick="closeModal('addWasteModal')">
                    <i class="fas fa-times"></i> <!-- Ganti dengan ikon yang diinginkan -->
                </button>
                <h2 class="text-xl font-bold mb-4">Tambah Jenis Sampah</h2>
                <form>
                    <div class="mb-4">
                        <label for="inputDate" class="block text-sm font-bold mb-2">Tanggal Penginputan</label>
                        <input type="date" id="inputDate" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="categorySelectModal" class="block text-sm font-bold mb-2">Pilih Kategori
                            Sampah</label>
                        <select id="categorySelectModal" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="plastik">Plastik</option>
                            <option value="logam">Logam</option>
                            <option value="kertas">Kertas</option>
                            <option value="botol_kaca">Botol Kaca</option>
                            <option value="minyak_jelanta">Minyak Jelanta</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="wasteTypeSelect" class="block text-sm font-bold mb-2">Pilih Jenis Sampah</label>
                        <select id="wasteTypeSelect" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <!-- Opsi akan diisi secara dinamis berdasarkan kategori -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="inputKg" class="block text-sm font-bold mb-2">Jumlah (kg)</label>
                        <input type="number" id="inputKg" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="inputDebet" class="block text-sm font-bold mb-2">Debet</label>
                        <input type="number" id="inputDebet" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="inputKredit" class="block text-sm font-bold mb-2">Kredit</label>
                        <input type="number" id="inputKredit" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2"
                            onclick="closeModal('addWasteModal')">Batal</button>
                        <button type="submit" class="bg-hijau text-white font-bold py-2 px-4 rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Sampah -->
    <div id="editWasteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"
                    onclick="closeModal('editWasteModal')">
                    <i class="fas fa-times"></i> <!-- Ganti dengan ikon yang diinginkan -->
                </button>
                <h2 class="text-xl font-bold mb-4">Edit Jenis Sampah</h2>
                <form>
                    <div class="mb-4">
                        <label for="editInputDate" class="block text-sm font-bold mb-2">Tanggal Penginputan</label>
                        <input type="date" id="editInputDate"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editCategorySelect" class="block text-sm font-bold mb-2">Pilih Kategori
                            Sampah</label>
                        <select id="editCategorySelect" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="plastik">Plastik</option>
                            <option value="logam">Logam</option>
                            <option value="kertas">Kertas</option>
                            <option value="botol_kaca">Botol Kaca</option>
                            <option value="minyak_jelanta">Minyak Jelanta</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editWasteTypeSelect" class="block text-sm font-bold mb-2">Pilih Jenis
                            Sampah</label>
                        <select id="editWasteTypeSelect" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <!-- Opsi akan diisi secara dinamis berdasarkan kategori -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editInputKg" class="block text-sm font-bold mb-2">Jumlah (kg)</label>
                        <input type="number" id="editInputKg"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editInputDebet" class="block text-sm font-bold mb-2">Debet</label>
                        <input type="number" id="editInputDebet"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editInputKredit" class="block text-sm font-bold mb-2">Kredit</label>
                        <input type="number" id="editInputKredit"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2"
                            onclick="closeModal('editWasteModal')">Batal</button>
                        <button type="submit" class="bg-hijau text-white font-bold py-2 px-4 rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"
                    onclick="closeModal('deleteConfirmationModal')">
                    <i class="fas fa-times"></i> <!-- Ganti dengan ikon yang diinginkan -->
                </button>
                <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-4">Apakah Anda yakin untuk menghapus data ini?</p>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2"
                        onclick="closeModal('deleteConfirmationModal')">Batal</button>
                    <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wasteData = {
                plastik: ['Botol Plastik', 'Kantong Plastik', 'Ember Plastik', 'Sedotan Plastik',
                    'Wadah Plastik'
                ],
                logam: ['Besi Tipis', 'Kaleng', 'Perunggu', 'Aluminium', 'Baja'],
                kertas: ['Kertas Putih', 'Kertas Buram', 'Kertas Karton', 'Kertas Koran', 'Majalah'],
                botol_kaca: ['Botol Bening', 'Botol Berwarna', 'Gelas Kaca', 'Jendela Kaca', 'Piring Kaca'],
                minyak_jelanta: ['Minyak Goreng', 'Minyak Industri', 'Minyak Mesin', 'Minyak Zaitun',
                    'Minyak Kelapa'
                ]
            };

            function populateWasteTypes(categorySelectId, wasteTypeSelectId) {
                const categorySelect = document.getElementById(categorySelectId);
                const wasteTypeSelect = document.getElementById(wasteTypeSelectId);
                const selectedCategory = categorySelect.value;

                wasteTypeSelect.innerHTML = '';
                if (wasteData[selectedCategory]) {
                    wasteData[selectedCategory].forEach((item) => {
                        const option = document.createElement('option');
                        option.value = item;
                        option.textContent = item;
                        wasteTypeSelect.appendChild(option);
                    });
                }
            }

            // Inisialisasi select jenis sampah saat kategori berubah
            document.getElementById('categorySelectModal').addEventListener('change', function() {
                populateWasteTypes('categorySelectModal', 'wasteTypeSelect');
            });
            document.getElementById('editCategorySelect').addEventListener('change', function() {
                populateWasteTypes('editCategorySelect', 'editWasteTypeSelect');
            });

            // Populasi awal
            populateWasteTypes('categorySelectModal', 'wasteTypeSelect');
            populateWasteTypes('editCategorySelect', 'editWasteTypeSelect');

            // Fungsi modal
            window.openModal = function(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
            };

            window.closeModal = function(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            };

            document.getElementById('addWasteButton').addEventListener('click', function() {
                openModal('addWasteModal');
            });

            window.openEditModal = function() {
                openModal('editWasteModal');
            };

            window.openDeleteModal = function() {
                openModal('deleteConfirmationModal');
            };
        });
    </script>
@endsection
