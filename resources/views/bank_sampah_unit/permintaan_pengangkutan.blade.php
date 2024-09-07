@extends('bank_sampah_unit.layout')

@section('content')
<div class="container mx-auto p-4 mt-14">
    <h2 class="text-2xl font-bold mb-4">Permintaan Pengangkutan Sampah</h2>
    
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div id="sampah-container" class="space-y-4">
        <div class="sampah-dropdown mb-4 flex items-center">
            <label for="kategori-sampah-1" class="block text-lg font-medium flex-1">Pilih Kategori Sampah:</label>
            <select id="kategori-sampah-1" class="w-full p-2 border rounded-md kategori-sampah flex-1" data-index="1">
                <option value="" disabled selected>Pilih kategori sampah</option>
                @foreach($dataSampahs as $kategori => $jenisSampahs)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
            <button class="ml-2 p-2 rounded-md text-white bg-red-600 hover:bg-red-700 transition kategori-sampah-delete hidden">Hapus</button>
        </div>
    </div>
    <button id="tambah-sampah-btn" class="bg-green-700 text-white p-2 rounded-md shadow-md hover:bg-green-800 transition">Tambah Sampah</button>

    <form id="permintaan-form" method="POST" action="{{ route('permintaan.pengangkutan.store') }}">
        @csrf
        <div id="sampah-forms" class="mt-6 space-y-4"></div>
        <div class="mt-6 font-bold text-xl">Total Berat Keseluruhan: <span id="total-keseluruhan">0</span> Kg</div>
        <input type="hidden" name="total_berat" id="total_berat_input" value="0">
        <div class="mt-6 flex justify-end">
            <button type="submit" id="kirim-permintaan-btn" class="bg-green-700 text-white p-3 rounded-lg shadow-md hover:bg-green-800 transition">Kirim Permintaan</button>
        </div>
    </form>
    
</div>

<script>
    let sampahCount = 1;

    document.getElementById('tambah-sampah-btn').addEventListener('click', function() {
        sampahCount++;
        const container = document.getElementById('sampah-container');
        const newDropdown = document.createElement('div');
        newDropdown.classList.add('sampah-dropdown', 'mb-4', 'flex', 'items-center');
        newDropdown.innerHTML = `
            <label for="kategori-sampah-${sampahCount}" class="block text-lg font-medium flex-1">Pilih Kategori Sampah:</label>
            <select id="kategori-sampah-${sampahCount}" class="w-full p-2 border rounded-md kategori-sampah flex-1" data-index="${sampahCount}">
                <option value="" disabled selected>Pilih kategori sampah</option>
                @foreach($dataSampahs as $kategori => $jenisSampahs)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
            <button class="ml-2 p-2 rounded-md text-white bg-red-600 hover:bg-red-700 transition kategori-sampah-delete hidden">Hapus</button>
        `;
        container.appendChild(newDropdown);
    });

    document.addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('kategori-sampah')) {
            const selectedValue = e.target.value;
            const index = e.target.getAttribute('data-index');
            const sampahForms = document.getElementById('sampah-forms');

            let existingForm = document.getElementById(`sampah-form-${index}`);
            if (existingForm) {
                existingForm.remove();
            }

            const newForm = document.createElement('div');
            newForm.id = `sampah-form-${index}`;
            newForm.classList.add('sampah', 'bg-white', 'p-6', 'rounded-lg', 'shadow-md', 'mb-4');
            newForm.innerHTML = getSampahFormHTML(selectedValue, index);

            sampahForms.appendChild(newForm);
            calculateTotalWeight();

            e.target.nextElementSibling.classList.remove('hidden'); // Show delete button
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('kategori-sampah-delete')) {
            const index = e.target.previousElementSibling.getAttribute('data-index');
            document.querySelector(`#sampah-form-${index}`).remove();
            e.target.parentElement.remove();
            calculateTotalWeight();
        }
    });

    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('sampah-input')) {
            calculateTotalWeight();
        }
    });

    function getSampahFormHTML(kategori, index) {
        let formHTML = '';
        switch (kategori) {
            @foreach($dataSampahs as $kategori => $jenisSampahs)
            case '{{ $kategori }}':
                formHTML = `
                    <input type="hidden" name="sampah[${index}][kategori]" value="{{ $kategori }}">
                    <h3 class="text-xl font-semibold mb-4">Sampah {{ $kategori }}</h3>
                    <div class="space-y-4">
                        @foreach($jenisSampahs as $sampah)
                        <div class="flex items-center">
                            <label class="flex-1">{{ $sampah->jenis }}</label>
                            <input type="number" class="w-24 p-2 border rounded-md sampah-input" name="sampah[${index}][{{ $sampah->jenis }}]" value="0">
                            <span class="ml-2">Kg</span>
                        </div>
                        @endforeach
                    </div>
                `;
                break;
            @endforeach
            default:
                formHTML = '';
                break;
        }
        return formHTML;
    }

    function calculateTotalWeight() {
        let totalKeseluruhan = 0;
        document.querySelectorAll('.sampah-input').forEach(input => {
            totalKeseluruhan += parseFloat(input.value) || 0;
        });
        document.getElementById('total-keseluruhan').innerText = totalKeseluruhan;
        document.getElementById('total_berat_input').value = totalKeseluruhan;
    }

    document.getElementById('kirim-permintaan-btn').addEventListener('click', function() {
        calculateTotalWeight();
    });
</script>
@endsection
