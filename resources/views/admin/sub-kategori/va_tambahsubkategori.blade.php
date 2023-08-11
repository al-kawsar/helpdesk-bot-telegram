@extends('admin.layouts.va_main')

@section('content')
    <h2 class="ms-2 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Sub Kategori</h2>
    <div class="px-4 py-3 shadow-md dark:bg-gray-800 height">
        @error('sub-kategori')
            <div class="alert alert-sm alert-danger">{{ $message }}</div>
        @enderror
        <form action="/admin/tambah-sub-kategori" method="post">
            @csrf
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Sub Kategori <span
                        class="text-danger">*</span></span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="sub-kategori" />
            </label>
            <label class="block text-sm my-3">
                <span class="mb-2 text-gray-700 dark:text-gray-400 d-block">Pilih Kategori <span
                        class="text-danger">*</span></span>
                <select name="option"
                    class="block p-2 rounded mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray">
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                    @endforeach
                </select>



            </label>
            <button type="submit" class="btn btn-primary mt-4">Tambah Sub-Kategori</button>
        </form>


    </div>
@endsection
