<!-- Add Nasabah Modal -->
<div id="modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-[70%] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Nasabah Baru</h2>
                <button id="close-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form id="modal-form" action="{{ route('nasabah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="nama" name="nama" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                    <input id="nomor_induk" name="nomor_induk" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input id="username" name="username" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="alamat" name="alamat"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                    <input id="foto" name="foto" type="file" accept="image/*"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
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

<!-- Edit Nasabah Modal -->
<div id="edit-modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded shadow-lg w-1/2 h-[70%] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Nasabah</h2>
                <button id="edit-close-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <form id="edit-modal-form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit-nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="edit-nama" name="nama" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                    <input id="edit-nomor_induk" name="nomor_induk" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input id="edit-username" name="username" type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="edit-email" name="email" type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="edit-alamat" name="alamat"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="edit-foto" class="block text-sm font-medium text-gray-700">Foto</label>
                    <input id="edit-foto" name="foto" type="file" accept="image/*"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
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

<!-- Modal for Nasabah Details -->
<div id="detail-modal" class="fixed inset-0 z-20 hidden bg-gray-800 bg-opacity-50">
    <div class="w-full flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 max-w-4xl h-auto overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Detail Nasabah</h2>
                <button id="detail-close-button" class="text-3xl text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <div id="nasabah-detail" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col items-center md:items-start">
                    <img id="detail-foto" src="" alt="Foto Nasabah"
                        class="w-32 h-32 object-cover rounded-full shadow mb-4">
                    <h3 class="text-xl font-semibold text-gray-900" id="detail-nama"></h3>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <span class="text-gray-600 font-medium">Nomor Induk:</span>
                        <span id="detail-nomor_induk" class="ml-2 text-gray-800"></span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-600 font-medium">Username:</span>
                        <span id="detail-username" class="ml-2 text-gray-800"></span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span id="detail-email" class="ml-2 text-gray-800"></span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-600 font-medium">Alamat:</span>
                        <span id="detail-alamat" class="ml-2 text-gray-800"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
