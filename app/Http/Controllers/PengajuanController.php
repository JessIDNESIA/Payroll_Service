<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan admin bisa melihat semua (cek role ATAU akses lewat route admin)
        $isAdmin = auth()->user()->hasRole('admin') || request()->routeIs('admin.*');

        if ($isAdmin) {
            // Admin can see everything
            $pengajuans = Pengajuan::with('user')->latest()->paginate(10);
            $statsQuery = Pengajuan::query();
        } else {
            // Regular user only sees their own
            $pengajuans = Pengajuan::with('user')
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10);
            $statsQuery = Pengajuan::where('user_id', auth()->id());
        }

        // Statistik summary
        $stats = [
            'total' => (clone $statsQuery)->count(),
            'menunggu' => (clone $statsQuery)->where('status', 'menunggu')->count(),
            'diterima' => (clone $statsQuery)->where('status', 'diterima')->count(),
            'ditolak' => (clone $statsQuery)->where('status', 'ditolak')->count(),
        ];

        return view('user.pengajuan.index', compact('pengajuans', 'stats'));
    }

    public function setujui($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'diterima';
        $pengajuan->save();

        return back()->with('success', 'Pengajuan diterima.');
    }

    public function tolak($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        return back()->with('error', 'Pengajuan ditolak.');
    }

    public function destroy($id)
    {
        Pengajuan::destroy($id);
        return back()->with('success', 'Pengajuan dihapus.');
    }

    public function create()
    {
        return view('user.pengajuan.create'); // Pastikan view ini ada
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Pengajuan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'menunggu',
        ]);

        return redirect()->route('user.pengajuan.index')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with('user')->findOrFail($id);

        // Cek otorisasi: admin bisa lihat semua, user biasa hanya miliknya sendiri
        $isAdmin = auth()->user()->hasRole('admin') || request()->routeIs('admin.*');

        if (!$isAdmin && $pengajuan->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.pengajuan.show', compact('pengajuan'));
    }
}
