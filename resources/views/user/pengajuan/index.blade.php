<x-layouts.app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <h1 class="text-3xl font-semibold text-gray-900">Daftar Pengajuan</h1>
                @if(auth()->user()->hasRole('user'))
                <a href="{{ route('pengajuan.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-sm transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Pengajuan
                </a>
                @endif
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Karyawan</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Judul</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            @role('admin')
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 max-w-[150px]">
                                <div class="text-sm text-gray-900 truncate" title="{{ $pengajuan->user->name }}">
                                    {{ $pengajuan->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-[200px]">
                                <div class="text-sm text-gray-900 truncate" title="{{ $pengajuan->judul }}">
                                    {{ $pengajuan->judul }}
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-[300px]">
                                <div class="text-sm text-gray-600 truncate" title="{{ $pengajuan->deskripsi }}">
                                    {{ $pengajuan->deskripsi }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium inline-flex items-center gap-1.5 {{
                                        $pengajuan->status == 'menunggu' ? 'bg-amber-100 text-amber-800 border border-amber-200' :
                                        ($pengajuan->status == 'diterima' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')
                                    }}">
                                        @if($pengajuan->status == 'menunggu')
                                        <svg class="w-3.5 h-3.5 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a5 5 0 00-5 5v3a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"/>
                                        </svg>
                                        @elseif($pengajuan->status == 'diterima')
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        @else
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        @endif
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>
                                    <a href="{{ route('pengajuan.show', $pengajuan->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 flex items-center gap-1 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>

                            @role('admin')
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('pengajuan.setujui', $pengajuan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button 
                                            class="p-2 rounded-lg hover:bg-green-100 text-green-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                                            title="Setujui"
                                            @if ($pengajuan->status == 'disetujui') disabled @endif>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('pengajuan.tolak', $pengajuan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button 
                                            class="p-2 rounded-lg hover:bg-red-100 text-red-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                                            title="Tolak"
                                            @if ($pengajuan->status == 'ditolak') disabled @endif>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" method="POST" onsubmit="return confirm('Hapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            class="p-2 rounded-lg hover:bg-gray-100 text-gray-600 transition-colors duration-200"
                                            title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app-layout>