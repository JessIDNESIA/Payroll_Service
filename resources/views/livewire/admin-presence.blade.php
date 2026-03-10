<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    {{-- ===== Header ===== --}}
    <div class="relative overflow-hidden bg-white rounded-3xl shadow-2xl border border-gray-100 mb-10">
        <div class="absolute top-0 right-0 -mt-16 -mr-16 w-64 h-64 bg-orange-100 rounded-full blur-3xl opacity-40 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

        <div class="relative p-8 md:p-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-50 text-orange-600 rounded-full text-xs font-black uppercase tracking-widest mb-3">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="5"/></svg>
                        Admin Panel
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Manajemen Presensi</h2>
                    <p class="text-gray-500 mt-1">Pantau kehadiran seluruh karyawan secara real-time.</p>
                </div>

                {{-- Summary Stats --}}
                <div class="flex flex-wrap gap-4">
                    <div class="text-center px-6 py-4 bg-green-50 rounded-2xl border border-green-100">
                        <p class="text-3xl font-black text-green-600">{{ $totalHadir }}</p>
                        <p class="text-xs font-bold text-green-500 uppercase tracking-wide mt-1">Hadir</p>
                    </div>
                    <div class="text-center px-6 py-4 bg-yellow-50 rounded-2xl border border-yellow-100">
                        <p class="text-3xl font-black text-yellow-600">{{ $totalTerlambat }}</p>
                        <p class="text-xs font-bold text-yellow-500 uppercase tracking-wide mt-1">Terlambat</p>
                    </div>
                    <div class="text-center px-6 py-4 bg-red-50 rounded-2xl border border-red-100">
                        <p class="text-3xl font-black text-red-500">{{ $totalBelumPulang }}</p>
                        <p class="text-xs font-bold text-red-400 uppercase tracking-wide mt-1">Belum Pulang</p>
                    </div>
                    <div class="text-center px-6 py-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-3xl font-black text-gray-700">{{ $totalUsers }}</p>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mt-1">Total User</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Filter Bar ===== --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal</label>
                <input
                    type="date"
                    wire:model.live="filterTanggal"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 font-mono text-gray-700 transition-all"
                />
            </div>
            <div class="flex-1">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Karyawan</label>
                <input
                    type="text"
                    wire:model.live.debounce.400ms="filterNama"
                    placeholder="Cari nama..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 text-gray-700 transition-all"
                />
            </div>
            <div>
                <button
                    wire:click="resetFilters"
                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl transition-all text-sm flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Reset
                </button>
            </div>
        </div>
    </div>

    {{-- ===== Table ===== --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div wire:loading.class="opacity-60" wire:target="filterTanggal,filterNama,resetFilters">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest text-left border-b border-gray-100">
                            <th class="px-6 py-5 font-black">Karyawan</th>
                            <th class="px-6 py-5 font-black">Tanggal</th>
                            <th class="px-6 py-5 font-black text-center">Check In</th>
                            <th class="px-6 py-5 font-black text-center">Check Out</th>
                            <th class="px-6 py-5 font-black text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($presensis as $p)
                            <tr class="hover:bg-orange-50/20 transition-all group">
                                {{-- Karyawan --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-black text-sm shrink-0">
                                            {{ strtoupper(substr($p->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 text-sm">{{ $p->user->name ?? 'Tidak Diketahui' }}</div>
                                            <div class="text-gray-400 text-xs">{{ $p->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-6 py-5">
                                    <div class="font-bold text-gray-700 text-sm">{{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->isoFormat('dddd') }}</div>
                                    <div class="text-gray-400 text-xs font-mono">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</div>
                                </td>

                                {{-- Check In --}}
                                <td class="px-6 py-5 text-center">
                                    @if($p->jam_masuk)
                                        <div class="inline-block px-3 py-1.5 bg-green-50 text-green-700 rounded-lg font-mono font-bold text-sm border border-green-100">
                                            {{ \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') }}
                                        </div>
                                    @else
                                        <span class="text-gray-300 text-sm italic">—</span>
                                    @endif
                                </td>

                                {{-- Check Out --}}
                                <td class="px-6 py-5 text-center">
                                    @if($p->jam_keluar)
                                        <div class="inline-block px-3 py-1.5 bg-red-50 text-red-600 rounded-lg font-mono font-bold text-sm border border-red-100">
                                            {{ \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') }}
                                        </div>
                                    @elseif($p->jam_masuk)
                                        <div class="inline-flex items-center gap-1.5 text-orange-500 text-xs font-bold">
                                            <span class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></span> Di tempat
                                        </div>
                                    @else
                                        <span class="text-gray-300 text-sm italic">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-5 text-center">
                                    @php
                                        $s = $p->status;
                                        [$badgeClass, $label] = match($s) {
                                            'hadir'     => ['bg-green-500 text-white shadow-green-200 shadow-lg', 'Hadir'],
                                            'terlambat' => ['bg-yellow-500 text-white shadow-yellow-200 shadow-lg', 'Terlambat'],
                                            'izin'      => ['bg-blue-500 text-white shadow-blue-200 shadow-lg', 'Izin'],
                                            default     => $p->jam_masuk
                                                ? ['bg-orange-400 text-white animate-pulse', 'On Progress']
                                                : ['bg-gray-100 text-gray-400', 'Tidak Hadir'],
                                        };
                                    @endphp
                                    <span class="px-3 py-1.5 {{ $badgeClass }} rounded-full text-xs font-black uppercase tracking-tighter">
                                        {{ $label }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <p class="text-gray-400 font-bold">Tidak ada data presensi</p>
                                        <p class="text-gray-300 text-sm mt-1">Coba ubah filter tanggal atau nama.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($presensis->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $presensis->links() }}
            </div>
        @endif
    </div>

    {{-- Loading overlay --}}
    <div wire:loading.flex wire:target="filterTanggal,filterNama,resetFilters" class="fixed inset-0 bg-white/40 backdrop-blur-sm z-50 items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl px-8 py-6 flex items-center gap-4 border border-gray-100">
            <svg class="w-6 h-6 text-orange-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            <span class="font-bold text-gray-600">Memuat data...</span>
        </div>
    </div>
</div>
