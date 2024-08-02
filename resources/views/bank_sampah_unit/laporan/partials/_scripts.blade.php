<script>
    // script untuk penjualan
    document.addEventListener('DOMContentLoaded', function() {
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('close-button');
        const pembeliSelect = document.getElementById('pembeli');
        const vendorNameContainer = document.getElementById('vendor-name-container');
        const addFieldButton = document.getElementById('add-field');
        const modalForm = document.getElementById('modal-form');
        const modal = document.getElementById('modal');

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

        let fieldCount = 1;
        const inputFieldsContainer = document.getElementById('input-fields');

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
                    @foreach ($sampahs as $item)
                        <option value="{{ $item->sampah_id }}">{{ $item->jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/2 ml-4">
                <label for="berat-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Berat sampah (Kg)</label>
                <input id="berat-sampah-${fieldCount}" name="berat[]" type="number" step="0.01"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                    required>
            </div>
            <button type="button" class="ml-4 text-red-500 hover:text-red-700 remove-field" data-field-id="${fieldCount}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
        `;
            inputFieldsContainer.appendChild(newField);

            newField.querySelector('.remove-field').addEventListener('click', function() {
                newField.remove();
            });
        });
    });

    // Script untuk Daur Ulang
    document.addEventListener('DOMContentLoaded', function() {
        const openDaurUlangModalButton = document.getElementById('openDaurUlangModalButton');
        const closeDaurUlangModalButton = document.getElementById('closeDaurUlangModalButton');
        const addJenisSampahDaurUlangButton = document.getElementById('addJenisSampahDaurUlang');

        if (openDaurUlangModalButton && closeDaurUlangModalButton) {
            openDaurUlangModalButton.addEventListener('click', function() {
                document.getElementById('daurUlangModalContainer').classList.remove('hidden');
            });

            closeDaurUlangModalButton.addEventListener('click', function() {
                document.getElementById('daurUlangModalContainer').classList.add('hidden');
            });
        }

        if (addJenisSampahDaurUlangButton) {
            addJenisSampahDaurUlangButton.addEventListener('click', function() {
                const container = document.getElementById('jenisSampahDaurUlangContainer');
                const newField = document.createElement('div');
                newField.classList.add('mb-4', 'flex', 'items-center');
                newField.innerHTML = `
                <div class="w-1/2 mr-2">
                    <select name="jenis_sampah[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach ($sampahs as $sampah)
                            <option value="{{ $sampah->id }}">{{ $sampah->jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2 ml-2">
                    <input type="number" name="berat[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <button type="button" class="ml-4 text-red-500 text-2xl font-bold removeJenisSampahDaurUlang">-</button>
            `;
                container.appendChild(newField);

                const removeButtonsDaurUlang = container.querySelectorAll(
                '.removeJenisSampahDaurUlang');
                removeButtonsDaurUlang.forEach(button => {
                    button.addEventListener('click', function() {
                        button.parentElement.remove();
                    });
                });
            });
        }
    });
</script>
