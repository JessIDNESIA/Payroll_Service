<?php

namespace App\Livewire;

use App\Models\Datakaryawan;
use App\Models\Pengajuan;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Component
{
    public $totalUsers;
    public $totalPengajuan;
    public $totalKaryawan;
    public $chartData;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalPengajuan = Pengajuan::count();
        $this->totalKaryawan = Datakaryawan::count();

        // Prepare chart data: Employee count by month of entry (Current Year)
        $employeesByMonth = Datakaryawan::select(
            DB::raw('MONTH(tanggal_masuk) as month'),
            DB::raw('count(*) as count')
        )
            ->whereYear('tanggal_masuk', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = array_fill(0, 12, 0);

        foreach ($employeesByMonth as $item) {
            $monthIndex = (int) $item->month - 1;
            if ($monthIndex >= 0 && $monthIndex < 12) {
                $data[$monthIndex] = $item->count;
            }
        }

        $this->chartData = [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Karyawan Masuk',
                    'data' => $data,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 4,
                    'tension' => 0.4,
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
