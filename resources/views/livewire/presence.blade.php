<div
    x-data="{
        clock: '',
        date: '',
        updateClock() {
            const now = new Date();
            const pad = n => String(n).padStart(2, '0');
            this.clock = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
            const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            this.date = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
        }
    }"
    x-init="updateClock(); setInterval(() => updateClock(), 1000)"
    class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"
>
    {{-- ===== Hero Section ===== --}}
    <div class="relative overflow-hidden bg-white rounded-3xl shadow-2xl border border-orange-50 mb-10">
        {{-- Background blobs --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-72 h-72 bg-orange-100 rounded-full blur-3xl opacity-40 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-blue-100 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

        <div class="relative p-8 md:p-12 flex flex-col items-center text-center">
            {{-- Live badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 text-orange-600 rounded-full text-sm font-bold mb-6">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                LIVE ATTENDANCE SYSTEM
            </div>

            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-2">Presensi Karyawan</h2>

            {{-- Date from device via Alpine.js --}}
            <p class="text-lg text-gray-500 mb-8" x-text="date">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>

            {{-- Digital Clock — Device Time via Alpine.js --}}
            <div class="relative inline-block px-12 py-8 bg-gray-900 rounded-2xl shadow-inner mb-4 group transition-all hover:bg-black">
                <div class="absolute -top-1 -left-1 -right-1 -bottom-1 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition-opacity"></div>
                <div class="relative text-6xl md:text-7xl font-mono font-bold tracking-widest text-orange-500 drop-shadow-[0_0_15px_rgba(249,115,22,0.4)]" x-text="clock">00:00:00</div>
                <div class="mt-2 text-xs font-bold text-gray-400 uppercase tracking-widest">Waktu Perangkat Anda</div>
            </div>
            <p class="text-xs text-gray-400 mb-8 italic">Check-in/out dicatat menggunakan waktu server</p>

            {{-- Flash Notification (inline, Livewire reactive) --}}
            @if($flashMessage)
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-show="show"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    class="mb-6 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3
                        {{ $flashType === 'warning' ? 'bg-yellow-50 text-yellow-800 border border-yellow-200' : 'bg-green-50 text-green-800 border border-green-200' }}"
                >
                    @if($flashType === 'warning')
                        <svg class="w-5 h-5 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    @else
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @endif
                    {{ $flashMessage }}
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="flex flex-wrap justify-center gap-6">
                @if(!$todayPresence)
                    <button
                        wire:click="checkIn"
                        wire:key="user-checkin-btn"
                        wire:loading.attr="disabled"
                        wire:target="checkIn"
                        class="group relative px-10 py-5 bg-green-600 hover:bg-green-700 text-white font-black rounded-2xl shadow-[0_10px_30px_rgba(22,163,74,0.3)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-4 text-xl disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <div class="p-2 bg-white/20 rounded-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <span wire:loading.remove wire:target="checkIn">MASUK SEKARANG</span>
                        <span wire:loading wire:target="checkIn">Menyimpan...</span>
                    </button>
                @elseif(!$todayPresence->jam_keluar)
                    <div class="px-6 py-3 bg-green-50 text-green-700 rounded-xl text-sm font-bold border border-green-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Check In: {{ \Carbon\Carbon::parse($todayPresence->jam_masuk)->format('H:i:s') }}
                        @if($todayPresence->status === 'terlambat')
                            <span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded-full text-xs font-black">TERLAMBAT</span>
                        @endif
                    </div>
                    <button
                        wire:click="checkOut"
                        wire:key="user-checkout-btn"
                        wire:loading.attr="disabled"
                        wire:target="checkOut"
                        class="group relative px-10 py-5 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl shadow-[0_10px_30px_rgba(220,38,38,0.3)] transition-all transform hover:-translate-y-1 active:scale-95 flex items-center gap-4 text-xl disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <div class="p-2 bg-white/20 rounded-lg group-hover:-rotate-12 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <span wire:loading.remove wire:target="checkOut">PULANG SEKARANG</span>
                        <span wire:loading wire:target="checkOut">Menyimpan...</span>
                    </button>
                @else
                    <div class="px-10 py-5 bg-gray-100 text-gray-400 font-black rounded-2xl border-2 border-dashed border-gray-200 flex items-center gap-4 text-xl italic cursor-not-allowed">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        PRESENSI SELESAI HARI INI
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ===== Attendance History Table ===== --}}
    <div class="space-y-4">
        <h3 class="text-2xl font-black text-gray-800 flex items-center gap-3">
            <span class="w-3 h-8 bg-orange-500 rounded-full"></span>
            Rangkuman Kehadiran
        </h3>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest text-left">
                            <th class="px-8 py-5 font-black">Tanggal</th>
                            <th class="px-8 py-5 font-black text-center">Check In</th>
                            <th class="px-8 py-5 font-black text-center">Check Out</th>
                            <th class="px-8 py-5 font-black text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        {{-- ── Today ── --}}
                        <tr class="bg-orange-50/20">
                            <td colspan="4" class="px-8 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">Hari Ini</td>
                        </tr>
                        @if($todayPresence)
                            <tr class="group hover:bg-orange-50/30 transition-all">
                                <td class="px-8 py-6">
                                    <div class="font-black text-gray-800">{{ \Carbon\Carbon::parse($todayPresence->tanggal)->locale('id')->isoFormat('dddd') }}</div>
                                    <div class="text-gray-400 text-sm font-bold">{{ \Carbon\Carbon::parse($todayPresence->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="inline-block px-4 py-2 bg-green-50 text-green-700 rounded-xl font-mono font-bold border border-green-100">
                                        {{ \Carbon\Carbon::parse($todayPresence->jam_masuk)->format('H:i:s') }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($todayPresence->jam_keluar)
                                        <div class="inline-block px-4 py-2 bg-red-50 text-red-700 rounded-xl font-mono font-bold border border-red-100">
                                            {{ \Carbon\Carbon::parse($todayPresence->jam_keluar)->format('H:i:s') }}
                                        </div>
                                    @else
                                        <div class="text-gray-300 italic font-bold flex items-center justify-center gap-1">
                                            <span class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></span> Waiting...
                                        </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @php
                                        $status = $todayPresence->status;
                                        $badgeClass = match($status) {
                                            'hadir'     => 'bg-green-500 text-white shadow-green-200',
                                            'terlambat' => 'bg-yellow-500 text-white shadow-yellow-200',
                                            'izin'      => 'bg-blue-500 text-white shadow-blue-200',
                                            default     => 'bg-orange-500 text-white shadow-orange-200 animate-pulse',
                                        };
                                        $label = match($status) {
                                            'hadir'     => 'Hadir',
                                            'terlambat' => 'Terlambat',
                                            'izin'      => 'Izin',
                                            default     => $todayPresence->jam_keluar ? 'Selesai' : 'On Progress',
                                        };
                                    @endphp
                                    <span class="px-4 py-1.5 {{ $badgeClass }} rounded-full text-xs font-black uppercase tracking-tighter shadow-lg">
                                        {{ $label }}
                                    </span>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <p class="text-gray-400 font-bold italic">Belum ada presensi hari ini.</p>
                                        <p class="text-gray-300 text-xs mt-1">Klik tombol "Masuk Sekarang" di atas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        {{-- ── Yesterday ── --}}
                        <tr class="bg-blue-50/30">
                            <td colspan="4" class="px-8 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-blue-500">Kemarin</td>
                        </tr>
                        @forelse($yesterdayPresence as $p)
                            <tr class="group hover:bg-blue-50/20 transition-all">
                                <td class="px-8 py-6">
                                    <div class="font-black text-gray-600">Kemarin</div>
                                    <div class="text-gray-400 text-sm font-bold">{{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</div>
                                </td>
                                <td class="px-8 py-6 text-center font-mono font-bold text-gray-500">{{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i:s') : '-' }}</td>
                                <td class="px-8 py-6 text-center font-mono font-bold text-gray-500">{{ $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i:s') : '-' }}</td>
                                <td class="px-8 py-6 text-center">
                                    @php
                                        $s = $p->status;
                                        $bc = match($s) {
                                            'hadir'     => 'bg-green-100 text-green-700',
                                            'terlambat' => 'bg-yellow-100 text-yellow-700',
                                            'izin'      => 'bg-blue-100 text-blue-700',
                                            default     => 'bg-gray-100 text-gray-400',
                                        };
                                        $lbl = match($s) {
                                            'hadir'     => 'Hadir',
                                            'terlambat' => 'Terlambat',
                                            'izin'      => 'Izin',
                                            default     => 'Archived',
                                        };
                                    @endphp
                                    <span class="px-4 py-1.5 {{ $bc }} rounded-full text-xs font-black uppercase tracking-tighter">{{ $lbl }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-8 text-center text-gray-300 italic font-bold text-sm">Tidak ada data kemarin.</td>
                            </tr>
                        @endforelse

                        {{-- ── History ── --}}
                        @if($previousPresences->isNotEmpty())
                            <tr class="bg-gray-50/50">
                                <td colspan="4" class="px-8 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Riwayat Sebelumnya</td>
                            </tr>
                            @foreach($previousPresences as $p)
                                <tr class="hover:bg-gray-50/50 transition-all">
                                    <td class="px-8 py-5">
                                        <div class="font-bold text-gray-500 text-sm">{{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->isoFormat('dddd, D MMM Y') }}</div>
                                    </td>
                                    <td class="px-8 py-5 text-center text-gray-400 font-mono font-bold text-sm">{{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i') : '-' }}</td>
                                    <td class="px-8 py-5 text-center text-gray-400 font-mono font-bold text-sm">{{ $p->jam_keluar ? \Carbon\Carbon::parse($p->jam_keluar)->format('H:i') : '-' }}</td>
                                    <td class="px-8 py-5 text-center">
                                        @php
                                            $s = $p->status;
                                            $bc = match($s) {
                                                'hadir'     => 'bg-green-100 text-green-700',
                                                'terlambat' => 'bg-yellow-100 text-yellow-700',
                                                'izin'      => 'bg-blue-100 text-blue-700',
                                                default     => 'bg-gray-100 text-gray-300',
                                            };
                                            $lbl = match($s) { 'hadir' => 'Hadir', 'terlambat' => 'Terlambat', 'izin' => 'Izin', default => 'Recorded' };
                                        @endphp
                                        <span class="px-3 py-1 {{ $bc }} rounded-full text-xs font-black uppercase tracking-tighter">{{ $lbl }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>