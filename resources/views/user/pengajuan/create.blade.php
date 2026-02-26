<!-- resources/views/pengajuan/create.blade.php -->
<x-layouts.app-layout title="Form Pengajuan">
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="p-8">
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Form Pengajuan</h1>
                    <p class="text-gray-600">Isi form berikut untuk membuat pengajuan baru</p>
                </div>

                <form action="{{ route('pengajuan.store') }}" method="POST">
                    @csrf

                    <!-- Judul Pengajuan -->
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Judul Pengajuan
                        </label>
                        <input type="text" name="judul" id="judul" 
                               class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                               placeholder="Masukkan judul pengajuan" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-8">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="6"
                                  class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 shadow-sm"
                                  placeholder="Jelaskan detail pengajuan Anda" required></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-6 py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 font-semibold text-lg flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Kirim Pengajuan
                        </button>
                        
                        <a href="{{ route('user.pengajuan.index') }}" 
                           class="flex-1 border-2 border-orange-500 text-orange-500 hover:bg-orange-50 px-6 py-4 rounded-xl transition font-semibold text-lg flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-blue-800 text-lg mb-3">Tips Pengisian Form</h4>
                    <ul class="text-blue-700 space-y-2 text-sm">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Judul harus jelas dan deskriptif</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Deskripsi harus detail dan lengkap</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Pastikan informasi yang diberikan akurat</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app-layout>