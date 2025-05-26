<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Detail Gaji</title>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Detail Penggajian
                </h2>
            </div>

            <!-- Content Section -->
            <div class="px-8 py-8 space-y-6">
                <!-- Employee Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium text-gray-500 uppercase">Karyawan</h3>
                        <p class="text-lg text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $gaji->user->name }}
                        </p>
                    </div>
                    
                    <div class="space-y-1">
                        <h3 class="text-sm font-medium text-gray-500 uppercase">Periode</h3>
                        <p class="text-lg text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $gaji->bulan }}
                        </p>
                    </div>
                </div>

                <!-- Salary Details -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Rincian Gaji</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm text-gray-500">Gaji Pokok</dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">Tunjangan</dt>
                                    <dd class="text-lg font-medium text-green-600">
                                        + Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">Potongan</dt>
                                    <dd class="text-lg font-medium text-red-600">
                                        - Rp {{ number_format($gaji->potongan, 0, ',', '.') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4 flex items-center justify-center">
                            <div class="text-center">
                                <dt class="text-sm text-gray-500">Total Gaji Bersih</dt>
                                <dd class="text-3xl font-bold text-blue-800 mt-2">
                                    Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Status Pembayaran</h3>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{
                                $gaji->status == 'Lunas' 
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-yellow-100 text-yellow-800'
                            }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($gaji->status == 'Lunas')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                {{ $gaji->status }}
                            </span>
                        </div>
                        
                        <a href="{{ route('gaji.index') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Daftar Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>