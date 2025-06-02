<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    // Menampilkan semua jadwal periksa milik dokter yang sedang login
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();
        return view('dokter.jadwal-periksa.index')->with([
            'jadwalPeriksas'=> $jadwalPeriksas
        ]);
    }

    // Menampilkan form untuk menambahkan jadwal periksa baru
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    // Menyimpan data jadwal periksa baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validateData = $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek apakah jadwal sudah pernah dibuat sebelumnya
        if (
            JadwalPeriksa::where('id_dokter', Auth::user()->id)
                ->where('hari', $validateData['hari'])
                ->where('jam_mulai', $validateData['jam_mulai'])
                ->where('jam_selesai', $validateData['jam_selesai'])
                ->exists()
        ) {
            return redirect()->route('dokter.jadwal-periksa.index')->with('danger', 'Jadwal sudah ada.');
        }

        // Simpan data jadwal periksa baru
        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $validateData['hari'],
            'jam_mulai' => $validateData['jam_mulai'],
            'jam_selesai' => $validateData['jam_selesai'],
            'status' => 0 // default nonaktif
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal berhasil ditambah.');
    }

    // Mengaktifkan/nonaktifkan jadwal periksa
    public function update($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        // Jika status nonaktif, aktifkan
        if (!$jadwalPeriksa->status) {
            $jadwalPeriksa->status = 1;
            $jadwalPeriksa->save();

            return redirect()->route('dokter.jadwal-periksa.index')
                ->with('success', 'Jadwal berhasil diaktifkan.');
        }

        // Jika aktif, nonaktifkan
        $jadwalPeriksa->status = 0;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('success', 'Jadwal berhasil dinonaktifkan.');
    }

    // Menghapus jadwal periksa dari database
    public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}
