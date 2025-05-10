<x-admin-layout>
    <div class="p-4 sm:ml-64 bg-white text-gray-900">
        <div class="mt-14">
            <div class="mb-3 flex justify-between items-center">
                <a href="{{ route('admin.whatsapp.index') }}" class="text-xl mr-3">⬅️</a>
                <h1 class="text-xl font-semibold">Tambah Nomor WhatsApp</h1>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <span class="text-red-500">Catatan: pastikan nomor whatsapp menggunkan format 62 (contoh: 62878xxxxxxxx)</span>
                    <form action="{{ route('admin.whatsapp.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="whatsapp" class="block mb-2 text-sm font-medium">Nomor WhatsApp<span class="text-red-500">*</span></label>
                                <input id="whatsapp" type="text" name="whatsapp" class="w-full border-gray-300 rounded-md" value="{{ old('whatsapp') }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
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
        <script src="{{ asset('js/phone.js') }}"></script>
    @endpush
</x-admin-layout>
