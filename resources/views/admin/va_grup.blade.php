@extends('admin.layouts.va_main')

@section('content')
    <main class="h-full pb-16 overflow-y-auto" style="z-index: 10">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Table {{ $teks }}
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table table-hover">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Nama Grup</th>
                                <th class="px-4 py-3">Tipe Grup</th>
                                <th class="px-4 py-3">Created_at</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($grups as $number => $grup)
                                <tr class="text-gray-700 dark:text-gray-400">
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
                                        {{ $grup->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
@endsection
