<!-- Modal tambah setoran -->
<div id="modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-[53%] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Setoran Sampah</h2>
                <button id="close-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form id="modal-form" action="{{ route('setoran.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input id="tanggal" name="tanggal_setor" type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="nasabah-nama" class="block text-sm font-medium text-gray-700">Nama Nasabah</label>
                    <input id="nasabah-input" name="nasabah_id" type="hidden">
                    <input id="nasabah-nama" type="text"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        placeholder="Cari nama nasabah..." autocomplete="off" required>
                    <div id="search-results"
                        class="absolute z-10 mt-1 w-2/5 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto hidden">
                    </div>
                </div>
                <div id="input-fields">
                    <div class="flex items-center mb-4">
                        <div class="w-1/2">
                            <label for="jenis-sampah-1" class="block text-sm font-medium text-gray-700">Jenis
                                Sampah</label>
                            <select id="jenis-sampah-1" name="detail_setoran[0][waste_id]"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                required>
                                @foreach ($sampah as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 ml-4">
                            <label for="berat-sampah-1" class="block text-sm font-medium text-gray-700">Berat sampah
                                (Kg)</label>
                            <input id="berat-sampah-1" name="detail_setoran[0][berat]" type="number" step="0.01"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                required>
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

<!-- Detail Modal -->
<div id="detail-modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-auto overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Detail Setoran</h2>
                <button id="close-detail-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <div id="detail-content">
                <!-- Detail content will be inserted here -->
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button id="close-detail-button-bottom"
                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal  -->
<div id="edit-modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-[53%] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Setoran Sampah</h2>
                <button id="close-edit-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit-tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input id="edit-tanggal" name="tanggal_setor" type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-nasabah-nama" class="block text-sm font-medium text-gray-700">Nama Nasabah</label>
                    <input id="edit-nasabah-input" name="nasabah_id" type="hidden">
                    <input id="edit-nasabah-nama" type="text"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        placeholder="Cari nama nasabah..." autocomplete="off" required>
                    <div id="edit-search-results"
                        class="absolute z-10 mt-1 w-2/5 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto hidden">
                    </div>
                </div>
                <div id="edit-input-fields"></div>
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
