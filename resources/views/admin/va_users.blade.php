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


            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table table-hover">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">First Name</th>
                                <th class="px-4 py-3">Last Name</th>
                                <th class="px-4 py-3">Username</th>
                                <th class="px-4 py-3">Tanggal Ditambahkan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($users as $number => $user)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        {{ $number + $users->firstItem() }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $user->first_name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {!! $user->last_name ?? "<span class='badge bg-secondary text-uppercase p-2 w-full'>null</span>" !!}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-primary">
                                        {{ '@' . $user->username }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{  $user->created_at->format('d M Y | H:i:s') }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{-- Pagination --}}
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $users }}
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection
