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
            .children {
                background: #fff;
            }

            .children a,
            .children .separator {
                display: block;
                margin: 5px 0px;
                padding: 5px 10px;
            }

            .children .separator {
                border-top-width: 2px;
            }

            .children a:hover {
                color: #818cf8;
            }

            @media (min-width: 768px) {
                .children {
                    position: absolute;
                    width: 155px;
                    top: 70px;
                }
            }

            @media (max-width: 640px) {
                #dropdownHalal {
                    position: static;
                    width: 100%;
                }
            }
        </style>

        @stack('style')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.guest-navigation')

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <footer class="bg-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
                    <p class="text-sm leading-relaxed text-gray-200">
                        Toko Adi
                        <br>
                        Jl. Jalan Jalan, Purwokerto
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-200">
                        <li><a href="#" class="hover:underline">WhatsApp</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-semibold mb-4">Akses Cepat</h3>
                    <ul class="text-sm text-gray-200 space-y-2">
                        <li><a href="#" class="hover:underline" target="_blank">Riwayat Transaksi</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 border-t border-white pt-6 text-center text-sm text-white">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButton = document.getElementById("dropdownHalalButton");
            const dropdownMenu = document.getElementById("dropdownHalal");

            dropdownButton.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function (event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        });
    </script>
    @stack('script')
</html>
