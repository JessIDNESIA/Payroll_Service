<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Gaji
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-6 py-4">
                <form action="{{ route('gaji.update', $gaji->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-bold mb-2">Nama Karyawan:</label>
                        <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded px-3 py-2">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $gaji->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="bulan" class="block text-gray-700 font-bold mb-2">Bulan:</label>
                        <input type="text" name="bulan" id="bulan" value="{{ $gaji->bulan }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="total_gaji" class="block text-gray-700 font-bold mb-2">Total Gaji:</label>
                        <input type="number" name="total_gaji" id="total_gaji" value="{{ $gaji->total_gaji }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
                        <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="Belum Dibayar" {{ $gaji->status == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                            <option value="Lunas" {{ $gaji->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('gaji.index') }}" class="text-gray-600 hover:underline mr-4">Batal</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
