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
                    data-bs-target="#modalAdmin">Tambah
                    {{ $teks }}</button>
            </div>

            <!-- Modal Tambah Kategori-->
            <div class="modal fade" id="modalAdmin" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/admin/admins" method="post">
                        @csrf
                        @method('POST')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                    id="exampleModalLabel">Modal
                                    Tambah Admin </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="px-4 py-3  dark:bg-gray-800 height">
                                    {{-- Display validation errors if there are any --}}

                                    @error('email')
                                        <div class="alert alert-sm alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    @csrf
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Email
                                            Admin <span class="text-danger">*</span></span>
                                        <input type="email"
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            name="email" value="{{ old('email') }}" required autofocus
                                            autocomplete="off" />
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah
                                    Admin</button>
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
                                        class="p-2 form-check-input"></th>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Password</th>
                                <th class="px-4 py-3">status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @if (request('search') && $admins->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center fs-1 py-5 fw-bold">Pencarian <span
                                            class="text-danger">{{ request()->get('search') }}</span> tidak ditemukan... <p>
                                            🙏</p>
                                    </td>
                                </tr>
                            @elseif($admins->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center fs-1 py-5 fw-bold">Admin <span
                                            class="text-danger">Kosong</span>...😴</td>
                                </tr>
                            @else
                                @foreach ($admins as $number => $admin)
                                    <tr class="text-gray-700 dark:text-gray-400" id="modal_ids{{$admin->id}}">
                                        <td class="py-3 text-center">
                                            <input type="checkbox" name="ids" class="checkbox_ids form-check-input p-2"
                                                id="" value="{{ $admin->id }}">
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $number + $admins->firstItem() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $admin->name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $admin->email }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                try {
                                                    $decrypted = Crypt::decrypt($admin->password);
                                                    echo explode('.', $decrypted)[1];
                                                } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                                    echo $e->getMessage();
                                                }
                                            @endphp
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <div class="badge bg-info p-2">
                                                {{ $admin->role_id !== '1' ? 'admin' : '' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">

                                                <button type="button"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-green"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit{{ $admin->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <!-- Modal Edit Kategori-->
                                                <div class="modal fade" id="modalEdit{{ $admin->id }}" tabindex="-1"
                                                    aria-hidden="true">>
                                                    <div class="modal-dialog">
                                                        <form action="/admin/admins/{{ $admin->id }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                                                        id="exampleModalLabel">Edit Admin</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- Display validation errors if there are any --}}
                                                                    @error('admins')
                                                                        <div class="alert alert-sm alert-danger">
                                                                            <p>{{ $message }}</p>
                                                                        </div>
                                                                    @enderror

                                                                    <label class="block text-sm mb-3">
                                                                        <span class="text-gray-700 dark:text-gray-400">Nama
                                                                            Admin <span class="text-danger">*</span></span>
                                                                        <input
                                                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                                            name="name" value="{{ $admin->name }}"
                                                                            autofocus>
                                                                    </label>
                                                                    <label class="block text-sm mb-3">
                                                                        <span
                                                                            class="text-gray-700 dark:text-gray-400">Email
                                                                            Admin <span class="text-danger">*</span></span>
                                                                        <input
                                                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                                            name="email" value="{{ $admin->email }}"
                                                                            autofocus>
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



                                                <a href="/admin/hapus-admin/{{ $admin->id }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-red delete-link"
                                                    data-kategori="{{ $admin->name }}" aria-label="Delete">
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
                        {{ $admins->appends([
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

            $('#deleteAllSelected').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checked[name="ids"]').each(function() {
                    all_ids.push($(this).val());
                });

                if (all_ids.length === 0) {
                    alert('Pilih setidaknya satu item untuk dihapus.');
                    return;
                }

                if (all_ids.length >= 1) {
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
                                url: "{{ route('bot.admins.selected') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        $.each(all_ids, function(index, value) {
                                            $('#modal_ids' + value).remove();
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
                                                reloadData('/admin/admins');
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
                }


            });
        });

        function reloadData(url) {
            window.location.href = url;
        }
    </script>

@endsection
