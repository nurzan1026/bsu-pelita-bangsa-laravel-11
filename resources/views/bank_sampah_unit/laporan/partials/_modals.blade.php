<!-- Modal tambah penjualan -->
<div id="modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-[53%] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Penjualan Sampah</h2>
                <button id="close-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form id="modal-form" action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input id="tanggal" name="tanggal_jual" type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="pembeli" class="block text-sm font-medium text-gray-700">Pembeli</label>
                    <select id="pembeli" name="pembeli"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                        <option value="Bank Sampah Unit">Bank Sampah Unit</option>
                        <option value="Vendor">Vendor</option>
                    </select>
                </div>
                <div id="vendor-name-container" class="mb-4 hidden">
                    <label for="vendor_name" class="block text-sm font-medium text-gray-700">Nama Vendor</label>
                    <input id="vendor_name" name="vendor_name" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                </div>
                <div id="input-fields">
                    <div class="flex items-center mb-4">
                        <div class="w-1/2">
                            <label for="jenis-sampah-1" class="block text-sm font-medium text-gray-700">Jenis
                                Sampah</label>
                            <select id="jenis-sampah-1" name="jenis_sampah[]"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                required>
                                <option value="" selected disabled>Pilih Jenis Sampah</option>
                                @foreach ($sampahs as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 ml-4">
                            <label for="berat-sampah-1" class="block text-sm font-medium text-gray-700">Berat sampah
                                (Kg)</label>
                            <input id="berat-sampah-1" name="berat[]" type="number" step="0.01"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                required>
                        </div>
                        <div id="harga-per-kg-container-1" class="w-1/2 ml-4 hidden">
                            <label for="harga-sampah-1" class="block text-sm font-medium text-gray-700">Harga per
                                Kg</label>
                            <input id="harga-sampah-1" name="harga_per_kg[]" type="number" step="0.01"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                        <button type="button" class="ml-4 text-green-500 hover:text-green-700" id="add-field">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="reset"
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700">Reset</button>
                    <button type="submit"
                        class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal untuk Daur Ulang -->
<div id="daurUlangModalContainer" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Daur Ulang</h2>
                <button id="closeDaurUlangModalButton"
                    class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form action="{{ route('daur_ulang.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="tanggal_daur_ulang" class="block text-sm font-medium text-gray-700">Tanggal Daur
                        Ulang</label>
                    <input type="date" name="tanggal_daur_ulang" id="tanggal_daur_ulang" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                </div>
                <div id="jenisSampahDaurUlangContainer">
                    <div class="mb-4 flex items-center">
                        <div class="w-1/2 mr-2">
                            <label for="jenis_sampah" class="block text-sm font-medium text-gray-700">Jenis
                                Sampah</label>
                            <select name="jenis_sampah[]" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                                <option value="" selected disabled>Pilih Jenis Sampah</option>
                                @foreach ($sampahs as $sampah)
                                    <option value="{{ $sampah->id }}">{{ $sampah->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 ml-2">
                            <label for="berat" class="block text-sm font-medium text-gray-700">Berat (kg)</label>
                            <input type="number" name="berat[]" step="0.01" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                        </div>
                        <button type="button" id="addJenisSampahDaurUlang"
                            class="ml-4 text-green-500 hover:text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="reset"
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700">Reset</button>
                    <button type="submit"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
