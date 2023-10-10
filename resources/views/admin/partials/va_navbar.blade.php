<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-blue dark:text-blue">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <!-- Search input -->

        @if (Request::path() != 'admin/dashboard')
            <form action="{{ request()->fullUrl() }}" method="get" class="flex justify-center items-center flex-1">
                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                    <input
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        type="text" placeholder="Pencarian" aria-label="Search" name="search"
                        value="{{ request()->get('search') }}" autocomplete="off" />

                </div>
                <button class="btn btn-primary mx-1" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <a href="{{ url()->current() }}" class="btn btn-primary mx-1" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" data-bs-title="reset pencarian">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </form>
        @endif
        <button class="d-flex gap-2 align-items-center shadow-md rounded px-2 ms-auto " type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="bi bi-person-circle fs-2"></i>
            <p class="text-uppercase">{{ auth()->user()->name }}</p>
        </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title d-flex gap-3" id="offcanvasRightLabel">
                <i class="bi bi-person-circle fs-2"></i>
                <div class="info-user">
                    <p>{{ auth()->user()->email }}</p>
                    <div class="badge bg-info">{{ auth()->user()->role_id === '1' ? 'Superadmin' : 'Admin' }}</div>
                </div>
            </h5>
            <button type="button" class="btn-close bg-secondary text-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul>
                <hr>
                <li class="nav-items prof-h rounded px-3 py-1 my-1">
                    <a href="/admin/{{ auth()->user()->id }}/profile" class="gap-2 nav-link d-flex align-items-center">
                        <div class="icon">
                            <i class="bi bi-person fs-5"></i>
                        </div> <span class="fs-6">Your Profile</span>
                    </a>
                </li>
                <hr>
                <li class="nav-items prof-h rounded px-3 py-1 my-3">
                    <a href="/admin/logout" class="gap-2 nav-link d-flex align-items-center">
                        <div class="icon">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </div> <span class="fs-6">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    </div>
</header>
