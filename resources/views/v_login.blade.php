@include('partials.v_head')
{{-- <a href="/" class="btn btn-primary position-relative top-0 end-0 me-auto mx-2 mt-3">Back To Home</a> --}}
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="md:h-auto md:w-1/2 p-3 h-full md:order-2">
                <img aria-hidden="true" class="object-contain  dark:hidden "
                    src="/img/logounm.png" alt="Office" />
            </div>
            <form action="{{ route('auth.login') }}" method="post"
                class="flex items-center justify-center p-6 sm:p-12 md:w-1/2 md:order-1">
                @method('POST')
                @csrf
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Login
                    </h1>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email Address</span>
                        <input type="email" name="email"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Email" autofocus required value="{{ old('email') }}">
                    </label>
                    @error('email')
                        <div class="text-danger my-2 fs-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input name="password"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="*****" type="password" required />
                    </label>
                    @error('password')
                        <div class="text-danger my-2 fs-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button type="submit"
                        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-100 focus:outline-none focus:shadow-outline-blue">
                        Log in
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
@include('partials.v_footer')
