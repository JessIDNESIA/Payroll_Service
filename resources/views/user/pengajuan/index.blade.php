<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                {{ __('Daftar Pengajuan Karyawan') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Card utama -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-100">
            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-orange-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Manajemen Pengajuan</h3>
                            <p class="text-gray-600 font-medium">Kelola semua pengajuan dari karyawan</p>
                        </div>
                    </div>

                    @if(Auth()->user()->hasRole('user'))
                    <a href="{{ route('pengajuan.create') }}" 
                       class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2 font-bold">
                        <i class="fas fa-plus-circle"></i>
                        Buat Pengajuan Baru
                    </a>
                    @endif
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto rounded-lg border-2 border-gray-300 shadow-sm">
                    <table class="w-full border-collapse">
                        <thead class="bg-gradient-to-r from-orange-50 to-orange-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-user mr-2 text-orange-500"></i>Karyawan
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">Judul</th>
                                <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">Deskripsi</th>
                                <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-r-2 border-b-2 border-gray-300">
                                    <i class="fas fa-check-circle mr-2 text-orange-500"></i>Status
                                </th>
                                @if(Auth::user()->hasRole('admin'))
                                <th class="px-6 py-4 text-left text-sm font-black text-gray-800 uppercase tracking-wide border-b-2 border-gray-300">
                                    <i class="fas fa-cogs mr-2 text-orange-500"></i>Aksi
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($pengajuans as $pengajuan)
                            <tr class="hover:bg-orange-50 transition-colors duration-200 border-b-2 border-gray-300">
                                <!-- Karyawan -->
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 border-r-2 border-gray-300">
                                    {{ $pengajuan->user->name }}
                                    <div class="text-xs text-gray-600 font-semibold">{{ $pengajuan->created_at->format('d M Y') }}</div>
                                </td>

                                <!-- Judul -->
                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold border-r-2 border-gray-300">{{ $pengajuan->judul }}</td>

                                <!-- Deskripsi -->
                                <td class="px-6 py-4 text-sm text-gray-700 font-medium max-w-[300px] truncate border-r-2 border-gray-300" title="{{ $pengajuan->deskripsi }}">
                                    {{ $pengajuan->deskripsi }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 border-r-2 border-gray-300">
                                    <span class="px-4 py-2 rounded-full text-xs font-bold flex items-center gap-2 w-max {{
                                        $pengajuan->status == 'diterima' 
                                            ? 'bg-green-100 text-green-800 border-2 border-green-300' 
                                            : ($pengajuan->status == 'ditolak'
                                                ? 'bg-red-100 text-red-800 border-2 border-red-300'
                                                : 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300 animate-pulse')
                                    }}">
                                        @if($pengajuan->status == 'diterima')
                                            <i class="fas fa-check text-green-600"></i>
                                        @elseif($pengajuan->status == 'ditolak')
                                            <i class="fas fa-times text-red-600"></i>
                                        @else
                                            <i class="fas fa-clock text-yellow-600"></i>
                                        @endif
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                @if(Auth::user()->hasRole('admin'))
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <!-- Setujui -->
                                        <form action="{{ route('pengajuan.setujui', $pengajuan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                class="text-green-600 hover:text-green-800 p-2.5 rounded-lg hover:bg-green-100 transition-all duration-200 font-semibold"
                                                title="Setujui">
                                                <i class="fas fa-check text-base"></i>
                                            </button>
                                        </form>

                                        <!-- Tolak -->
                                        <form action="{{ route('pengajuan.tolak', $pengajuan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" 
                                                class="text-red-600 hover:text-red-800 p-2.5 rounded-lg hover:bg-red-100 transition-all duration-200 font-semibold"
                                                title="Tolak">
                                                <i class="fas fa-times text-base"></i>
                                            </button>
                                        </form>

                                        <!-- Detail -->
                                        <a href="{{ route('pengajuan.show', $pengajuan->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 p-2.5 rounded-lg hover:bg-blue-100 transition-all duration-200 font-semibold"
                                           title="Detail">
                                            <i class="fas fa-eye text-base"></i>
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-gray-600 hover:text-gray-800 p-2.5 rounded-lg hover:bg-gray-100 transition-all duration-200 font-semibold"
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
                                <td colspan="{{ Auth::user()->hasRole('admin') ? 5 : 4 }}" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                                        <p class="text-lg font-bold">Tidak ada data pengajuan</p>
                                        <p class="text-sm text-gray-400 mt-1 font-medium">Data pengajuan akan muncul di sini setelah ditambahkan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pengajuans->hasPages())
                <div class="mt-6">
                    {{ $pengajuans->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Statistik bawah - Improved Version -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Total Pengajuan -->
            <div class="bg-white border-2 border-orange-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-600 text-sm font-black uppercase tracking-wide mb-1">Total Pengajuan</p>
                        <p class="text-3xl font-black text-gray-900">{{ $pengajuans->count() }}</p>
                    </div>
                    <div class="bg-orange-100 p-4 rounded-full">
                        <i class="fas fa-clipboard-list text-3xl text-orange-600"></i>
                    </div>
                </div>
            </div>
            
            <!-- Menunggu -->
            <div class="bg-white border-2 border-yellow-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-600 text-sm font-black uppercase tracking-wide mb-1">Menunggu</p>
                        <p class="text-3xl font-black text-gray-900">{{ $pengajuans->where('status', 'menunggu')->count() }}</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full">
                        <i class="fas fa-clock text-3xl text-yellow-600"></i>
                    </div>
                </div>
            </div>
            
            <!-- Diterima -->
            <div class="bg-white border-2 border-green-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-600 text-sm font-black uppercase tracking-wide mb-1">Diterima</p>
                        <p class="text-3xl font-black text-gray-900">{{ $pengajuans->where('status', 'diterima')->count() }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-check-circle text-3xl text-green-600"></i>
                    </div>
                </div>
            </div>
            
            <!-- Ditolak -->
            <div class="bg-white border-2 border-red-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-600 text-sm font-black uppercase tracking-wide mb-1">Ditolak</p>
                        <p class="text-3xl font-black text-gray-900">{{ $pengajuans->where('status', 'ditolak')->count() }}</p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-full">
                        <i class="fas fa-times-circle text-3xl text-red-600"></i>
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
</x-app-layout>