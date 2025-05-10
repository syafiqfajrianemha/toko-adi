<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Toko Adi') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('style')
</head>
<body class="bg-white text-gray-800 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        @include('layouts.guest-navigation')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        <footer class="bg-blue-900 text-white py-12 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
                        <p class="text-sm leading-relaxed text-gray-200">
                            Belanja kebutuhan harian Anda dengan mudah dan cepat solusinya di <strong>Toko Adi</strong>.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                        <ul class="space-y-2 text-sm text-gray-200">
                            <li><a href="https://wa.me/{{ $whatsapp }}" class="hover:underline" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Akses Cepat</h3>
                        <ul class="text-sm text-gray-200 space-y-2">
                            <li><a href="{{ route('cart.index') }}" class="hover:underline">Keranjang belanja</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-10 border-t border-gray-200 pt-6 text-center text-sm text-gray-300">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    @stack('script')
</body>
</html>
