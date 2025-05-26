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
    $pengajuans = Pengajuan::with('user')->latest()->get();
    return view('user.pengajuan.index', compact('pengajuans'));
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
    return view('user.pengajuan.show', compact('pengajuan'));
    }
}
