@extends('admin.layouts.va_main')


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
                <button class="btn btn-primary tambah-kategori ms-auto" type="button" data-bs-toggle="modal"
                    data-bs-target="#modalKategori">Tambah
                    {{ $teks }}</button>
            </div>


            <!-- Modal Tambah Kategori-->
            <div class="modal fade" id="modalKategori" tabindex="1" aria-hidden="true">
                <div class="modal-dialog" id="">
                    <form action="/admin/kategori" method="post">
                        <div class="modal-content" id="lol">
                            <div class="modal-header">
                                <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                    id="exampleModalLabel">Modal
                                    Tambah Kategori </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="px-4 py-3  dark:bg-gray-800 height">
                                    {{-- Display validation errors if there are any --}}

                                    @error('add-kategori')
                                        <div class="alert alert-sm alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    @csrf
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Nama
                                            kategori <span class="text-danger">*</span></span>
                                        <input required
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            name="add-kategori" autofocus required />
                                    </label>

                                    {{-- Display placeholder for alerts --}}
                                    <div id="tambahKolom"></div>

                                    {{-- Button to add a new input field --}}
                                    <button type="button" class="btn btn-secondary my-3 ms-auto position-relative"
                                        id="liveAlertBtn"><i class="bi bi-plus-square"></i></button>


                                    <label class="block text-sm my-3">
                                        <span class="mb-2 text-gray-700 dark:text-gray-400 d-block">Pilih Grup Untuk
                                            Kategori
                                            <span class="text-danger">*</span>
                                        </span>
                                        <select name="option" id="select_box"
                                            class=" w-full p-2 rounded mt-1 border text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray select2-tailwind"
                                            data-bs-toggle="select2">
                                            <option value="private">Pengguna</option>
                                            @foreach ($grups as $item)
                                                <option class="w-full" value="{{ $item->id_grup }}">
                                                    {{ $item->nama_grup }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @if (!isset($grups[0]) && empty($grups[0]))
                                        <button type="button" class="d-block btn btn-secondary text-light">Grup belum
                                            ada</button>
                                    @endif


                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah
                                    Kategori</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table table-hover">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3 text-center"><input type="checkbox" name="" id="select_all_ids"
                                        class="mycheck p-2 form-check-input"></th>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Dari Grup/Pengguna</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @if (request('search') && $kategoris->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center fs-1 py-5 fw-bold">Pencarian <span
                                            class="text-danger">{{ request()->get('search') }}</span> tidak ditemukan... <p>
                                            🙏</p>
                                    </td>
                                </tr>
                            @elseif($kategoris->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center fs-1 py-5 fw-bold">Kategori <span
                                            class="text-danger">Kosong</span>...😴</td>
                                </tr>
                            @else
                                @foreach ($kategoris as $number => $kategori)
                                    <tr class="text-gray-700 dark:text-gray-400" id="kategori_ids{{ $kategori->id }}">
                                        <td class="py-3 text-center">
                                            <input type="checkbox" name="ids" class="mycheck checkbox_ids form-check-input p-2"
                                                id="" value="{{ $kategori->id }}">
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $number + $kategoris->firstItem() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ Str::length($kategori->kategori) > 50 ? substr($kategori->kategori, 0, 50) . '...' : $kategori->kategori }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $kategori->grup->nama_grup ?? 'Pribadi' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">

                                                <button type="button"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-green"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit{{ $kategori->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <!-- Modal Edit Kategori-->
                                                <div class="modal fade" id="modalEdit{{ $kategori->id }}" tabindex="-1"
                                                    aria-hidden="true">>
                                                    <div class="modal-dialog">
                                                        <form action="/admin/edit-kategori/{{ $kategori->kategori }}"
                                                            method="post">
                                                            @csrf

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                                                        id="exampleModalLabel">Edit Kategori</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- Display validation errors if there are any --}}
                                                                    @error('update-kategori')
                                                                        <div class="alert alert-sm alert-danger">
                                                                            <p>{{ $message }}</p>
                                                                        </div>
                                                                    @enderror

                                                                    <label class="block text-sm">
                                                                        <span class="text-gray-700 dark:text-gray-400">Nama
                                                                            kategori <span
                                                                                class="text-danger">*</span></span>
                                                                        <textarea required
                                                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                                            name="update-kategori" autofocus>{{ $kategori->kategori }}</textarea>
                                                                    </label>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>



                                                <a href="/admin/hapus-kategori/{{ $kategori->id }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-red delete-link"
                                                    data-kategori="{{ $kategori->kategori }}" aria-label="Delete">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>

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
                        {{ $kategoris->appends([
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

            $('#select_all_ids').click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });

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
                        if (result.isConfirmed == true) {
                            $.ajax({
                                url: "{{ route('bot.kategori.selected') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        $.each(all_ids, function(index, value) {
                                            $('#kategori_ids' + value).remove();
                                        });
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: response.message,
                                            confirmButtonText: "OK",
                                            confirmButtonColor: 'green',
                                            showConfirmButton: true
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                reloadData(
                                                    `{{ route('bot.kategori') }}`
                                                );
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: response.message
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error); // Cetak kesalahan ke konsol
                                }
                            });
                        } else {
                            Swal.fire({
                                text: "{{ $teks }} Batal Dihapus",
                                confirmButtonText: "OK",
                                confirmButtonColor: "rgba(0,0,0,.5)",
                            })
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Info',
                        text: 'Pilih Setidaknya 2 item untuk dihapus!',
                        icon: 'info',
                        confirmButtonText: "OK",
                        showConfirmButton: true
                    });
                }


            });
        });

        function reloadData(url) {
            window.location.href = url;
        }

        // In your Javascript (external .js resource or <script> tag)
    </script>

@endsection
