<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Catat Peminjaman Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-1 font-medium">Anggota *</label>
                            <select name="member_id" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                                        {{ $member->name }} ({{ $member->nis_nim }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Buku *</label>
                            <select name="book_id" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <option value="">-- Pilih Buku --</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id)>
                                        {{ $book->title }} —stok: {{ $book->stock }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 font-medium">Tanggal Pinjam *</label>
                                <input type="date" name="loan_date" value="{{ old('loan_date', date('Y-m-d')) }}"
                                       class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            </div>
                            <div>
                                <label class="block mb-1 font-medium">Jatuh Tempo *</label>
                                <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}"
                                       class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('loans.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>