<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Buku</h2>
            <a href="{{ route('books.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Buku
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="{{ route('books.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Judul / Penulis / ISBN"
                               class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                    </div>
                    <div class="min-w-[180px]">
                        <label class="block text-sm mb-1">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                            <option value="">-- Semua --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        Filter
                    </button>
                    @if (request('search') || request('category_id'))
                        <a href="{{ route('books.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse ($books as $book)
                    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden flex flex-col">
                        <div class="aspect-[3/4] bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                     alt="{{ $book->title }}"
                                     class="w-full h-kfull object-cover">
                            @else
                                <div class="text-gray-400 text-sm">No Cover</div>
                            @endif
                        </div>

                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-semibold text-gray-800 line-clamp-2">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $book->author }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $book->category->name ?? '-' }} •  {{ $book->year ?? '-' }}
                            </p>

                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $book->availableStock() > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    Stok: {{ $book->availableStock() }} / {{ $book->stock }}
                                </span>
                            </div>

                            <div class="mt-4 pt-3 border-t flex justify-between items-center text-sm">
                                <a href="{{ route('books.show', $book) }}"
                                   class="text-gray-600 hover:underline">Detail</a>
                                <div class="space-x-2">
                                    <a href="{{ route('books.edit', $book) }}"
                                       class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('books.destroy', $book) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white shadow-sm sm:rounded-lg p-8 text-center text-gray-500">
                        Belum ada buku. <a href="{{ route('books.create') }}" class="text-indigo-600 hover:underline">Tambah sekarang</a>.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $books->links() }}</div>
        </div>
    </div>
</x-app-layout>