<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Model kategori wisata

class KategoriWisataController extends Controller
{
    // Tampilkan semua kategori wisata
    public function index()
    {
        $categories = Category::withCount('destinations')->orderBy('id', 'desc')->paginate(10);
        return view('kategoriwisata.index', compact('categories'));
    }

    // Tampilkan form tambah kategori baru
    public function create()
    {
        return view('kategoriwisata.create');
    }

    // Simpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama',
            'deskripsi' => 'nullable|string',
        ]);

        Category::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('kategoriwisata.edit', compact('category'));
    }

    // Update data kategori
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama,'.$id,
            'deskripsi' => 'nullable|string',
        ]);

        $category->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('kategoriwisata.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
