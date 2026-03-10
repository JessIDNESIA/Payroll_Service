<?php

namespace App\Livewire;

use App\Models\Presensi;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class AdminPresence extends Component
{
    use WithPagination;

    public $filterTanggal = '';
    public $filterNama = '';
    public $todayPresence;
    public $flashMessage = '';
    public $flashType = 'success';

    protected $queryString = ['filterTanggal', 'filterNama'];

    public function mount()
    {
        // Guard: only admin may view this page
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Akses ditolak.');
        }

        // Default filter: today
        $this->filterTanggal = now()->toDateString();
        $this->loadTodayPresence();
    }

    public function loadTodayPresence()
    {
        $this->todayPresence = Presensi::where('user_id', Auth::id())
            ->where('tanggal', now()->toDateString())
            ->first();
    }

    public function checkIn()
    {
        $userId = Auth::id();
        $today = now()->toDateString();
        $now = now();

        $existing = Presensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if (!$existing) {
            $batasJam = now()->today()->setTime(8, 0, 0);
            $status = $now->lte($batasJam) ? 'hadir' : 'terlambat';

            Presensi::create([
                'user_id' => $userId,
                'tanggal' => $today,
                'jam_masuk' => $now->toTimeString(),
                'status' => $status,
            ]);

            $this->flashMessage = "Check-in berhasil (" . ($status == 'hadir' ? "Hadir" : "Terlambat") . ")";
            $this->flashType = $status == 'hadir' ? 'success' : 'warning';
        }

        $this->loadTodayPresence();
    }

    public function checkOut()
    {
        $userId = Auth::id();
        $today = now()->toDateString();
        $now = now()->toTimeString();

        $existing = Presensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if ($existing && !$existing->jam_keluar) {
            $existing->update([
                'jam_keluar' => $now,
            ]);

            $this->flashMessage = "Check-out berhasil!";
            $this->flashType = 'success';
        }

        $this->loadTodayPresence();
    }

    public function updatingFilterTanggal()
    {
        $this->resetPage();
    }

    public function updatingFilterNama()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->filterTanggal = now()->toDateString();
        $this->filterNama = '';
        $this->resetPage();
    }

    public function getPresensisProperty()
    {
        return Presensi::with('user')
            ->when($this->filterTanggal, fn($q) => $q->where('tanggal', $this->filterTanggal))
            ->when($this->filterNama, fn($q) => $q->whereHas('user', fn($u) => $u->where('name', 'like', '%' . $this->filterNama . '%')))
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'asc')
            ->paginate(20);
    }

    public function getTotalHadirProperty()
    {
        return Presensi::when($this->filterTanggal, fn($q) => $q->where('tanggal', $this->filterTanggal))
            ->whereIn('status', ['hadir', 'terlambat'])
            ->count();
    }

    public function getTotalTerlambatProperty()
    {
        return Presensi::when($this->filterTanggal, fn($q) => $q->where('tanggal', $this->filterTanggal))
            ->where('status', 'terlambat')
            ->count();
    }

    public function getTotalBelumPulangProperty()
    {
        return Presensi::when($this->filterTanggal, fn($q) => $q->where('tanggal', $this->filterTanggal))
            ->whereNull('jam_keluar')
            ->whereNotNull('jam_masuk')
            ->count();
    }

    public function render()
    {
        return view('livewire.admin-presence', [
            'presensis' => $this->presensis,
            'totalHadir' => $this->totalHadir,
            'totalTerlambat' => $this->totalTerlambat,
            'totalBelumPulang' => $this->totalBelumPulang,
            'totalUsers' => User::count(),
        ])->layout('layouts.app', ['header' => 'Manajemen Presensi']);
    }
}
