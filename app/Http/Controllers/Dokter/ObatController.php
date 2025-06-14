<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Menampilkan daftar semua obat
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));
    }

    // Menampilkan form untuk menambahkan obat baru
    public function create()
    {
        return view('dokter.obat.create');
    }

    // Menyimpan data obat baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'kemasan' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'harga' => 'required|numeric|min:0',
        ]);

        // Cek apakah kombinasi nama obat dan kemasan sudah ada
        $exists = Obat::where('nama_obat', $validatedData['nama_obat'])
                      ->where('kemasan', $validatedData['kemasan'])
                      ->exists();

        // Jika sudah ada, tampilkan pesan error
        if ($exists) {
            return redirect()->route('dokter.obat.index')->with('danger', 'Obat dan Kemasan telah ada.');
        }

        // Simpan data obat baru
        Obat::create($validatedData);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    // Menampilkan form edit untuk obat tertentu
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    // Memperbarui data obat yang telah ada
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'kemasan' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'harga' => 'required|numeric|min:0',
        ]);

        // Cari data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Cek apakah kombinasi nama dan kemasan sudah digunakan obat lain
        $exists = Obat::where('id', '!=', $id)
                      ->where('nama_obat', $validatedData['nama_obat'])
                      ->where('kemasan', $validatedData['kemasan'])
                      ->exists();

        if ($exists) {
            return redirect()->route('dokter.obat.index')->with('danger', 'Obat dan Kemasan telah ada.');
        }

        // Update data obat
        $obat->update($validatedData);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    // Menghapus data obat
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
