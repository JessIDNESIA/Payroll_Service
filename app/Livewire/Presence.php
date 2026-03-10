<?php

namespace App\Livewire;

use App\Models\Presensi;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Presence extends Component
{
    public $todayPresence;
    public $yesterdayPresence;
    public $previousPresences;
    public $flashMessage = '';
    public $flashType = 'success'; // success | warning

    public function mount()
    {
        $this->loadPresences();
    }

    public function loadPresences()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $this->todayPresence = Presensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        $this->yesterdayPresence = Presensi::where('user_id', $userId)
            ->where('tanggal', $yesterday)
            ->get();

        $this->previousPresences = Presensi::where('user_id', $userId)
            ->where('tanggal', '<', $yesterday)
            ->orderBy('tanggal', 'desc')
            ->take(30)
            ->get();
    }

    public function checkIn()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();

        $existing = Presensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if (!$existing) {
            // Hitung status: sebelum/tepat jam 08:00 = hadir, setelahnya = terlambat
            $batasJam = Carbon::today()->setTime(8, 0, 0);
            $status = $now->lte($batasJam) ? 'hadir' : 'terlambat';

            Presensi::create([
                'user_id' => $userId,
                'tanggal' => $today,
                'jam_masuk' => $now->toTimeString(),
                'status' => $status,
            ]);

            $label = $status === 'hadir' ? '✅ Hadir' : '⚠️ Terlambat';
            $this->flashMessage = "Berhasil Check In pukul {$now->format('H:i:s')} — {$label}";
            $this->flashType = $status === 'hadir' ? 'success' : 'warning';
        }

        $this->loadPresences();
    }

    public function checkOut()
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toTimeString();

        $existing = Presensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if ($existing && !$existing->jam_keluar) {
            $existing->update([
                'jam_keluar' => $now,
            ]);

            $this->flashMessage = "Berhasil Check Out pukul {$now}. Sampai jumpa! 👋";
            $this->flashType = 'success';
        }

        $this->loadPresences();
    }

    public function render()
    {
        return view('livewire.presence');
    }
}
