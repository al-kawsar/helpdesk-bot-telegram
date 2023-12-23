@extends('admin.layouts.va_main')

<style>
    .btn-v:active {
        transform: scale(.9)
    }
</style>

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Table {{ $teks }}
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="d-flex my-2">
                <button class="btn btn-danger me-auto" type="button" id="deleteAllSelected">Delete All Selected</button>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table table-hover">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="py-3 text-center"><input type="checkbox" name="" id="select_all_ids"
                                        class="mycheck p-2 form-check-input"></th>
                                <th class="px-3 py-3">#</th>
                                <th class="px-3 py-3">Nama</th>
                                <th class="px-3 py-3">Username Telegram</th>
                                <th class="px-3 py-3">Pertanyaan</th>
                                <th class="px-3 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @if (request('search') && $req_question->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center fs-1 py-5 fw-bold">Pencarian <span
                                            class="text-danger">{{ request()->get('search') }}</span> tidak ditemukan... <p>
                                            🙏</p>
                                    </td>
                                </tr>
                            @elseif($req_question->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center fs-1 py-5 fw-bold">Request Pertanyaan <span
                                            class="text-danger">Kosong</span>...😴</td>
                                </tr>
                            @else
                                @foreach ($req_question as $number => $req)
                                    <tr class="text-gray-700 dark:text-gray-400" id="req-ids-{{ $req->id }}">
                                        <td class="px-3 py-3 text-center">
                                            <input type="checkbox" name="ids"
                                                class="mycheck checkbox_ids form-check-input p-2" id=""
                                                value="{{ $req->id }}">
                                        </td>
                                        <td class="px-3 py-3">
                                            {{ $number + $req_question->firstItem() }}
                                        </td>
                                        <td class="px-3 py-3 text-sm">
                                            {{ Str::length($req->nama) > 50 ? substr($req->nama, 0, 20) . '...' : $req->nama }}
                                        </td>
                                        <td class="px-3 py-3 text-sm">
                                            {{ $req->username }}
                                        </td>
                                        <td class="px-3 py-3 text-sm">
                                            <button type="button" class="text-primary btn-pertanyaan"
                                                data-pertanyaan="{{ $req->pertanyaan }}">
                                                {{ Str::length($req->pertanyaan) > 50 ? substr($req->pertanyaan, 0, 20) . '...' : $req->pertanyaan }}
                                            </button>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">

                                                <button type="button" data-verifikasi="{{ $req->id }}"
                                                    class="btn-v btn-verifikasi flex items-center justify-between px-2 py-2 bg-blue-600 text-sm font-medium leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-white">
                                                    Verifikasi
                                                </button>
                                                <button type="button"
                                                    class="btn-v flex items-center justify-between px-2 py-2 bg-red-600 text-sm font-medium leading-5 text-white rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-white">
                                                    Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- Pagination --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $req_question->appends([
                                'search' => request('search'),
                            ])->links() }}
                    </ul>
                </nav>

            </div>
        </div>
    </main>

    @yield('script')
    <script>
        $(document).ready(function() {

            // $('.loading').fadeIn(100)

            $('.btn-pertanyaan').on('click', function() {
                var pertanyaan = $(this).data('pertanyaan'); // Mendapatkan teks dari tombol pertanyaan
                Swal.fire({
                    text: pertanyaan,
                    icon: 'info',
                    confirmButtonText: 'Tutup'
                });
            });

            $('#select_all_ids').click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelected').fadeOut()

            $('.mycheck').change(function() {
                var checkedCheckboxes = $('.mycheck:checked');
                if (checkedCheckboxes.length > 1) {
                    $('#deleteAllSelected').fadeIn(500);
                } else {
                    $('#deleteAllSelected').fadeOut(500);
                }
            });

            $('#deleteAllSelected').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checked[name="ids"]').each(function() {
                    all_ids.push($(this).val());
                });

                if (all_ids.length > 1) {
                    Swal.fire({
                        title: "Yakin ?",
                        text: `Anda yakin ingin Menghapusnya?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#ff0000',
                        allowOutsideClick: false // Tidak izinkan menutup notifikasi dengan mengklik di luar
                    }).then((result) => {
                        $('.loading').fadeIn()

                        if (result.isConfirmed == true) {
                            $.ajax({
                                url: "{{ route('request.delete-all') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    $('.loading').fadeOut(500)

                                    const {success, message: { title, text }} = response;

                                    if (success) {
                                        $.each(all_ids, function(index, value) {
                                            $('#req-ids-' + value).remove();
                                        });
                                        Swal.fire({
                                            icon: 'success',
                                            title: title,
                                            text: text,
                                            confirmButtonText: "OK",
                                            confirmButtonColor: 'green',
                                            showConfirmButton: true
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                reloadData(
                                                    `{{ route('bot.request') }}`
                                                );
                                            }
                                            $('.loading').fadeOut(500)
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: response.message
                                        });
                                        $('.loading').fadeOut(500)

                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error); // Cetak kesalahan ke konsol
                                    $('.loading').fadeOut(500)

                                }
                            });
                        } else {
                            Swal.fire({
                                text: "{{ $teks }} Batal Dihapus",
                                confirmButtonText: "OK",
                                confirmButtonColor: "rgba(0,0,0,.5)",
                            })
                            $('.loading').fadeOut(500)
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Info',
                        text: 'Pilih Setidaknya 2 item untuk dihapus!',
                        icon: 'info',
                        confirmButtonText: "OK",
                        showConfirmButton: true
                    });
                }


            });


            $('.btn-verifikasi').click(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "Apakah anda ingin menambah keterangan?",
                    icon: 'info',
                    showCancelButton: true,
                    cancelButtonText: 'Tidak usah',
                    confirmButtonText: 'Ya, Saya ingin',
                    allowOutsideClick: false
                }).then(function(result) {
                    $('.loading').fadeIn()
                    var csrfToken = document.querySelector('meta[name="csrf"]').getAttribute(
                        'content');
                    let dataVerifikasi = $(this).data('verifikasi');

                    if (result.isConfirmed) {
                        $('.loading').fadeOut()
                    } else {
                        $.ajax({
                            url: "{{ route('bot.verifikasi.diterima') }}",
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                                id_verifikasi: dataVerifikasi
                            },
                            success: function(response) {
                                $('.loading').fadeOut(500)
                                Swal.fire({

                                })
                                if (response.success) {
                                    Swal.fire({
                                        'icon': 'success',
                                        'title': response.message.title,
                                        'text': response.message.text,
                                    }).then(function() {
                                        // location.reload()
                                    })
                                }
                            },
                            error: function(response) {
                                console.log('error', response)
                            }
                        })
                    }
                })

            })

        });

        function reloadData(url) {
            window.location.href = url;
        }


        // In your Javascript (external .js resource or <script> tag)
    </script>

@endsection
