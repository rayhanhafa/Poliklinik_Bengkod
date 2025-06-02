<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'kemasan' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'harga' => 'required|numeric|min:0',
        ]);

        $exists = Obat::where('nama_obat', $validatedData['nama_obat'])
                      ->where('kemasan', $validatedData['kemasan'])
                      ->exists();

        if ($exists) {
            return redirect()->route('dokter.obat.index')->with('danger', 'Obat dan Kemasan telah ada.');
        }

        Obat::create($validatedData);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'kemasan' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat = Obat::findOrFail($id);

        $exists = Obat::where('id', '!=', $id)
                      ->where('nama_obat', $validatedData['nama_obat'])
                      ->where('kemasan', $validatedData['kemasan'])
                      ->exists();

        if ($exists) {
            return redirect()->route('dokter.obat.index')->with('danger', 'Obat dan Kemasan telah ada.');
        }

        $obat->update($validatedData);

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
