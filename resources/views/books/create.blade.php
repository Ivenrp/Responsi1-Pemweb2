<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Judul Buku *</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Penulis *</label>
                            <input type="text" name="author" value="{{ old('author') }}"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            @error('author') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">ISBN *</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            @error('isbn') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Tahun</label>
                            <input type="number" name="year" value="{{ old('year') }}"
                                   min="1900" max="{{ date('Y') }}"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Kategori *</label>
                            <select name="category_id"
                                    class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Stok *</label>
                            <input type="number" name="stock" value="{{ old('stock', 1) }}" min="0"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            @error('stock') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Cover Buku</label>
                            <input type="file" name="cover" accept="image/*"
                                   class="w-full border-gray-300 rounded focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks 2MB.</p>
                            @error('cover') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full border-gray-300 rounded focus:border-indigo-500">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('books.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>