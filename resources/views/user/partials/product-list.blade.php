<h3 class="text-2xl font-semibold text-blue-700 mb-8">
    @if(request()->is('home') || request()->is('/'))
        Produk Terbaru
    @else
        Produk Kategori: {{ $category->name ?? '' }}
    @endif
</h3>

@if($products->isEmpty())
    <p class="text-gray-600 text-center">Belum ada produk di kategori ini.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($products as $product)
            <div class="bg-blue-50 rounded-lg overflow-hidden shadow hover:shadow-lg">
                <img src="{{ asset('storage/products/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="text-blue-900 font-semibold text-lg mb-1">{{ $product->name }}</h4>
                    <p class="text-sm text-gray-700 mb-2">{{ Str::limit($product->description, 50) }}</p>
                    <div class="font-bold text-blue-700 text-lg mb-3">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    <a href="{{ route('detail.produk', $product->id) }}"
                    class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
                    Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif
