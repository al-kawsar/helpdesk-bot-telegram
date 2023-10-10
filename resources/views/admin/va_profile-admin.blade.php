@extends('admin.layouts.va_main')

@section('content')
    <div class="container pt-3">
        <div class="d-flex align-items-center gap-2">
            <div class="px-3 py-2 text-white rounded" style="background: #11c5c6;">
                <i class="bi bi-person-fill fs-5"></i>
            </div>
            <p class="fs-6">Proggres Profile</p>
        </div>
        @error('warning')
            <div class="alert alert-warning mt-3">
                {{ $message }}
            </div>
        @enderror

        <hr class="my-3">
        <form action="/admin/{{ $user->id }}/profile" method="post" class="">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="Nama admin"
                    value="{{ $user->name }}">
                @error('name')
                    <div class="text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Email Admin"
                    value="{{ $user->email }}">
                @error('email')
                    <div class="text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 position-relative">
                <button onclick="myFunction()" class="position-absolute right-0 top-0 btn btn-primary"
                type="button" id="btnPass" style="transform: translateY(32px)"><i class="bi bi-eye-fill"></i></button>
                <label class="form-label">Password</label>
                <input type="password" class="form-control @if (session()->has('in-valid')) is-invalid @endif"
                    name="password" placeholder="" id="inputPass"
                    value="@php
try {
                    $decrypted = Crypt::decrypt($user->password);
                    echo explode('.',$decrypted)[1];
                } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                    echo $e->getMessage();
                } @endphp">
                @if (session()->has('password'))
                    <div class="text-sm text-danger">
                        {{ session()->get('password') }}
                    </div>
                @endif
                @error('password')
                    <div class="text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success">Perbarui Profile</button>
        </form>

    </div>
@endsection
@section('script')
    <script>
        function myFunction() {
            var x = document.getElementById("inputPass");
            var y = document.getElementById("btnPass");
            if (x.type === "password") {
                x.type = "text";
                y.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
            } else {
                x.type = "password";
                y.innerHTML = "<i class='bi bi-eye-fill'></i>";
            }
        }
    </script>
@endsection
