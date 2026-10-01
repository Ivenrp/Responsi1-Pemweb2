<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Detail Anggota</h2>
            <div class="space-x-2">
                <a href="{{ route('members.edit', $member) }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">Edit</a>
                <a href="{{ route('members.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 space-y-3">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $member->name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <div><span class="text-gray-500">NIS/NIM:</span> <span class="font-medium">{{ $member->nis_nim }}</span></div>
                        <div><span class="text-gray-500">Email:</span> <span class="font-medium">{{ $member->email }}</span></div>
                        <div><span class="text-gray-500">Telepon:</span> <span class="font-medium">{{ $member->phone }}</span></div>
                        <div><span class="text-gray-500">Status:</span>
                            @if ($member->status === 'active')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Aktif</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">Nonaktif</span>
                            @endif
                        </div>
                        <div class="md:col-span-2"><span class="text-gray-500">Alamat:</span> <span class="font-medium">{{ $member->address }}</span></div>
                    </div>
                </div>

                <div class="border-t p-6">
                    <h3 class="font-semibold text-gray-700 mb-3">Riwayat Peminjaman</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">Buku</th>
                                    <th class="px-4 py-2 text-left">Tgl Pinjam</th>
                                    <th class="px-4 py-2 text-left">Jatuh Tempo</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Denda</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($member->loans as $loan)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loan->book->title ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $loan->loan_date->format('d M Y') }}</td>
                                        <td class="px-4 py-2">{{ $loan->due_date->format('d M Y') }}</td>
                                        <td class="px-4 py-2">{{ ucfirst($loan->status) }}</td>
                                        <td class="px-4 py-2">Rp {{ number_format($loan->fine, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada peminjaman.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>