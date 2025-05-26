<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (auth()->user()->hasRole('admin')) {
        // Tampilan Admin
        $gajis = Gaji::with('user')->latest()->get();
    } else {
        // Tampilan User
        $gajis = Gaji::with('user')->where('user_id', auth()->id())->latest()->get();
    }

    return view('admin.gaji.index', compact('gajis'));
}

    /**
     * Show the form for creating a new resource.g
     */
    public function create()
    {
        $users = User::all(); // Ambil semua user/karyawan dari tabel users
        return view('admin.gaji.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric',
            'potongan' => 'required|numeric',
        ], [
            'bulan.required' => 'Bulan wajib diisi.',
            'gaji_pokok.required' => 'Gaji pokok wajib diisi.',
            'tunjangan.required' => 'Tunjangan wajib diisi.',
            'potongan.required' => 'Potongan wajib diisi.',
            'bulan.string' => 'Penulisan harus menggunakan huruf',
            'gaji_pokok.numeric' => 'Gaji pokok wajib menggunakan angka.',
            'tunjangan.numeric' => 'Tunjangan wajib menggunakan angka.',
            'potongan.numeric' => 'Potongan wajib menggunakan angka.',
        ]);

        // Hitung total gaji SEBELUM disimpan
    $data['total_gaji'] = ($data['gaji_pokok'] + ($data['tunjangan'] ?? 0)) - ($data['potongan'] ?? 0);
    $data['status'] = 'Belum Dibayar';

    Gaji::create($data);

    return redirect()->route('gaji.index')->with('success', 'Gaji berhasil ditambahkan.');
    }
    
    public function bayar($id) {
       // Ambil data gaji berdasarkan ID
    $gaji = Gaji::findOrFail($id);

    // Periksa apakah gaji tersebut milik pengguna yang sedang login
    if ($gaji->user_id !== auth()->id()) {
        // Perbarui status gaji menjadi 'Lunas'
        $gaji->status = 'Lunas';
        $gaji->save();
    }


    // Redirect kembali ke daftar gaji dengan pesan sukses
    return redirect()->route('gaji.index')->with('success', 'Status gaji berhasil diperbarui.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $gaji = Gaji::with('user')->findOrFail($id);
    return view('admin.gaji.show', compact('gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gaji = Gaji::findOrFail($id);
        $users = User::all(); // Untuk dropdown user

        return view('admin.gaji.edit', compact('gaji', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|string',
            'total_gaji' => 'required|numeric',
            'status' => 'required|in:Belum Dibayar,Lunas',
        ]);
    
        $gaji = Gaji::findOrFail($id);
        $gaji->update([
            'user_id' => $request->user_id,
            'bulan' => $request->bulan,
            'total_gaji' => $request->total_gaji,
            'status' => $request->status,
        ]);
    
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus.');
    }

    public function updateStatus($id)
    {
    $gaji = Gaji::findOrFail($id);

    // Update status ke "Lunas"
    $gaji->status = 'Lunas';
    $gaji->save();

    // Notifikasi sukses
    return redirect()->back()->with('success', 'Status gaji berhasil diperbarui menjadi Lunas.');
    }

}
