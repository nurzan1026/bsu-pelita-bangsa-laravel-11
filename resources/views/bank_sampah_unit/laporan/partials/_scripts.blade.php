<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('close-button');
        const pembeliSelect = document.getElementById('pembeli');
        const vendorNameContainer = document.getElementById('vendor-name-container');
        const addFieldButton = document.getElementById('add-field');
        const modalForm = document.getElementById('modal-form');
        const modal = document.getElementById('modal');

        let fieldCount = 1;
        const inputFieldsContainer = document.getElementById('input-fields');

        function toggleHargaPerKgField() {
            const hargaPerKgContainers = document.querySelectorAll(`[id^="harga-per-kg-container-"]`);
            hargaPerKgContainers.forEach(container => {
                if (pembeliSelect.value === 'Vendor') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            });
        }

        openModalButton.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeModalButton.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        pembeliSelect.addEventListener('change', function() {
            if (this.value === 'Vendor') {
                vendorNameContainer.classList.remove('hidden');
            } else {
                vendorNameContainer.classList.add('hidden');
            }
            toggleHargaPerKgField();
        });

        modalForm.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Penjualan Ditambahkan',
                text: 'Penjualan sampah berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                modalForm.submit();
            });
        });

        addFieldButton.addEventListener('click', function() {
            fieldCount++;
            const newField = document.createElement('div');
            newField.classList.add('flex', 'items-center', 'mb-4');
            newField.setAttribute('id', `field-${fieldCount}`);
            newField.innerHTML = `
        <div class="w-1/2">
            <label for="jenis-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
            <select id="jenis-sampah-${fieldCount}" name="jenis_sampah[]"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                required>
                <option value="" selected disabled>Pilih Jenis Sampah</option>
                @foreach ($sampahs as $item)
                    <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-1/2 ml-4">
            <label for="berat-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Berat sampah (Kg)</label>
            <input id="berat-sampah-${fieldCount}" name="berat[]" type="number" step="0.01"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                required>
        </div>
        <div id="harga-per-kg-container-${fieldCount}" class="w-1/2 ml-4 ${pembeliSelect.value === 'Vendor' ? '' : 'hidden'}">
            <label for="harga-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Harga per Kg</label>
            <input id="harga-sampah-${fieldCount}" name="harga_per_kg[]" type="number" step="0.01"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
        </div>
        <button type="button" class="ml-4 text-red-500 hover:text-red-700 remove-field" data-field-id="${fieldCount}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
            </svg>
        </button>
        `;
            inputFieldsContainer.appendChild(newField);

            // Add event listener for removing the field
            newField.querySelector('.remove-field').addEventListener('click', function() {
                newField.remove();
            });
        });

        // Initialize with correct state based on selected "Pembeli"
        toggleHargaPerKgField();
    });

    // Script untuk Daur Ulang
    document.addEventListener('DOMContentLoaded', function() {
        const openDaurUlangModalButton = document.getElementById('openDaurUlangModalButton');
        const closeDaurUlangModalButton = document.getElementById('closeDaurUlangModalButton');
        const addJenisSampahDaurUlangButton = document.getElementById('addJenisSampahDaurUlang');
        const daurUlangModalContainer = document.getElementById('daurUlangModalContainer');

        if (openDaurUlangModalButton && closeDaurUlangModalButton) {
            openDaurUlangModalButton.addEventListener('click', function() {
                daurUlangModalContainer.classList.remove('hidden');
                daurUlangModalContainer.classList.add('flex');
            });

            closeDaurUlangModalButton.addEventListener('click', function() {
                daurUlangModalContainer.classList.add('hidden');
                daurUlangModalContainer.classList.remove('flex');
            });
        }

        if (addJenisSampahDaurUlangButton) {
            addJenisSampahDaurUlangButton.addEventListener('click', function() {
                const container = document.getElementById('jenisSampahDaurUlangContainer');
                const newField = document.createElement('div');
                newField.classList.add('mb-4', 'flex', 'items-center');
                newField.innerHTML = `
                <div class="w-1/2 mr-2">
                    <select name="jenis_sampah[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                        <option value="" selected disabled>Pilih Jenis Sampah</option>
                        @foreach ($sampahs as $sampah)
                            <option value="{{ $sampah->id }}">{{ $sampah->jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2 ml-2">
                    <input type="number" name="berat[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" step="0.01" required>
                </div>
                <button type="button" class="ml-4 text-red-500 hover:text-red-700 removeJenisSampahDaurUlang">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
                    </svg>
                </button>
            `;
                container.appendChild(newField);

                container.querySelectorAll('.removeJenisSampahDaurUlang').forEach(button => {
                    button.addEventListener('click', function() {
                        button.parentElement.remove();
                    });
                });
            });
        }
    });
</script>
