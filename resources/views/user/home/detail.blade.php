<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded shadow">
        </div>
        <div>
            <h1 class="text-3xl font-bold text-blue-700">{{ $product->name }}</h1>
            <p class="mt-4 text-gray-600">{{ $product->description }}</p>
            <p class="mt-2 text-lg font-semibold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="flex items-center space-x-4">
                    <input type="number" name="qty" value="1" min="1" class="w-20 rounded border-gray-300 shadow-sm">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
