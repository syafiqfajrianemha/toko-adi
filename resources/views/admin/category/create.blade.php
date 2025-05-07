<x-admin-layout>
    <div class="p-4 sm:ml-64 bg-white text-gray-900">
        <div class="mt-14">
            <div class="mb-3 flex justify-between items-center">
                <a href="{{ route('admin.category.index') }}" class="text-xl mr-3">⬅️</a>
                <h1 class="text-xl font-semibold">Tambah Kategori</h1>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium">Nama Kategori<span class="text-red-500">*</span></label>
                                <input id="name" type="text" name="name" class="w-full border-gray-300 rounded-md" value="{{ old('name') }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
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
</x-admin-layout>
