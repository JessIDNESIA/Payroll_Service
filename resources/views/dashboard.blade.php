<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-600 font-medium mt-1">
                        @if(Auth::user()->hasRole('admin'))
                            👋 Selamat datang, {{ Auth::user()->name }}!
                        @else
                            👋 Selamat datang, {{ Auth::user()->name }}!
                        @endif
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ now()->format('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div
            class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-orange-100 mb-8">
            <div class="p-8">
                <div class="flex items-center gap-6">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang di PayrollService!</h3>
                        <p class="text-gray-600">
                            @if(Auth::user()->hasRole('admin'))
                                Anda login sebagai Administrator. Kelola gaji dan pengajuan karyawan dengan mudah.
                            @else
                                Anda berhasil login. Kelola informasi gaji dan ajukan permohonan Anda di sini.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="p-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Aksi Cepat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('gaji.index') }}"
                        class="flex items-center gap-4 p-4 bg-orange-50 border border-orange-200 rounded-xl hover:bg-orange-100 transition-all duration-200 group">
                        <div
                            class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Lihat Gaji</h4>
                            <p class="text-sm text-gray-600">Kelola dan lihat informasi gaji</p>
                        </div>
                    </a>

                    <a href="{{ route('user.pengajuan.index') }}"
                        class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-200 rounded-xl hover:bg-blue-100 transition-all duration-200 group">
                        <div
                            class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Pengajuan</h4>
                            <p class="text-sm text-gray-600">Ajukan permohonan baru</p>
                        </div>
                    </a>

                    <a href="{{ route('presensi') }}"
                        class="flex items-center gap-4 p-4 bg-green-50 border border-green-200 rounded-xl hover:bg-green-100 transition-all duration-200 group">
                        <div
                            class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Presensi</h4>
                            <p class="text-sm text-gray-600">Check in / check out kehadiran</p>
                        </div>
                    </a>

                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.presensi.index') }}"
                            class="flex items-center gap-4 p-4 bg-purple-50 border border-purple-200 rounded-xl hover:bg-purple-100 transition-all duration-200 group">
                            <div
                                class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Kelola Presensi</h4>
                                <p class="text-sm text-gray-600">Pantau kehadiran seluruh karyawan</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('admin'))
            <div class="mt-8">
                <livewire:admin-dashboard />
            </div>
        @endif
    </div>
</x-app-layout>