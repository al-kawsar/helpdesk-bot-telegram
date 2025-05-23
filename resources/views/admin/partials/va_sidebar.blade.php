{{-- Desktop Sidebar --}}
<aside class=" hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 border">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="d-flex justify-content-center" href="/admin/dashboard">
            <img src="{{ asset('img') }}/logounm.png" class="" alt="" width="80">
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Dashboard'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Dashboard'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.dashboard') }}">
                    <svg class='w-5 h-5' aria-hidden='true' fill='none' stroke-linecap='round'
                        stroke-linejoin='round' stroke-width='2' viewBox='0 0 24 24' stroke='currentColor'>
                        <path
                            d='M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'>
                        </path>
                    </svg>
                    <span class='ml-4'>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role_id === '1')
                <li class="relative px-6 py-3">

                    {!! $title === 'Admin Tables'
                        ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                        : '' !!}

                    <a class="{!! $title === 'Admin Tables'
                        ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                        : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.admins') }}">
                        <i class="bi bi-person fs-5"></i>
                        <span class='ml-4'>Admins</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">

                    {!! $title === 'Admin Bot Settings'
                        ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                aria-hidden='true'></span>"
                        : '' !!}

                    <a class="{!! $title === 'Admin Bot Settings'
                        ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                        : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.botsettings') }}">
                        <i class="bi bi-robot fs-5"></i>
                        <span class='ml-4'>Bot Settings</span>
                    </a>
                </li>
            @endif

            <li class="relative px-6 py-3">

                {!! $title === 'Admin RequestPertanyaan'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin RequestPertanyaan'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.request') }}">
                    <i class="bi bi-question fs-5"></i>
                    <span class='ml-4'>Request Pertanyaan</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="togglePagesMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                        <span class="ml-4">Telegram</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin User'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                            <a class="{!! $title === 'Admin User'
                                ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                                : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.user') }}">
                                <i class="bi bi-person fs-5"></i>
                                <span class='ml-4'>User Telegram</span>
                            </a>
                        </li>
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin Grup'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                            <a class="{!! $title === 'Admin Grup'
                                ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                                : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.grup') }}">
                                <i class="bi bi-person-vcard fs-5"></i>
                                <span class='ml-4'>Grup Telegram</span>
                            </a>
                        </li>
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin Inbox'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                        </li>
                    </ul>
                </template>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.kategori') }}">
                    <i class="bi bi-box fs-5"></i>
                    <span class='ml-4'>Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Sub Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Sub Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.sub-kategori') }}">
                    <i class="bi bi-box2 fs-5"></i>
                    <span class='ml-4'>Sub Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Sub Sub Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Sub Sub Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.sub-sub-kategori') }}">
                    <i class="bi bi-boxes fs-5"></i>
                    <span class='ml-4'>Sub Sub Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Pertanyaan'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Pertanyaan'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.pertanyaan') }}">
                    <i class="bi bi-lightbulb fs-5"></i>
                    <span class='ml-4'>Pertanyaan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-100 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <ul class="mt-6">
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Dashboard'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Dashboard'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.dashboard') }}">
                    <svg class='w-5 h-5' aria-hidden='true' fill='none' stroke-linecap='round'
                        stroke-linejoin='round' stroke-width='2' viewBox='0 0 24 24' stroke='currentColor'>
                        <path
                            d='M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'>
                        </path>
                    </svg>
                    <span class='ml-4'>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role_id === '1')
                <li class="relative px-6 py-3">

                    {!! $title === 'Admin Tables'
                        ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                        : '' !!}

                    <a class="{!! $title === 'Admin Tables'
                        ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                        : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.admins') }}">
                        <i class="bi bi-person fs-5"></i>
                        <span class='ml-4'>Admins</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">

                    {!! $title === 'Admin Bot Settings'
                        ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                aria-hidden='true'></span>"
                        : '' !!}

                    <a class="{!! $title === 'Admin Bot Settings'
                        ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                        : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.botsettings') }}">
                        <i class="bi bi-robot fs-5"></i>
                        <span class='ml-4'>Bot Settings</span>
                    </a>
                </li>
            @endif

            <li class="relative px-6 py-3">

                {!! $title === 'Admin RequestPertanyaan'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin RequestPertanyaan'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.request') }}">
                    <i class="bi bi-question fs-5"></i>
                    <span class='ml-4'>Request Pertanyaan</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="togglePagesMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                        <span class="ml-4">Telegram</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin User'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                            <a class="{!! $title === 'Admin User'
                                ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                                : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.user') }}">
                                <i class="bi bi-person fs-5"></i>
                                <span class='ml-4'>User Telegram</span>
                            </a>
                        </li>
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin Grup'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                            <a class="{!! $title === 'Admin Grup'
                                ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                                : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.grup') }}">
                                <i class="bi bi-person-vcard fs-5"></i>
                                <span class='ml-4'>Grup Telegram</span>
                            </a>
                        </li>
                        <li
                            class="relative px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">

                            {!! $title === 'Admin Inbox'
                                ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                                : '' !!}

                        </li>
                    </ul>
                </template>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.kategori') }}">
                    <i class="bi bi-box fs-5"></i>
                    <span class='ml-4'>Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Sub Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Sub Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.sub-kategori') }}">
                    <i class="bi bi-box2 fs-5"></i>
                    <span class='ml-4'>Sub Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Sub Sub Kategori'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Sub Sub Kategori'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.sub-sub-kategori') }}">
                    <i class="bi bi-boxes fs-5"></i>
                    <span class='ml-4'>Sub Sub Kategori</span>
                </a>
            </li>
            <li class="relative px-6 py-3">

                {!! $title === 'Admin Pertanyaan'
                    ? "<span class='absolute inset-y-0 left-0 w-1 bg-blue-600 rounded-tr-lg rounded-br-lg'
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        aria-hidden='true'></span>"
                    : '' !!}

                <a class="{!! $title === 'Admin Pertanyaan'
                    ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100'
                    : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' !!}" href="{{ route('bot.pertanyaan') }}">
                    <i class="bi bi-lightbulb fs-5"></i>
                    <span class='ml-4'>Pertanyaan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

{{-- Mobile Sidebar End --}}
