<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                    <div class="text-sm text-gray-500">Total Buku</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $stats['books'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm text-gray-500">Total Anggota</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $stats['members'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm text-gray-500">Peminjaman Aktif</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $stats['active_loans'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="text-sm text-gray-500">Terlambat</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $stats['late_loans'] }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Peminjaman Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-4 py-2 text-left">Anggota</th>
                                <th class="px-4 py-2 text-left">Buku</th>
                                <th class="px-4 py-2 text-left">Tgl Pinjam</th>
                                <th class="px-4 py-2 text-left">Jatuh Tempo</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($recentLoans as $loan)
                                <tr>
                                    <td class="px-4 py-2">{{ $loan->member->name }}</td>
                                    <td class="px-4 py-2">{{ $loan->book->title }}</td>
                                    <td class="px-4 py-2">{{ $loan->loan_date->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $loan->due_date->format('d M Y') }}</td>
                                    <td class="px-4 py-2">
                                        @if ($loan->status === 'returned')
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Dikembalikan</span>
                                        @elseif ($loan->isLate())
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terlambat</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Dipinjam</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
