<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Nama Kategori</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                               class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Deskripsi</label>
                        <textarea name="description" rows="3"
                                  class="w-full border-gray-300 rounded focus:border-indigo-500">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
