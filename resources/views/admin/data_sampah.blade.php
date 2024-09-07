@extends('admin.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Data Sampah</h1>
    <div class="flex justify-end mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal('addModal')">
            Tambah Data Sampah
        </button>
    </div>
    <div class="bg-white shadow-md rounded overflow-y-auto" style="max-height: 80vh;">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Sampah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Sampah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Sampah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($dataSampahs as $sampah)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sampah->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sampah->kategori }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sampah->jenis }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $sampah->foto) }}" alt="Foto Sampah" class="h-20 w-20 object-cover">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="openEditModal('{{ $sampah->id }}')">Edit</button>
                        <form action="{{ route('admin.data_sampah.destroy', $sampah->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Tambah Data Sampah -->
<div id="addModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Data Sampah</h3>
            <div class="mt-2">
                <form action="{{ route('admin.data_sampah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700">ID:</label>
                        <input type="text" id="id" name="id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Sampah:</label>
                        <input type="text" id="kategori" name="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Sampah:</label>
                        <input type="text" id="jenis" name="jenis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto Sampah:</label>
                        <input type="file" id="foto" name="foto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal('addModal')">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Data Sampah -->
@foreach($dataSampahs as $sampah)
<div id="editModal-{{ $sampah->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Data Sampah</h3>
            <div class="mt-2">
                <form action="{{ route('admin.data_sampah.update', $sampah->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="id" class="block text-sm font-medium text-gray-700">ID:</label>
                        <input type="text" id="id" name="id" value="{{ $sampah->id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Sampah:</label>
                        <input type="text" id="kategori" name="kategori" value="{{ $sampah->kategori }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Sampah:</label>
                        <input type="text" id="jenis" name="jenis" value="{{ $sampah->jenis }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto Sampah:</label>
                        <input type="file" id="foto" name="foto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <img src="{{ asset('storage/' . $sampah->foto) }}" alt="Foto Sampah" class="h-20 w-20 object-cover mt-2">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal('editModal-{{ $sampah->id }}')">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(id) {
        document.getElementById('editModal-' + id).classList.remove('hidden');
    }
</script>
@endsection
