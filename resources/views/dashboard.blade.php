<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('admin.product.index') }}">
                        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-500 text-sm font-medium">Total Produk</h2>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalProduct }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="ti ti-package text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.category.index') }}">
                        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-500 text-sm font-medium">Kategori</h2>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalCategory }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="ti ti-category text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
