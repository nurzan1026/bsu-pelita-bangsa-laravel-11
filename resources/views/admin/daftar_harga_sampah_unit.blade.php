@extends('admin.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Harga Sampah Bank Sampah Unit</h1>
    <div class="flex justify-between mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="openModal('addModal')">
            Tambah Harga Sampah
        </button>
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari ID atau Jenis Sampah..." class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="bg-white shadow-md rounded">
        <table id="dataTable" class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border text-left">ID</th>
                    <th class="px-4 py-2 border text-left">Kategori Sampah</th>
                    <th class="px-4 py-2 border text-left">Jenis Sampah</th>
                    <th class="px-4 py-2 border text-left">Harga</th>
                    <th class="px-4 py-2 border text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($hargaSampah as $harga)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 border">{{ $harga->waste_id }}</td>
                    <td class="px-4 py-2 border">{{ $harga->dataSampah->kategori }}</td>
                    <td class="px-4 py-2 border">{{ $harga->dataSampah->jenis }}</td>
                    <td class="px-4 py-2 border">{{ $harga->price }}</td>
                    <td class="px-4 py-2 border">
                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" onclick="openEditModal('{{ $harga->id }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('admin.daftar_harga_sampah_unit.destroy', $harga->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="showInfoModal('{{ $harga->waste_id }}')">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Tambah Harga Sampah -->
<div id="addModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Harga Sampah</h3>
            <div class="mt-2">
                <form action="{{ route('admin.daftar_harga_sampah_unit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="waste_id" class="block text-sm font-bold mb-2">Jenis Sampah:</label>
                        <select id="waste_id" name="waste_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Pilih Jenis Sampah</option>
                            @foreach($dataSampahs as $sampah)
                            <option value="{{ $sampah->id }}">{{ $sampah->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-bold mb-2">Harga:</label>
                        <input type="number" step="0.01" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
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

<!-- Modal untuk Edit Harga Sampah -->
@foreach($hargaSampah as $harga)
<div id="editModal-{{ $harga->id }}" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Harga Sampah</h3>
            <div class="mt-2">
                <form action="{{ route('admin.daftar_harga_sampah_unit.update', $harga->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="waste_id" class="block text-sm font-bold mb-2">Jenis Sampah:</label>
                        <select id="waste_id" name="waste_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @foreach($dataSampahs as $sampah)
                            <option value="{{ $sampah->id }}" {{ $harga->waste_id == $sampah->id ? 'selected' : '' }}>{{ $sampah->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-bold mb-2">Harga per Kg:</label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ $harga->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal('editModal-{{ $harga->id }}')">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal untuk Info Jenis Sampah -->
@foreach($hargaSampah as $harga)
<div id="infoModal-{{ $harga->waste_id }}" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Info Jenis Sampah</h3>
            <div class="mt-2">
                <p>{{ $harga->dataSampah->sale_unit }}</p>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="closeModal('infoModal-{{ $harga->waste_id }}')">Tutup</button>
                </div>
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

    function showInfoModal(id) {
        document.getElementById('infoModal-' + id).classList.remove('hidden');
    }

    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }
</script>
@endsection
