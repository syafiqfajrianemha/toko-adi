<x-guest-layout>
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Selamat Datang di Toko Adi</h2>
                <p class="text-gray-700 mb-6">Belanja kebutuhan harian Anda dengan mudah dan cepat. Tersedia sembako, jajanan, minuman, dan produk UMKM lainnya.</p>
                <a href="#produk" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-200">Lihat Produk</a>
            </div>
            <div class="md:w-1/2">
                <img src="{{ asset('images/hero.svg') }}" alt="E-commerce Illustration" class="w-full">
            </div>
        </div>
    </section>

    <section class="bg-blue-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-semibold text-blue-700 mb-6">Kategori Produk</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg text-center">
                        <p class="text-blue-800 font-semibold">{{ $category->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="produk" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-semibold text-blue-700 mb-8">Produk Terbaru</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                <div class="bg-blue-50 rounded-lg overflow-hidden shadow hover:shadow-lg">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-blue-900 font-semibold text-lg mb-1">{{ $product->name }}</h4>
                        <p class="text-sm text-gray-700 mb-2">{{ Str::limit($product->description, 50) }}</p>
                        <div class="font-bold text-blue-700 text-lg mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <a href="{{ route('detail.produk', $product->id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">Lihat Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-guest-layout>
