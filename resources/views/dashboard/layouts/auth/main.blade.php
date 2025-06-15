<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@stack('title') - File Manager</title>

    <link rel="icon" href="{{ asset('/') }}assets/images/favicon.png" type="image/png" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @stack('styles')
</head>

<body x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    @include('dashboard.partials.preloader')

    <div class="relative p-6 z-1 dark:bg-gray-900 sm:p-0">
        <div class="flex flex-col justify-center w-full min-h-screen dark:bg-gray-900 sm:p-0 lg:flex-row">
            @yield('content')

            <div class="relative items-center hidden w-full min-h-screen bg-sky-950 dark:bg-white/5 lg:grid lg:w-1/2">
                <div class="flex items-center justify-center z-1">
                    @include('dashboard.partials.common-grid-shape')

                    <div class="flex flex-col items-center max-w-xs">
                        <a href="{{ url('/') }}" class="block mb-4">
                            <img src="{{ asset('/') }}assets/tailadmin/images/logo/auth-logo.svg" alt="Logo" />
                        </a>
                        <p class="text-center text-gray-400 dark:text-white/60">
                            {{ __('File Manager modern untuk mengelola, berbagi, dan mengatur file Anda dengan mudah, cepat, dan aman.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="fixed z-50 hidden bottom-6 right-6 sm:block">
                <button class="cursor-pointer inline-flex items-center justify-center transition-colors rounded-full size-10 bg-white text-yellow-500 border border-gray-200 shadow-md
            hover:bg-yellow-100
            dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700" @click.prevent="darkMode = !darkMode"
                    :aria-label="darkMode ? '{{ __('Beralih ke mode terang') }}' : '{{ __('Beralih ke mode gelap') }}'" :title="darkMode ? '{{ __('Beralih ke mode terang') }}' : '{{ __('Beralih ke mode gelap') }}'">
                    <svg x-show="!darkMode" class="fill-current" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="5" fill="currentColor" />
                        <g stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="3" />
                            <line x1="12" y1="21" x2="12" y2="23" />
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                            <line x1="1" y1="12" x2="3" y2="12" />
                            <line x1="21" y1="12" x2="23" y2="12" />
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                        </g>
                    </svg>
                    <svg x-show="darkMode" class="fill-current" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z" fill="currentColor" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
