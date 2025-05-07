<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @media (prefers-color-scheme: dark) {
                .dark\:bg-gray-900\/80 {
                    background-color: transparent !important;
                }
            }
        </style>

        @stack('style')
    </head>
    <body class="font-sans antialiased">
        @include('layouts.admin-navigation')

        <main>
            {{ $slot }}
        </main>

        <script src="{{ asset('js/flowbite.min.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const sidebarToggle = document.querySelector("[data-drawer-toggle]");
                const sidebar = document.getElementById("logo-sidebar");

                if (sidebarToggle && sidebar) {
                    sidebarToggle.addEventListener("click", function () {
                        sidebar.classList.toggle("-translate-x-full");
                    });
                }

                const profileButton = document.querySelector("[data-dropdown-toggle='dropdown-user']");
                const profileMenu = document.getElementById("dropdown-user");

                if (profileButton && profileMenu) {
                    profileButton.addEventListener("click", function () {
                        profileMenu.classList.toggle("hidden");
                    });
                }
            });
        </script>
        @stack('script')
    </body>
</html>
