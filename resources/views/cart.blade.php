<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6 text-blue-700">Keranjang Anda</h2>

        @if(count($cartItems) > 0)
            <div class="space-y-6">
                @foreach ($cartItems as $id => $item)
                    <div class="flex justify-between items-center border-b pb-4">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center mt-2 space-x-2">
                                @csrf
                                <button name="qty" value="{{ $item['qty'] - 1 }}" class="px-2 bg-gray-200 hover:bg-gray-300 rounded text-lg font-bold">-</button>
                                <span class="px-3">{{ $item['qty'] }}</span>
                                <button name="qty" value="{{ $item['qty'] + 1 }}" class="px-2 bg-gray-200 hover:bg-gray-300 rounded text-lg font-bold">+</button>
                            </form>

                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-2 mt-2">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                        <p class="text-blue-700 font-bold">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                @endforeach

                <div class="text-right mt-6">
                    @php
                        $pesanText = urlencode("Halo Toko Adi, saya " . Auth::user()->name . " ingin memesan:\n" . collect($cartItems)->map(fn($i) => "{$i['name']} x {$i['qty']}")->implode("\n"));
                        $whatsappLink = "https://wa.me/" . $whatsapp . "?text={$pesanText}";
                    @endphp

                    <a href="{{ $whatsappLink }}" target="_blank" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>
        @else
            <p class="text-gray-600">Keranjang kosong.</p>
        @endif
    </div>
</x-guest-layout>
