<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Kategori Buku</h2>
            @auth
            @if (in_array(Auth::user()->role, ['admin', 'staff']))
            <a href="{{ route('categories.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Kategori
            </a>
            @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-left">Jumlah Buku</th>
                            @auth
                            @if (in_array(Auth::user()->role, ['admin', 'staff']))
                            <th class="px-4 py-3 text-right">Aksi</th>
                            @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($categories as $category)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                            <td class="px-4 py-3">{{ $category->description ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $category->books_count }}</td>
                            @auth
                            @if (in_array(Auth::user()->role, ['admin', 'staff']))
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                            @endif
                            @endauth
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $categories->links() }}</div>
        </div>
    </div>
</x-app-layout>