<x-layouts.app-layout title="Detail Pengajuan">
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan</h1>
                </div>
            </div>

            <!-- Content Section -->
            <div class="px-6 py-6 space-y-6">
                <!-- User Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Karyawan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Pengaju</label>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-gray-900">{{ $pengajuan->user->name }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <div class="p-3 rounded-lg flex items-center gap-2 {{
                            $pengajuan->status == 'diterima' ? 'bg-green-100 text-green-800' :
                            ($pengajuan->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800')
                        }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($pengajuan->status == 'diterima')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @elseif($pengajuan->status == 'ditolak')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                            <span class="font-medium">{{ ucfirst($pengajuan->status) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Pengajuan Details -->
                <div class="space-y-6">
                    <!-- Judul Pengajuan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-500">Judul Pengajuan</label>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-gray-900 font-medium flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $pengajuan->judul }}
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-1">
                    <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                    <div class="p-3 bg-gray-50 rounded-lg prose max-w-none">
                    <p class="text-gray-900 whitespace-pre-line">
                        {{ trim($pengajuan->deskripsi) }}
                    </p>
                    </div>
                    </div>

                <!-- Action Button -->
                <div class="border-t border-gray-200 pt-6">
                    <a href="{{ route('user.pengajuan.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app-layout>