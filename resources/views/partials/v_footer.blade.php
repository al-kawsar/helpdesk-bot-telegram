<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<script>
    //  ============ Tambah Kolom Action ============

    const alertPlaceholder = document.getElementById('tambahKolomKategori');

    let inputCounter = 0;

    const addInputField = () => {
        inputCounter++;

        const wrapper = document.createElement('div');
        wrapper.innerHTML = `

    <div class="wrapper-col-input">
    <label class="block text-sm my-3">
        <input
            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            name="kategori_${inputCounter}" required />
    </label>
    <button class="delete-input" type="button"> <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg></button>
    </div>`;

        // add colum
        alertPlaceholder.appendChild(wrapper);

        const deleteButton = wrapper.querySelector('.delete-input');
        deleteButton.addEventListener('click', () => {
            wrapper.remove();
        });
    };


    const alertTrigger = document.getElementById('liveAlertBtn');
    if (alertTrigger) {
        alertTrigger.addEventListener('click', () => {
            addInputField();
        });

    }

    //  ============ Tambah Kolom Action ============

    //  ============ Notifikasi / Sweet Alert ============

    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.delete-link');

        deleteLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();

                const kategori = link.getAttribute('data-kategori');

                Swal.fire({
                    title: "Yakin ?",
                    text: `
            Anda yakin ingin menghapus {{ strtolower($teks) }} ${kategori} ? `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#ff0000',
                    allowOutsideClick: false // Tidak izinkan menutup notifikasi dengan mengklik di luar
                }).then((result) => {
                    if (result.isConfirmed == true) {
                        window.location.href = link.getAttribute('href');
                    } else {
                        Swal.fire({
                            text: "{{ $teks }} Batal Dihapus",
                            confirmButtonText: "OK",
                            confirmButtonColor: "rgba(0,0,0,.5)",
                        })
                    }
                });
            });
        });


        @error('add-kategori')
            tampilkanModalValidasiError('modalKategori');
        @enderror
        @error('update-kategori')
            tampilkanModalValidasiError("modalEdit{{ $kategori->id }}");
        @enderror
        @error('tambah_sub-kategori')
            tampilkanModalValidasiError('modalKategori');
        @enderror
        @error('update_sub_kategori')
            tampilkanModalValidasiError("modalEdit{{ $sub_kategori->id }}");
        @enderror
        @error('tambah_subsub-kategori')
            tampilkanModalValidasiError('modalKategori');
        @enderror
        @error('update_subsub_kategori')
            tampilkanModalValidasiError("modalEdit{{ $sub_sub_kategori->id }}");
        @enderror
        @error('tambah_pertanyaan')
            tampilkanModalValidasiError('modalKategori');
        @enderror
        @error('update_pertanyaan')
            tampilkanModalValidasiError("modalEdit{{ $pertanyaan->id }}");
        @enderror

        function tampilkanModalValidasiError(modalId) {
            var modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        }


    });


    const successMessage = '{{ session('success_message') }}';
    const failedMessage = '{{ session('failed_message') }}';
    const title = '{{ session('title') }}';

    if (successMessage) {
        // Menampilkan notifikasi
        Swal.fire({
            title: title,
            text: successMessage,
            icon: 'success',
            confirmButtonText: "OK",
            confirmButtonColor: 'green',
            showConfirmButton: true
        });
    }

    if (failedMessage) {
        // Menampilkan notifikasi
        Swal.fire({
            title: title,
            text: failedMessage,
            icon: 'error',
            confirmButtonText: "OK",
            confirmButtonColor: 'green',
            showConfirmButton: true
        });
    }
    // ============ Modal ============

    // ============ Tooltips ============
</script>


</body>

</html>
