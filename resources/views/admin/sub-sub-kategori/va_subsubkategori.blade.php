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

            <button class="btn btn-primary my-2 tambah-kategori ms-auto" type="button" data-bs-toggle="modal"
                data-bs-target="#modalKategori">Tambah
                {{ $teks }}</button>

            <!-- Modal Tambah Kategori-->
            <div class="modal fade" id="modalKategori" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/admin/sub-sub-kategori" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                    id="exampleModalLabel">Modal
                                    Tambah {{ $teks }} </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="px-4 py-3 dark:bg-gray-800 height">
                                    @error('tambah_subsub-kategori')
                                        <div class="alert alert-sm alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                    @csrf
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Nama Sub Sub Kategori <span
                                                class="text-danger">*</span></span>
                                        <input
                                            {{ isset($sub_kategori[0]) && !empty($sub_kategori[0]) ? '' : 'disabled readonly ?>' }}
                                            class=" block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            name="tambah_subsub-kategori" required />
                                    </label>
                                    {{-- Display placeholder for alerts --}}
                                    <div id="tambahKolom"></div>

                                    <button type="button" class="btn btn-secondary my-3" id="liveAlertBtn">Tambah
                                        Kolom</button>

                                    @if (isset($sub_kategori[0]) && !empty($sub_kategori[0]))
                                        <label class="block text-sm my-3">
                                            <span class="mb-2 text-gray-700 dark:text-gray-400 d-block">Pilih Sub
                                                Kategori
                                                <span class="text-danger">*</span>
                                            </span>
                                            <select name="option"
                                                @foreach ($sub_kategori as $item)
                                                    class="block p-2 rounded mt-1 border text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray">
                                                    <option value="{{ $item->id }}">{{ $item->sub_kategori }}</option> @endforeach
                                                </select>
                                        </label>
                                    @else
                                        <a href="/admin/sub-kategori" class="d-block text-sm underline text-danger">Silahkan
                                            Isi
                                            Sub-Kategori Terlebih Dahulu</a>
                                    @endif




                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah
                                    {{ $teks }}</button>
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
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Sub-Sub-Kategori</th>
                                <th class="px-4 py-3">Sub-Kategori</th>
                                <th class="px-4 py-3">tanggal ditambahkan</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @if (request('search') && $sub_sub_kategoris->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center fs-1 py-5 fw-bold">Pencarian <span
                                            class="text-danger">{{ request()->get('search') }}</span> tidak ditemukan...
                                    </td>
                                </tr>
                            @elseif($sub_sub_kategoris->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center fs-1 py-5 fw-bold">Sub Sub Kategori <span
                                            class="text-danger">Kosong</span>...</td>
                                </tr>
                            @else
                                @foreach ($sub_sub_kategoris as $number => $sub_sub_kategori)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            {{ $number + $sub_sub_kategoris->firstItem() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $sub_sub_kategori->sub_sub_kategori }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $sub_sub_kategori->subKategori->sub_kategori }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $sub_sub_kategori->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">

                                                <button type="button"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-green"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $sub_sub_kategori->id }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <!-- ================== Modal Edit Sub Kategori ================== -->
                                                <div class="modal fade" id="modalEdit{{ $sub_sub_kategori->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form
                                                            action="/admin/edit-sub-sub-kategori/{{ $sub_sub_kategori->sub_sub_kategori }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                                                        id="exampleModalLabel">Edit {{ $teks }}
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- Display validation errors if there are any --}}
                                                                    @error('update_subsub-kategori')
                                                                        <div class="alert alert-sm alert-danger">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                    <label class="block text-sm">
                                                                        <span class="text-gray-700 dark:text-gray-400">Nama
                                                                            {{ $teks }} <span
                                                                                class="text-danger">*</span></span>
                                                                        <input
                                                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                                            name="update_subsub-kategori"
                                                                            value="{{ $sub_sub_kategori->sub_sub_kategori }}"
                                                                            required>
                                                                    </label>

                                                                    <label class="block text-sm my-3">
                                                                        <span
                                                                            class="mb-2 text-gray-700 dark:text-gray-400 d-block">Pilih
                                                                            Sub Kategori <span
                                                                                class="text-danger">*</span></span>
                                                                        <select name="option"
                                                                            class="block p-2 rounded mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray border">
                                                                            @foreach ($sub_kategori as $item)
                                                                                @if ($item->sub_kategori === $sub_sub_kategori->subKategori->sub_sub_kategori)
                                                                                    <option
                                                                                        value="{{ $sub_sub_kategori->sub_kategori->id }}"
                                                                                        selected>
                                                                                        {{ $sub_sub_kategori->subKategori->sub_kategori }}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{ $item->id }}">
                                                                                        {{ $item->sub_kategori }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>

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



                                                <a href="/admin/hapus-sub-sub-kategori/{{ $sub_sub_kategori->id }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-red delete-link"
                                                    data-kategori="{{ $sub_sub_kategori->sub_sub_kategori }}"
                                                    aria-label="Delete">
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
                        {{ $sub_sub_kategoris }}
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection
