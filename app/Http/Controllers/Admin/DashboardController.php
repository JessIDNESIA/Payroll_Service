<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Datakaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index() {
        $data = [
            'datakaryawan' => Datakaryawan::count(),
            'pengajuan'    => Pengajuan::count(),
            'userlogin'    => User::count(),
            'karyawanPerBulan' => Datakaryawan::select(
                    DB::raw('MONTH(created_at) as bulan'),
                    DB::raw('COUNT(*) as jumlah')
                )->groupBy(DB::raw('MONTH(created_at)'))->orderBy(DB::raw('MONTH(created_at)'))->pluck('jumlah', 'bulan') // hasilnya: [1 => 5, 2 => 8, ...]
                ->toArray()
        ];
        
        return view('dashboard', compact('data'));
    }
}
 