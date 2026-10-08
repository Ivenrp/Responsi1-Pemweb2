<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Detail Buku</h2>
            <div class="space-x-2">
                @auth
                @if (in_array(Auth::user()->role, ['admin', 'staff']))
                <a href="{{ route('books.edit', $book) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">Edit</a>
                @endif
                @endauth
                <a href="{{ route('books.index') }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                    <div>
                        @if ($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}"
                            alt="{{ $book->title }}"
                            class="w-full rounded shadow">
                        @else
                        <div class="aspect-[3/4] bg-gray-100 rounded flex items-center justify-center text-gray-400">
                            No Cover
                        </div>
                        @endif
                    </div>

                    <div class="md:col-span-2 space-y-3">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $book->title }}</h1>
                        <p class="text-gray-600">oleh <span class="font-medium">{{ $book->author }}</span></p>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-500">ISBN:</span>
                                <span class="font-medium">{{ $book->isbn }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Penerbit:</span>
                                <span class="font-medium">{{ $book->publisher ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Tahun:</span>
                                <span class="font-medium">{{ $book->year ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Kategori:</span>
                                <span class="font-medium">{{ $book->category->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Stok Total:</span>
                                <span class="font-medium">{{ $book->stock }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Tersedia:</span>
                                <span class="font-medium text-green-600">{{ $book->availableStock() }}</span>
                            </div>
                        </div>

                        @if ($book->description)
                        <div class="pt-3 border-t">
                            <h3 class="font-semibold text-gray-700 mb-2">Deskripsi</h3>
                            <p class="text-gray-600 text-sm">{{ $book->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Riwayat Peminjaman — hanya untuk admin/staff --}}
                @auth
                @if (in_array(Auth::user()->role, ['admin', 'staff']))
                <div class="border-t p-6">
                    <h3 class="font-semibold text-gray-700 mb-3">Riwayat Peminjaman</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">Anggota</th>
                                    <th class="px-4 py-2 text-left">Tgl Pinjam</th>
                                    <th class="px-4 py-2 text-left">Jatuh Tempo</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($book->loans as $loan)
                                <tr>
                                    <td class="px-4 py-2">{{ $loan->member->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $loan->loan_date->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $loan->due_date->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($loan->status) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada peminjaman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>