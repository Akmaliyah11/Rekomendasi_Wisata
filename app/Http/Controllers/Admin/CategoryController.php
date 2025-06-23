<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata;

class KategoriWisataController extends Controller
{
    // Menampilkan daftar kategori wisata
    public function index()
    {
        $categories = KategoriWisata::all();
        return view('kategoriwisata.index', compact('categories'));
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        return view('kategoriwisata.create');
    }

    // Simpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriWisata::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $category = KategoriWisata::findOrFail($id);
        return view('kategoriwisata.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $category = KategoriWisata::findOrFail($id);
        $category->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = KategoriWisata::findOrFail($id);
        $category->delete();

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
