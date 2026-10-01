<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('loans.update', $loan) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-1 font-medium">Anggota *</label>
                            <select name="member_id" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}"
                                            @selected(old('member_id', $loan->member_id) == $member->id)>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Buku *</label>
                            <select name="book_id" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}"
                                            @selected(old('book_id', $loan->book_id) == $book->id)>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 font-medium">Tanggal Pinjam *</label>
                                <input type="date" name="loan_date" value="{{ old('loan_date', $loan->loan_date->format('Y-m-d')) }}"
                                       class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            </div>
                            <div>
                                <label class="block mb-1 font-medium">Jatuh Tempo *</label>
                                <input type="date" name="due_date" value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}"
                                       class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Status *</label>
                            <select name="status" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <option value="borrowed" @selected(old('status', $loan->status) === 'borrowed')>Dipinjam</option>
                                <option value="returned" @selected(old('status', $loan->status) === 'returned')>Dikembalikan</option>
                                <option value="late" @selected(old('status', $loan->status) === 'late')>Terlambat</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('loans.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>