<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Gaji Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('gaji.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="user_id" class="block font-medium">Nama Karyawan</label>
                <select name="user_id" id="user_id" class="w-full border rounded p-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="bulan" class="block font-medium">Bulan</label>
                <input type="text" name="bulan" id="bulan" class="w-full border rounded p-2" placeholder="Mei 2025">
            </div>

            <div>
                <label for="gaji_pokok" class="block font-medium">Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="tunjangan" class="block font-medium">Tunjangan</label>
                <input type="number" name="tunjangan" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="potongan" class="block font-medium">Potongan</label>
                <input type="number" name="potongan" class="w-full border rounded p-2">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Simpan Gaji
            </button>
        </form>
    </div>
</x-app-layout>
