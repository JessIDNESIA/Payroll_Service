<!-- resources/views/pengajuan/create.blade.php -->
<x-layouts.app-layout title="Form Pengajuan">
    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-4">Form Pengajuan</h1>

        <form action="{{ route('pengajuan.store') }}" method="POST">
            @csrf

            <!-- Judul Pengajuan -->
            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Pengajuan</label>
                <input type="text" name="judul" id="judul" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" 
    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 
           shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    Kirim Pengajuan
</button>
        </form>
    </div>
</x-layouts.app-layout>
