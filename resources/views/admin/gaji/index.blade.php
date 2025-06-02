<x-app-layout>
    <x-slot name="header">
        <div class="px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-900">
                {{ __('Daftar Gaji Karyawan') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            @if(Auth()->user()->hasRole('admin'))
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('gaji.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 sm:px-6 sm:py-3 rounded-lg shadow-sm transition-colors duration-200 flex items-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Gaji
                </a>
            </div>
            @endif

            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs sm:text-sm font-semibold text-gray-700">Nama</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs sm:text-sm font-semibold text-gray-700">Bulan</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs sm:text-sm font-semibold text-gray-700">Total</th>
                            <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs sm:text-sm font-semibold text-gray-700">Status</th>
                            @if(Auth::user()->hasRole('admin'))
                            <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs sm:text-sm font-semibold text-gray-700">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($gajis as $gaji)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-900">{{ $gaji->user->name }}</td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-900">{{ $gaji->bulan }}</td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-xs sm:text-sm text-gray-900">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium flex items-center justify-center w-max gap-1 {{
                                    $gaji->status == 'Lunas' 
                                        ? 'bg-green-100 text-green-800' 
                                        : 'bg-red-100 text-red-800 animate-pulse'
                                }}">
                                    @if($gaji->status != 'Lunas')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @endif
                                    {{ $gaji->status }}
                                </span>
                            </td>
                            
                            @if(Auth::user()->hasRole('admin'))
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                                    <a href="{{ route('gaji.edit', $gaji->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 p-1 rounded hover:bg-indigo-50"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    @if($gaji->status === 'Belum Dibayar')
                                    <form action="{{ route('gaji.updateStatus', $gaji->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-900 p-1 rounded hover:bg-green-50"
                                                title="Tandai Lunas">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('gaji.show', $gaji->id) }}" 
                                        class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50"
                                        title="Detail">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                         </svg>
                                     </a>

                                    <form action="{{ route('gaji.destroy', $gaji->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Yakin ingin menghapus?')" 
                                                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                                                title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->hasRole('admin') ? 5 : 4 }}" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada data gaji.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>