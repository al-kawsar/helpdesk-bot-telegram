@extends('admin.layouts.va_main')

@section('content')
    <h2 class="ms-2 my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Tambah Kategori</h2>
    <div class="px-4 py-3 shadow-md dark:bg-gray-800 height">
        {{-- Display validation errors if there are any --}}
        @if ($errors->any())
            <div class="alert alert-sm alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/admin/tambah-kategori" method="post">
            @csrf
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama kategori <span class="text-danger">*</span></span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="kategori" autofocus/>
            </label>

            {{-- Display placeholder for alerts --}}
            <div id="liveAlertPlaceholder"></div>

            {{-- Button to add a new input field --}}
            <button type="button" class="btn btn-secondary my-3" id="liveAlertBtn">Tambah Kolom</button>

            {{-- Submit button for adding category --}}
            <button type="submit" class="btn btn-primary mt-4 d-block">Tambah Kategori</button>
        </form>
    </div>
@endsection
