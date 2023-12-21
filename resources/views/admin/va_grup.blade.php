@extends('admin.layouts.va_main')

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <div class="alert alert-info mt-6 fs-6 text-lowercase">
                <i class="bi bi-info-circle"></i>
                Grup-Grup yang terdaftar oleh Bot
            </div>
            <h2 class="mt-3 mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Table {{ $teks }}
            </h2>

            <div class="d-flex my-2">
                <button class="btn btn-success me-auto" type="button" id="sendMessageAllSelected">Kirim Pesan Ke Beberapa
                    Grup</button>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">

                    @foreach ($bots as $bot)
                        <table class="w-full whitespace-no-wrap table table-hover">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3 text-center"><input type="checkbox" name=""
                                            id="select_all_ids" class="p-2 form-check-input"></th>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Nama Grup</th>
                                    <th class="px-4 py-3">Tipe Grup</th>
                                    <th class="px-4 py-3">Username Grup</th>
                                    <th class="px-4 py-3">Tanggal Dibuat</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                @foreach ($bot->grup as $number => $grup)
                                    <tr class="text-gray-700 dark:text-gray-400" id="grup_{{ $grup->id_grup }}">
                                        <td class="py-3 text-center">
                                            <input type="checkbox" name="ids" class="checkbox_ids form-check-input p-2"
                                                id="" value="{{ $grup->id_grup }}">
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $number + $grups->firstItem() }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $grup->nama_grup }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $grup->tipe_grup }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-primary">
                                            @if ($grup->username != null)
                                                {{ '@' . $grup->username }}
                                            @else
                                                <span class="text-muted">tidak ada username</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $grup->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">

                                                <button type="button"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-green"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit{{ $grup->id }}">
                                                    <i class="bi bi-send-exclamation fs-5"></i>
                                                </button>

                                                <!-- Modal Kirim Pesan-->
                                                <div class="modal fade" id="modalEdit{{ $grup->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form id="manyGrup" method="post">
                                                            @csrf
                                                            @method('POST')

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                                                        id="exampleModalLabel">Beri Pesan Khusus
                                                                        Ke
                                                                        Grup?</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{-- Display validation errors if there are any --}}
                                                                    @error('pesan')
                                                                        <div class="alert alert-sm alert-danger">
                                                                            <p>{{ $message }}</p>
                                                                        </div>
                                                                    @enderror

                                                                    <label class="block text-sm">
                                                                        <textarea
                                                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                                                            name="pesan" cols="50" rows="10" placeholder="Masukkan pesan anda*"></textarea>
                                                                    </label>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="send-btn btn btn-primary">Kirim
                                                                        Pesan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- div class="modal fade show" id="modalEdit3" tabindex="-1" style="display: block;" aria-modal="true" role="dialog" --}}

                            </tbody>
                        </table>
                    @endforeach

                </div>
                {{-- Pagination --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $grups }}
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

            $('#sendMessageAllSelected').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checked[name="ids"]').each(function() {
                    all_ids.push($(this).val());
                });

                if (all_ids.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: "Informasi",
                        text: 'Pilih setidaknya satu grup untuk megirim pesan.'
                    });
                    return;
                }

                if (all_ids.length >= 1) {
                    showModal(all_ids);
                    $(".send-btn").submit(function(e) {
                        e.preventDefault(); // Menghentikan pengiriman form bawaan
                        alert('banyak njir')
                    })
                }


            });

        });

        $(".send-btn").submit(function(e) {
            e.preventDefault(); // Menghentikan pengiriman form bawaan
            alert('1 ji')
        })


        function showModal(id_group) {
            // Tampilkan modal dengan form pengiriman pesan khusus
            var modalContent = `
        <div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="oneGrup">
                    @method('POST')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-2xl font-semibold text-gray-700 dark:text-gray-200"
                                id="exampleModalLabel">Beri Pesan Khusus Ke Grup?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Display validation errors if there are any --}}
                            @error('pesan')
                                <div class="alert alert-sm alert-danger">
                                    <p>{{ $message }}</p>
                                </div>
                            @enderror
                            <label class="block text-sm">
                                <textarea class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    name="pesan" cols="50" rows="10" placeholder="Masukkan pesan anda*" required></textarea>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="send-btn btn btn-primary">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>`;
            $('body').append(modalContent);
            $('#sendMessageModal').modal('show');
        }
    </script>
@endsection
