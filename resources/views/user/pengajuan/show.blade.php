<x-layouts.app-layout title="Detail Pengajuan">
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100 overflow-hidden">
            
            <!-- Header Section -->
            <div class="px-8 py-6 bg-gradient-to-r from-orange-50 to-orange-100 border-b border-orange-200">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800">Detail Pengajuan</h1>
                        <p class="text-orange-600 font-medium">Informasi lengkap pengajuan karyawan</p>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="px-8 py-10 space-y-10">

                <!-- User Information & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <!-- Nama Karyawan -->
                    <div class="p-6 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Pengaju</h3>
                            <p class="text-lg font-semibold text-gray-900">{{ $pengajuan->user->name }}</p>
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="p-6 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{
                                $pengajuan->status == 'diterima' ? 'bg-green-100' :
                                ($pengajuan->status == 'ditolak' ? 'bg-red-100' : 'bg-amber-100')
                            }}">
                                <svg class="w-6 h-6 {{
                                    $pengajuan->status == 'diterima' ? 'text-green-500' :
                                    ($pengajuan->status == 'ditolak' ? 'text-red-500' : 'text-amber-500')
                                }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($pengajuan->status == 'diterima')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    @elseif($pengajuan->status == 'ditolak')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Status</h3>
                                <p class="text-lg font-semibold {{
                                    $pengajuan->status == 'diterima' ? 'text-green-800' :
                                    ($pengajuan->status == 'ditolak' ? 'text-red-800' : 'text-amber-800')
                                }}">{{ ucfirst($pengajuan->status) }}</p>
                            </div>
                        </div>                    
                    </div>
                </div>

                <!-- Detail Pengajuan -->
                <div class="bg-gradient-to-br from-white to-orange-50 rounded-xl p-8 border border-orange-200 shadow-sm space-y-8">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Detail Pengajuan
                    </h3>

                    <!-- Judul -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">Judul Pengajuan</label>
                        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                            <p class="text-lg font-medium text-gray-900 flex items-center gap-2">
                                {{ $pengajuan->judul }}
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">Deskripsi</label>
                        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                            <p class="text-gray-900 break-words whitespace-pre-line leading-relaxed">
                                {{ trim($pengajuan->deskripsi) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 space-y-4">
                    <h4 class="font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informasi Tambahan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Dibuat: {{ $pengajuan->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            <span>Diupdate: {{ $pengajuan->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('user.pengajuan.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 border-2 border-orange-500 text-orange-500 hover:bg-orange-50 rounded-xl transition font-semibold text-lg gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Daftar
                        </a>

                        @if(Auth::user()->hasRole('admin') && $pengajuan->status == 'menunggu')
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <form action="{{ route('pengajuan.setujui', $pengajuan->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-6 py-4 bg-green-500 hover:bg-green-600 text-white rounded-xl shadow-lg hover:shadow-xl transition font-semibold gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Setujui
                                </button>
                            </form>
                            <form action="{{ route('pengajuan.tolak', $pengajuan->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-6 py-4 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition font-semibold gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app-layout>
