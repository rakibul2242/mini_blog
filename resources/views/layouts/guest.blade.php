<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/" wire:navigate>
                <x-application-logo class="w-20 h-20 fill-current text-red-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <div class="fixed flex bottom-8 right-8 bg-gray-500 dark:bg-gray-600 text-yellow-500 dark:text-gray-100 rounded-full p-2">
        <button onclick="toggleTheme()" id="themeToggle" class="w-6 h-6"> </button>
    </div>

    <script>
        const btn = document.getElementById('themeToggle');
        const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m16.95 5.05l-1.06-1.06M6.11 6.11L5.05 5.05m14.14 0l-1.06 1.06M6.11 17.89l-1.06 1.06M12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />    </svg>`;
        const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />    </svg>`;
        const isDark = localStorage.getItem('theme') === 'dark';

        if (isDark) document.documentElement.classList.add('dark');
        btn.innerHTML = isDark ? sunIcon : moonIcon;

        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const dark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
            btn.innerHTML = dark ? sunIcon : moonIcon;
        }
    </script>
</body>

</html>