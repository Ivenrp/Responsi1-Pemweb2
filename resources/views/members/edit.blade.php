<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Anggota</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('members.update', $member) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name', $member->name) }}"
                                class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">NIS / NIM *</label>
                            <input type="text" name="nis_nim" value="{{ old('nis_nim', $member->nis_nim) }}"
                                class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $member->email) }}"
                                class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Telepon *</label>
                            <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                                class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Status *</label>
                            <select name="status" class="w-full border-gray-300 rounded focus:border-indigo-500" required>
                                <option value="active" @selected(old('status', $member->status) === 'active')>Aktif</option>
                                <option value="inactive" @selected(old('status', $member->status) === 'inactive')>Nonaktif</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1 font-medium">Alamat *</label>
                            <textarea name="address" rows="3"
                                class="w-full border-gray-300 rounded focus:border-indigo-500" required>{{ old('address', $member->address) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('members.index') }}"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>