<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                {{ __('Daftar Gaji Karyawan') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="p-8">
                @if(Auth()->user()->hasRole('admin'))
                    <!-- Header dengan tabel yang lebih rapi -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-money-check-alt text-orange-500 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Manajemen Gaji Karyawan</h3>
                                    <p class="text-gray-600 text-sm font-medium">Kelola data gaji dan pembayaran karyawan
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('gaji.create') }}"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2 font-bold">
                                <i class="fas fa-plus-circle"></i>
                                Tambah Gaji
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Table Container -->
                <div class="overflow-x-auto rounded-lg border-2 border-gray-300 shadow-sm">
                    <table class="w-full border-collapse">
                        <thead class="bg-gradient-to-r from-orange-50 to-orange-100">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-user mr-2 text-orange-500"></i>Nama
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-calendar mr-2 text-orange-500"></i>Bulan
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-money-bill-wave mr-2 text-orange-500"></i>Total
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-check-circle mr-2 text-orange-500"></i>Status
                                </th>
                                @if(Auth::user()->hasRole('admin'))
                                    <th
                                        class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-b-2 border-gray-300">
                                        <i class="fas fa-cogs mr-2 text-orange-500"></i>Aksi
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($gajis as $gaji)
                                                    <tr class="hover:bg-orange-50 transition-colors duration-200 border-b-2 border-gray-300">
                                                        <td class="px-6 py-4 text-sm text-gray-900 font-bold border-r-2 border-gray-300">
                                                            {{ $gaji->user->name }}
                                                        </td>

                                                        {{-- ✏️ DIUBAH: format bulan angka saja, satu baris --}}
                                                        <td class="px-6 py-4 text-sm font-semibold text-gray-800 border-r-2 border-gray-300">
                                                            @php
                                                                try {
                                                                    $formatTgl = \Carbon\Carbon::parse($gaji->bulan)->format('d/m/Y');
                                                                } catch (\Exception $e) {
                                                                    $formatTgl = $gaji->bulan;
                                                                }
                                                            @endphp
                                                            {{ $formatTgl }}
                                                        </td>
                                                        {{-- ✏️ SELESAI PERUBAHAN --}}

                                                        <td class="px-6 py-4 text-sm font-bold text-gray-900 border-r-2 border-gray-300">
                                                            Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-6 py-4 border-r-2 border-gray-300">
                                                            <span class="px-4 py-2 rounded-full text-xs font-bold flex items-center justify-center w-max gap-2 {{
                                $gaji->status == 'Lunas'
                                ? 'bg-green-100 text-green-800 border-2 border-green-300'
                                : 'bg-red-100 text-red-800 border-2 border-red-300 animate-pulse'
                                                                                                            }}">
                                                                @if($gaji->status == 'Lunas')
                                                                    <i class="fas fa-check text-green-600"></i>
                                                                @else
                                                                    <i class="fas fa-times text-red-600"></i>
                                                                @endif
                                                                {{ $gaji->status }}
                                                            </span>
                                                        </td>

                                                        @if(Auth::user()->hasRole('admin'))
                                                            <td class="px-6 py-4">
                                                                <div class="flex items-center gap-3">
                                                                    <!-- Edit Button -->
                                                                    <a href="{{ route('gaji.edit', $gaji->id) }}"
                                                                        class="text-orange-600 hover:text-orange-800 p-2.5 rounded-lg hover:bg-orange-100 transition-all duration-200 font-semibold"
                                                                        title="Edit">
                                                                        <i class="fas fa-edit text-base"></i>
                                                                    </a>

                                                                    <!-- Mark as Paid Button -->
                                                                    @if($gaji->status === 'Belum Dibayar')
                                                                        <form action="{{ route('gaji.updateStatus', $gaji->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <button type="submit"
                                                                                class="text-green-600 hover:text-green-800 p-2.5 rounded-lg hover:bg-green-100 transition-all duration-200 font-semibold"
                                                                                title="Tandai Lunas">
                                                                                <i class="fas fa-check text-base"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif

                                                                    <!-- Detail Button -->
                                                                    <a href="{{ route('gaji.show', $gaji->id) }}"
                                                                        class="text-blue-600 hover:text-blue-800 p-2.5 rounded-lg hover:bg-blue-100 transition-all duration-200 font-semibold"
                                                                        title="Detail">
                                                                        <i class="fas fa-eye text-base"></i>
                                                                    </a>

                                                                    <!-- Delete Button -->
                                                                    <form action="{{ route('gaji.destroy', $gaji->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            onclick="return confirm('Yakin ingin menghapus data gaji ini?')"
                                                                            class="text-red-600 hover:text-red-800 p-2.5 rounded-lg hover:bg-red-100 transition-all duration-200 font-semibold"
                                                                            title="Hapus">
                                                                            <i class="fas fa-trash-alt text-base"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                            @empty
                                <tr class="border-b-2 border-gray-300">
                                    <td colspan="{{ Auth::user()->hasRole('admin') ? 5 : 4 }}"
                                        class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-bold">Tidak ada data gaji</p>
                                            <p class="text-sm text-gray-400 mt-1 font-medium">Data gaji akan muncul di sini
                                                setelah ditambahkan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Stats Card - Improved Version -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Gaji Card -->
            <div
                class="bg-white border-2 border-orange-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-600 text-sm font-black uppercase tracking-wide mb-1">Total Gaji</p>
                        <p class="text-3xl font-black text-gray-900">Rp
                            {{ number_format($stats['total_gaji'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-orange-100 p-4 rounded-full">
                        <i class="fas fa-money-bill-wave text-3xl text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Gaji Lunas Card -->
            <div
                class="bg-white border-2 border-green-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-600 text-sm font-black uppercase tracking-wide mb-1">Gaji Lunas</p>
                        <p class="text-3xl font-black text-gray-900">{{ $stats['lunas'] }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-check-circle text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Belum Dibayar Card -->
            <div
                class="bg-white border-2 border-red-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-600 text-sm font-black uppercase tracking-wide mb-1">Belum Dibayar</p>
                        <p class="text-3xl font-black text-gray-900">
                            {{ $stats['belum_dibayar'] }}
                        </p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-full">
                        <i class="fas fa-exclamation-circle text-3xl text-red-600"></i>
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

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }
    </style>
</x-app-layout>