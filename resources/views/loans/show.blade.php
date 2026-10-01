<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Detail Peminjaman</h2>
            <div class="space-x-2">
                @if ($loan->status !== 'returned')
                    <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline"
                          onsubmit="return confirm('Kembalikan buku ini?')">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Kembalikan</button>
                    </form>
                @endif
                <a href="{{ route('loans.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-3 text-sm">
                <div><span class="text-gray-500">Anggota:</span> <span class="font-medium">{{ $loan->member->name ?? '-' }}</span></div>
                <div><span class="text-gray-500">Buku:</span> <span class="font-medium">{{ $loan->book->title ?? '-' }}</span></div>
                <div><span class="text-gray-500">Tanggal Pinjam:</span> <span class="font-medium">{{ $loan->loan_date->format('d M Y') }}</span></div>
                <div><span class="text-gray-500">Jatuh Tempo:</span> <span class="font-medium">{{ $loan->due_date->format('d M Y') }}</span></div>
                <div><span class="text-gray-500">Tanggal Kembali:</span> <span class="font-medium">{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</span></div>
                <div><span class="text-gray-500">Status:</span>
                    @if ($loan->status === 'returned')
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dikembalikan</span>
                    @elseif ($loan->isLate())
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terlambat</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Dipinjam</span>
                    @endif
                </div>
                <div><span class="text-gray-500">Denda:</span> <span class="font-medium text-red-600">Rp {{ number_format($loan->fine, 0, ',', '.') }}</span></div>
            </div>
        </div>
    </div>
</x-app-layout>