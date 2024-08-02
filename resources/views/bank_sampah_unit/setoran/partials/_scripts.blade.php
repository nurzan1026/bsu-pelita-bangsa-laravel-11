<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-button');
        const modal = document.getElementById('modal');
        const closeButton = document.getElementById('close-button');
        const modalForm = document.getElementById('modal-form');

        // Buka modal ketika tombol "Setoran Baru" diklik
        addButton.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        // Tutup modal ketika tombol close diklik
        closeButton.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Tutup modal ketika area luar modal diklik
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        // Validasi dan kirim form modal
        modalForm.addEventListener('submit', function(event) {
            event.preventDefault();
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            Swal.fire({
                icon: 'success',
                title: 'Setoran Ditambahkan',
                text: 'Setoran sampah berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                modalForm.submit();
            });
        });

        // Pencarian nama nasabah
        const input = document.getElementById('nasabah-nama');
        const results = document.getElementById('search-results');

        input.addEventListener('input', function() {
            const query = input.value;

            if (query.length > 0) {
                fetch(`/nasabah/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        results.innerHTML = '';
                        data.forEach(nasabah => {
                            const div = document.createElement('div');
                            div.textContent = nasabah.nama;
                            div.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            div.addEventListener('click', function() {
                                input.value = nasabah.nama;
                                document.getElementById('nasabah-input').value =
                                    nasabah.id;
                                results.classList.add('hidden');
                            });
                            results.appendChild(div);
                        });
                        results.classList.remove('hidden');
                    });
            } else {
                results.classList.add('hidden');
            }
        });

        // Sembunyikan hasil pencarian ketika klik di luar area input atau hasil
        document.addEventListener('click', function(event) {
            if (!input.contains(event.target) && !results.contains(event.target)) {
                results.classList.add('hidden');
            }
        });

        // Menambah field baru untuk detail setoran
        let fieldCount = 1;
        const addFieldButton = document.getElementById('add-field');
        const inputFields = document.getElementById('input-fields');

        if (!addFieldButton || !inputFields) {
            console.error('Button or input fields not found.');
            return;
        }

        addFieldButton.addEventListener('click', function() {
            console.log('Add button clicked.');
            const newField = document.createElement('div');
            newField.classList.add('flex', 'items-center', 'mb-4');
            newField.setAttribute('id', `field-${fieldCount}`);
            newField.innerHTML = `
            <div class="w-1/2">
                <label for="jenis-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                <select id="jenis-sampah-${fieldCount}" name="detail_setoran[${fieldCount}][sampah_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                    <option value="" selected disabled>Pilih Jenis Sampah</option>
                    @foreach ($sampah as $item)
                        <option value="{{ $item->sampah_id }}">{{ $item->jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/2 ml-4">
                <label for="berat-sampah-${fieldCount}" class="block text-sm font-medium text-gray-700">Berat sampah (Kg)</label>
                <input id="berat-sampah-${fieldCount}" name="detail_setoran[${fieldCount}][berat]" type="number" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
            </div>
            <button type="button" class="ml-4 text-red-500 hover:text-red-700 remove-field" data-field-id="${fieldCount}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
        `;
            inputFields.appendChild(newField);

            const removeFieldButtons = document.querySelectorAll('.remove-field');
            removeFieldButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fieldId = this.getAttribute('data-field-id');
                    document.getElementById(`field-${fieldId}`).remove();
                });
            });

            fieldCount++;
        });

        // SweetAlert2 untuk tombol hapus
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Hapus',
                    text: "Yakin ingin menghapus data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/setoran/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Dihapus', 'Data berhasil dihapus.',
                                        'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!',
                                        'There was a problem deleting the setoran.',
                                        'error');
                                }
                            });
                    }
                });
            });
        });

        // JavaScript untuk tombol lihat detail setoran
        const seeButtons = document.querySelectorAll('.see-button');
        const detailModal = document.getElementById('detail-modal');
        const closeDetailButton = document.getElementById('close-detail-button');
        const closeDetailButtonBottom = document.getElementById('close-detail-button-bottom');
        const detailContent = document.getElementById('detail-content');

        seeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/setoran/${id}/detail`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response
                                .statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data fetched: ', data);
                        if (data.detail_setoran && Array.isArray(data.detail_setoran)) {
                            detailContent.innerHTML = `
                            <p><strong>Nasabah :</strong> ${data.nasabah.nama}</p>
                            <p><strong>Tanggal Penyetoran :</strong> ${new Date(data.tanggal_setor).toLocaleDateString('id-ID', {day: '2-digit', month: 'long', year: 'numeric'})}</p>
                            <hr class="my-2">
                            <h3 class="font-bold">Setoran</h3>
                            ${data.detail_setoran.map(detail => `
                                <div class="p-2 my-2 border border-gray-200 rounded-md">
                                    <div class="flex justify-between">
                                        <p>${detail.sampah ? detail.sampah.jenis : 'Jenis sampah tidak ditemukan'}</p>
                                        <p>${detail.berat} kg</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p>Poin</p>
                                        <p>${detail.poin}</p>
                                    </div>
                                </div>
                            `).join('')}
                            <hr class="my-2">
                            <div class="flex justify-between">
                                <p><strong>Total Poin:</strong></p>
                                <p><strong>${data.detail_setoran.reduce((total, detail) => total + detail.poin, 0)}</strong></p>
                            </div>
                        `;
                        } else {
                            detailContent.innerHTML =
                                '<p>Data setoran tidak ditemukan atau tidak lengkap.</p>';
                        }
                        detailModal.classList.remove('hidden');
                        detailModal.classList.add('flex');
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        detailContent.innerHTML =
                            '<p>Terjadi kesalahan saat mengambil data. Silakan coba lagi nanti.</p>';
                        detailModal.classList.remove('hidden');
                        detailModal.classList.add('flex');
                    });
            });
        });

        // Tutup modal detail
        closeDetailButton.addEventListener('click', function() {
            detailModal.classList.add('hidden');
            detailModal.classList.remove('flex');
        });

        closeDetailButtonBottom.addEventListener('click', function() {
            detailModal.classList.add('hidden');
            detailModal.classList.remove('flex');
        });

        detailModal.addEventListener('click', function(event) {
            if (event.target === detailModal) {
                detailModal.classList.add('hidden');
                detailModal.classList.remove('flex');
            }
        });

        // JavaScript untuk tombol edit setoran
        const editButtons = document.querySelectorAll('.edit-button');
        const editModal = document.getElementById('edit-modal');
        const closeEditButton = document.getElementById('close-edit-button');
        const editForm = document.getElementById('edit-form');
        const editNasabahInput = document.getElementById('edit-nasabah-input');
        const editNasabahNama = document.getElementById('edit-nasabah-nama');
        const editTanggal = document.getElementById('edit-tanggal');
        const editInputFields = document.getElementById('edit-input-fields');
        const editSearchResults = document.getElementById('edit-search-results');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/setoran/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        editNasabahInput.value = data.setoran.nasabah_id;
                        editNasabahNama.value = data.setoran.nasabah.nama;
                        editTanggal.value = data.setoran.tanggal_setor;
                        editForm.action = `/setoran/${id}`;

                        editInputFields.innerHTML = '';

                        data.setoran.detail_setoran.forEach((detail, index) => {
                            const newField = document.createElement('div');
                            newField.classList.add('flex', 'items-center', 'mb-4');
                            newField.innerHTML = `
                            <div class="w-1/2">
                                <label for="edit-jenis-sampah-${index}" class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                                <select id="edit-jenis-sampah-${index}" name="detail_setoran[${index}][sampah_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                                    ${data.sampah.map(sampah => `<option value="${sampah.sampah_id}" ${sampah.sampah_id === detail.sampah_id ? 'selected' : ''}>${sampah.jenis}</option>`).join('')}
                                </select>
                            </div>
                            <div class="w-1/2 ml-4">
                                <label for="edit-berat-sampah-${index}" class="block text-sm font-medium text-gray-700">Berat sampah (Kg)</label>
                                <input id="edit-berat-sampah-${index}" name="detail_setoran[${index}][berat]" type="number" step="0.01" value="${detail.berat}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" required>
                            </div>
                        `;
                            editInputFields.appendChild(newField);
                        });

                        editModal.classList.remove('hidden');
                        editModal.classList.add('flex');
                    });
            });
        });

        // Tutup modal edit
        closeEditButton.addEventListener('click', function() {
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
        });

        editModal.addEventListener('click', function(event) {
            if (event.target === editModal) {
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
            }
        });

        // Validasi dan kirim form edit
        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
            Swal.fire({
                icon: 'success',
                title: 'Setoran Diperbarui',
                text: 'Setoran sampah berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                editForm.submit();
            });
        });

        // Pencarian nasabah di modal edit
        editNasabahNama.addEventListener('input', function() {
            const query = editNasabahNama.value;

            if (query.length > 0) {
                fetch(`/nasabah/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        editSearchResults.innerHTML = '';
                        data.forEach(nasabah => {
                            const div = document.createElement('div');
                            div.textContent = nasabah.nama;
                            div.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                            div.addEventListener('click', function() {
                                editNasabahNama.value = nasabah.nama;
                                editNasabahInput.value = nasabah.id;
                                editSearchResults.classList.add('hidden');
                            });
                            editSearchResults.appendChild(div);
                        });
                        editSearchResults.classList.remove('hidden');
                    });
            } else {
                editSearchResults.classList.add('hidden');
            }
        });

        // Sembunyikan hasil pencarian di modal edit ketika klik di luar area input atau hasil
        document.addEventListener('click', function(event) {
            if (!editNasabahNama.contains(event.target) && !editSearchResults.contains(event.target)) {
                editSearchResults.classList.add('hidden');
            }
        });

        // Pencarian nama setoran di halaman index
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('setoran-table-body');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            fetch(`/setoran/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    tableBody.innerHTML = '';

                    data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');
                        row.innerHTML = `
                        <td class="border border-gray-200 px-4 py-2">${index + 1}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.tanggal_setor}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.nasabah.nama}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.detail_setoran.reduce((sum, detail) => sum + detail.berat, 0)} kg</td>
                        <td class="border border-gray-200 px-4 py-2">${item.detail_setoran.reduce((sum, detail) => sum + detail.poin, 0)}</td>
                        <td class="border border-gray-200 px-4 py-2 flex justify-center gap-2">
                            <button class="flex items-center justify-center w-8 h-8 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 delete-button" data-id="${item.id}">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </button>
                            <button class="flex items-center justify-center w-8 h-8 rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 edit-button" data-id="${item.id}">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                </svg>
                            </button>
                            <button class="flex items-center justify-center w-8 h-8 rounded-md bg-yellow-400 text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 see-button" data-id="${item.id}">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </td>
                    `;
                        tableBody.appendChild(row);
                    });
                });
        });

        // Set tanggal input ke hari ini dan kemarin
        const today = new Date().toISOString().split('T')[0];
        const yesterday = new Date(Date.now() - 86400000).toISOString().split('T')[0];

        const tanggalInput = document.getElementById('tanggal');
        tanggalInput.setAttribute('min', yesterday);
        tanggalInput.setAttribute('max', today);
    });
</script>
