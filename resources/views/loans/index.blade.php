<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Peminjaman</h2>
            <a href="{{ route('loans.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Catat Peminjaman
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
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="{{ route('loans.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="min-w-[180px]">
                        <label class="block text-sm mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                            <option value="">-- Semua --</option>
                            <option value="borrowed" @selected(request('status') === 'borrowed')>dipinjam</option>
                            <option value="returned" @selected(request('status') === 'returned')>Dikembalikan</option>
                        </select>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        Filter
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Anggota</th>
                            <th class="px-4 py-3 text-left">Buku</th>
                            <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-4 py-3 text-left">Jatuh Tempo</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Denda</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($loans as $loan)
                            <tr>
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium">{{ $loan->member->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $loan->book->title ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $loan->loan_date->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $loan->due_date->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    @if ($loan->status === 'returned')
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dikembalikan</span>
                                    @elseif ($loan->isLate())
                                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terlambat</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Dipinjam</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    Rp {{ number_format($loan->fine, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    @if ($loan->status !== 'returned')
                                        <form action="{{ route('loans.return', $loan) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Kembalikan buku ini?')">
                                            @csrf
                                            <button class="text-green-600 hover:underline font-medium">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('loans.show', $loan) }}"
                                       class="text-gray-600 hover:underline">Detail</a>
                                    <a href="{{ route('loans.edit', $loan) }}"
                                       class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('loans.destroy', $loan) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $loans->links() }}</div>
        </div>
    </div>
</x-app-layout>