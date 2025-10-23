<x-guest-layout>
    <section class="relative bg-cover bg-center bg-no-repeat py-20" style="background-image: url('{{ asset('images/toko-bg.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-start justify-center min-h-[60vh] text-white">
            <h2 class="text-4xl font-bold mb-4">Selamat Datang di Toko Adi</h2>
            <p class="text-lg mb-6 max-w-2xl">
                Belanja kebutuhan harian Anda dengan mudah dan cepat.
                Tersedia sembako, jajanan, minuman, dan produk UMKM lainnya.
            </p>
            <a href="#produk" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                Lihat Produk
            </a>
        </div>
    </section>

    <section class="bg-blue-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-semibold text-blue-700 mb-6">Kategori Produk</h3>
            <div id="category-list" class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="{{ route('home.index') }}"
                data-url="{{ route('home.index') }}"
                class="category-item bg-white p-4 rounded-lg shadow hover:shadow-lg text-center block transition">
                    <p class="text-blue-800 font-semibold">Semua Kategori</p>
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('filter.kategori', $category->slug) }}"
                    data-url="{{ route('filter.kategori', $category->slug) }}"
                    class="category-item bg-white p-4 rounded-lg shadow hover:shadow-lg text-center block transition">
                        <p class="text-blue-800 font-semibold">{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="produk" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="product-section">
                @include('user.partials.product-list', ['products' => $products, 'category' => $category ?? null])
            </div>
        </div>
    </section>

    @push('script')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('.category-item');

        categoryLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const url = this.dataset.url;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#product-section').innerHTML = html;
                    window.history.pushState({}, '', url);
                })
                .catch(err => console.error('Error:', err));
            });
        });
    });
    </script>
    @endpush
</x-guest-layout>
