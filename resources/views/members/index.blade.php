<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Anggota</h2>
            @auth
            @if (in_array(Auth::user()->role, ['admin', 'staff']))
            <a href="{{ route('members.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Tambah Anggota
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

            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="{{ route('members.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama / NIS-NIM / Email"
                            class="w-full border-gray-300 rounded focus:border-indigo-500 text-sm">
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        Cari
                    </button>
                    @if (request('search'))
                    <a href="{{ route('members.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-sm">Reset</a>
                    @endif
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">NIS/NIM</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Telepon</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($members as $member)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 font-medium">{{ $member->name }}</td>
                            <td class="px-4 py-3">{{ $member->nis_nim }}</td>
                            <td class="px-4 py-3">{{ $member->email }}</td>
                            <td class="px-4 py-3">{{ $member->phone }}</td>
                            <td class="px-4 py-3">
                                @if ($member->status === 'active')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Aktif</span>
                                @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('members.show', $member) }}"
                                    class="text-gray-600 hover:underline">Detail</a>

                                @auth
                                @if (in_array(Auth::user()->role, ['admin', 'staff']))
                                {{-- Tombol Suspend / Aktifkan --}}
                                <form action="{{ route('members.suspend', $member) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('{{ $member->status === 'active' ? 'Suspend anggota ini?' : 'Aktifkan anggota ini?' }}')">
                                    @csrf @method('PATCH')
                                    @if ($member->status === 'active')
                                    <button class="text-yellow-600 hover:underline">Suspend</button>
                                    @else
                                    <button class="text-green-600 hover:underline">Aktifkan</button>
                                    @endif
                                </form>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('members.edit', $member) }}"
                                    class="text-indigo-600 hover:underline">Edit</a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('members.destroy', $member) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                                @endif
                                @endauth
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada anggota.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $members->links() }}</div>
        </div>
    </div>
</x-app-layout>