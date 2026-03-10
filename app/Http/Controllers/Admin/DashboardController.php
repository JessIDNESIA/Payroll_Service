<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Datakaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'datakaryawan' => Datakaryawan::count(),
            'pengajuan' => Pengajuan::count(),
            'userlogin' => User::count(),
            'karyawanPerBulan' => Datakaryawan::select(
                DB::raw('MONTH(tanggal_masuk) as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
                ->whereYear('tanggal_masuk', now()->year)
                ->groupBy(DB::raw('MONTH(tanggal_masuk)'))
                ->orderBy(DB::raw('MONTH(tanggal_masuk)'))
                ->pluck('jumlah', 'bulan')
                ->toArray()
        ];

        return view('dashboard', compact('data'));
    }
}
