<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Nasabah Modal Logic
        const modal = document.getElementById('modal');
        const openModalButton = document.querySelector('#add-nasabah');
        const closeModalButton = document.getElementById('close-button');
        const modalForm = document.getElementById('modal-form');

        openModalButton.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        modalForm.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Pastikan data yang dimasukkan sudah benar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    modalForm.submit();
                }
            });
        });

        // Edit Nasabah Modal Logic
        const editModal = document.getElementById('edit-modal');
        const editCloseButton = document.getElementById('edit-close-button');
        const editModalForm = document.getElementById('edit-modal-form');

        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const nomorInduk = this.getAttribute('data-nomor_induk');
                const username = this.getAttribute('data-username');
                const email = this.getAttribute('data-email');
                const alamat = this.getAttribute('data-alamat');

                editModal.querySelector('#edit-nama').value = nama;
                editModal.querySelector('#edit-nomor_induk').value = nomorInduk;
                editModal.querySelector('#edit-username').value = username;
                editModal.querySelector('#edit-email').value = email;
                editModal.querySelector('#edit-alamat').value = alamat;
                editModalForm.action = `/nasabah/${id}`;

                editModal.classList.remove('hidden');
            });
        });

        editCloseButton.addEventListener('click', function() {
            editModal.classList.add('hidden');
        });

        // Delete Logic
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data nasabah akan dihapus secara permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/nasabah/${id}`)
                            .then(response => {
                                Swal.fire(
                                    'Terhapus!',
                                    response.data.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });

        document.querySelectorAll('.see-button').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                axios.get(`/nasabah/${id}`)
                    .then(response => {
                        const nasabah = response.data;
                        document.getElementById('detail-nama').innerText = nasabah.nama;
                        document.getElementById('detail-nomor_induk').innerText = nasabah
                            .nomor_induk;
                        document.getElementById('detail-username').innerText = nasabah
                            .username;
                        document.getElementById('detail-email').innerText = nasabah.email;
                        document.getElementById('detail-alamat').innerText = nasabah.alamat;
                        document.getElementById('detail-foto').src = nasabah.foto ?
                            `/${nasabah.foto}` :
                            'https://via.placeholder.com/200x200.png?text=No+Image';

                        const detailModal = document.getElementById('detail-modal');
                        detailModal.classList.remove('hidden');
                    })
                    .catch(error => {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengambil data.',
                            'error'
                        );
                    });
            });
        });

        // Close Detail Modal
        const detailCloseButton = document.getElementById('detail-close-button');
        detailCloseButton.addEventListener('click', function() {
            const detailModal = document.getElementById('detail-modal');
            detailModal.classList.add('hidden');
        });

        // Script Pencarian Nasabah
        const searchInput = document.querySelector('input[type="search"]');
        const nasabahTableBody = document.querySelector('tbody');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            axios.get(`/nasabah/search?query=${query}`)
                .then(response => {
                    const nasabahs = response.data;
                    nasabahTableBody.innerHTML = '';

                    nasabahs.forEach((nasabah, index) => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');
                        row.innerHTML = `
                            <td class="py-2 px-4 border-b">${index + 1}</td>
                            <td class="py-2 px-4 border-b">${nasabah.nama}</td>
                            <td class="py-2 px-4 border-b">${nasabah.nomor_induk}</td>
                            <td class="py-2 px-4 border-b">${nasabah.alamat}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="flex items-center justify-center w-8 h-8 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 delete-button" data-id="${nasabah.id}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 edit-button" data-id="${nasabah.id}" data-nama="${nasabah.nama}" data-nomor_induk="${nasabah.nomor_induk}" data-username="${nasabah.username}" data-email="${nasabah.email}" data-alamat="${nasabah.alamat}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                        </svg>
                                    </button>
                                    <button class="flex items-center justify-center w-8 h-8 rounded-md bg-yellow-400 text-white hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 see-button" data-id="${nasabah.id}">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        `;
                        nasabahTableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching nasabah:', error);
                });
        });
    });
</script>
