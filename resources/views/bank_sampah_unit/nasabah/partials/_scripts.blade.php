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
    });
</script>
