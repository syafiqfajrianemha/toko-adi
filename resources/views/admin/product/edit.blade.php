<x-admin-layout>
    <div class="p-4 sm:ml-64 bg-white text-gray-900">
        <div class="mt-14">
            <div class="mb-3 flex justify-between items-center">
                <a href="{{ route('admin.product.index') }}" class="text-xl mr-3">⬅️</a>
                <h1 class="text-xl font-semibold">Edit Produk</h1>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium">Nama Produk<span class="text-red-500">*</span></label>
                                <input id="name" type="text" name="name" class="w-full border-gray-300 rounded-md" value="{{ !old('name') ? $product->name : old('name') }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium">Harga<span class="text-red-500">*</span></label>
                                <input id="price" type="number" name="price" class="w-full border-gray-300 rounded-md" value="{{ !old('price') ? $product->price : old('price') }}" required min="0">
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <label for="category_id" class="block mb-2 text-sm font-medium">Kategori<span class="text-red-500">*</span></label>
                                <x-select-option id="category_id" class="block mt-1 w-full" name="category_id" required>
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($product->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </x-select-option>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>
                            <div>
                                <label for="description" class="block mb-2 text-sm font-medium">Deskripsi<span class="text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ !old('description') ? $product->description : old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="default-image" class="img-thumbnail img-preview" width="300">
                                <input type="file" name="image" id="image" onchange="previewImage()">
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{ asset('js/imgpreview.js') }}"></script>
    @endpush
</x-admin-layout>
