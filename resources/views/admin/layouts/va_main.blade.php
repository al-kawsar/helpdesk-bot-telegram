@auth
    @include('partials.v_head')

    <div class="loading">Loading&#8230;</div>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include('admin.partials.va_sidebar')

        <div class="flex flex-col flex-1 w-full">

            @include('admin.partials.va_navbar')
            @yield('content')
        </div>
    </div>


    @include('partials.v_footer')
    @yield('script')
@endauth
