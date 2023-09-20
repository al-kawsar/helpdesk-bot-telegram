@include('partials.v_head')
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2 p-3">
                <img aria-hidden="true" class="object object-cover w-full h-full dark:hidden "
                    src="public/assets/img/LOGO_CAMABA.jpg" alt="Office" />
            </div>
            <form action="/register" method="post" class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                @csrf
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Register
                    </h1>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Username</span>
                        <input type="text" name="name"
                            class="is-invalid block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Username" required>
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Email Address</span>
                        <input type="email" name="email"
                            class="is-invalid block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Email" required>
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input name="password"
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="***************" type="password" required />
                    </label>

                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button type="submit"
                        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-100 focus:outline-none focus:shadow-outline-blue">
                        Register
                    </button>

                    <hr class="my-8" />
                    <p class="mt-1 text-sm">sudah punya akun?<a
                            class="font-medium text-primary text-blue-400 hover:underline" href="/login">Login disini</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@include('partials.v_footer')
