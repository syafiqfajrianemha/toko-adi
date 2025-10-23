<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6 text-blue-700">Keranjang Anda</h2>

        @if(count($cartItems) > 0)
            <form id="whatsappForm">
                <div class="space-y-6">
                    @foreach ($cartItems as $id => $item)
                        <div class="flex justify-between items-center border-b pb-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="selected[]" value="{{ $id }}" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>

                            <div>
                                <h3 class="font-semibold text-lg">{{ $item['name'] }}</h3>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-2 mt-2">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:underline hidden">Hapus</button>
                                </form>
                            </div>

                            <div class="w-20 h-20 flex-shrink-0">
                                <img src="{{ asset('storage/products/' . $item['image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover rounded-lg shadow-sm border">
                            </div>

                            <div>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center mt-2 space-x-2">
                                    @csrf
                                    <button name="qty" value="{{ $item['qty'] - 1 }}" class="px-2 bg-gray-200 hover:bg-gray-300 rounded text-lg font-bold">-</button>
                                    <span class="px-3">{{ $item['qty'] }}</span>
                                    <button name="qty" value="{{ $item['qty'] + 1 }}" class="px-2 bg-gray-200 hover:bg-gray-300 rounded text-lg font-bold">+</button>
                                </form>
                            </div>

                            <p class="text-blue-700 font-bold">
                                Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </p>

                            <input type="hidden" name="product_data[{{ $id }}]"
                                   data-name="{{ $item['name'] }}"
                                   data-qty="{{ $item['qty'] }}">
                        </div>
                    @endforeach

                    <div class="text-right mt-6">
                        <button type="button" id="whatsappBtn"
                                class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                            Pesan via WhatsApp
                        </button>
                    </div>
                </div>
            </form>
        @else
            <p class="text-gray-600">Keranjang kosong.</p>
        @endif
    </div>

    <script>
        document.getElementById('whatsappBtn').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[name="selected[]"]:checked');
            if (checkboxes.length === 0) {
                alert('Pilih minimal satu produk untuk dipesan.');
                return;
            }

            let pesan = "Halo Toko Adi, saya {{ Auth::user()->name }} ingin memesan:\n";
            checkboxes.forEach((checkbox) => {
                const id = checkbox.value;
                const data = document.querySelector(`input[name="product_data[${id}]"]`);
                const name = data.getAttribute('data-name');
                const qty = data.getAttribute('data-qty');
                pesan += `${name} x ${qty}\n`;
            });

            const encoded = encodeURIComponent(pesan);
            const whatsapp = "{{ $whatsapp }}";
            const link = `https://wa.me/${whatsapp}?text=${encoded}`;
            window.open(link, '_blank');
        });
    </script>
</x-guest-layout>
