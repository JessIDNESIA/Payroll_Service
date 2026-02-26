<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Detail Gaji</title>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100 overflow-hidden">
            <!-- Header Section -->
            <div class="px-8 py-6 bg-gradient-to-r from-orange-50 to-orange-100 border-b border-orange-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-800">Detail Penggajian</h2>
                            <p class="text-orange-600 font-medium">Informasi lengkap slip gaji karyawan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="px-8 py-8 space-y-8">
                <!-- Employee & Period Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-orange-500"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Karyawan</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $gaji->user->name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-blue-500"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 uppercase">Periode</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $gaji->bulan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary Breakdown -->
                <div class="bg-gradient-to-br from-white to-orange-50 rounded-xl p-6 border border-orange-200 shadow-sm">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <i class="fas fa-calculator text-orange-500"></i>
                        Rincian Gaji
                    </h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Gaji Pokok -->
                        <div class="text-center p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-wallet text-green-500 text-xl"></i>
                            </div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Gaji Pokok</h4>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</p>
                        </div>

                        <!-- Tunjangan -->
                        <div class="text-center p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-plus-circle text-blue-500 text-xl"></i>
                            </div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Tunjangan</h4>
                            <p class="text-2xl font-bold text-green-600">+ Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</p>
                        </div>

                        <!-- Potongan -->
                        <div class="text-center p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-minus-circle text-red-500 text-xl"></i>
                            </div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Potongan</h4>
                            <p class="text-2xl font-bold text-red-600">- Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Salary Card -->
                <div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-xl p-8 text-white shadow-lg">
                    <div class="flex flex-col lg:flex-row items-center justify-between">
                        <div class="text-center lg:text-left mb-6 lg:mb-0">
                            <h3 class="text-xl font-semibold text-orange-100 mb-2">Total Gaji Bersih</h3>
                            <p class="text-orange-200">Yang diterima oleh karyawan setelah potongan</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl lg:text-5xl font-extrabold">
                                Rp {{ number_format(($gaji->gaji_pokok + $gaji->tunjangan - $gaji->potongan), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="border-t border-gray-200 pt-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <div class="space-y-3">
                            <h3 class="text-sm font-medium text-gray-500 uppercase">Status Pembayaran</h3>
                            <div class="flex items-center gap-4">
                                <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-semibold {{
                                    $gaji->status == 'Lunas' 
                                        ? 'bg-green-100 text-green-800 border border-green-200'
                                        : 'bg-yellow-100 text-yellow-800 border border-yellow-200 animate-pulse'
                                }}">
                                    @if($gaji->status == 'Lunas')
                                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    @else
                                        <i class="fas fa-clock text-yellow-500 mr-3"></i>
                                    @endif
                                    {{ $gaji->status }}
                                </span>
                            </div>
                        </div>
                        
                        <a href="{{ route('gaji.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 border-2 border-orange-500 text-orange-500 hover:bg-orange-50 rounded-xl transition font-semibold text-lg gap-3">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        Informasi Tambahan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar-day text-orange-500"></i>
                            <span>Dibuat pada: {{ $gaji->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-sync-alt text-blue-500"></i>
                            <span>Diupdate: {{ $gaji->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</body>
</html>
