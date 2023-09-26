@extends('admin.layouts.va_main')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Dashboard
            </h2>
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/group.png" alt="Users Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total User
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $users ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/groups.png" alt="Users Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Grup
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $grups ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/categories.png" alt="Kategori Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Kategoris
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $kategoris ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/tag.png" alt="Sub Kategori Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Sub Kategoris
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $sub_kategoris ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/tag1.png" alt="Sub Sub Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Sub Sub Kategoris
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $sub_sub_kategoris ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-blue-100 border rounded-full dark:text-orange-100 dark:bg-orange-500">
                        {{-- Icon --}}
                        <img src="/icon/question.png" alt="Pertanyaan Icon" class="p-2" width="100">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Total Pertanyaan & Jawaban
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ $pertanyaans ?? '' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
