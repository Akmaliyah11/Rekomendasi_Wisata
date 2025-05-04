<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;

class DataWisataController extends Controller
{
    // Tampilkan semua destinasi
    public function index()
    {
        $destinations = Destination::with('kategori')->get();
        return view('datawisata.index', compact('destinations'));
    }

    // Tampilkan form tambah destinasi
    public function create()
    {
        $categories = Category::all();
        return view('datawisata.create', compact('categories'));
    }

    // Simpan data destinasi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'fasilitas' => 'required|string', // memastikan fasilitas disertakan
            'rating_rata2' => 'required|numeric', // memastikan rating_rata2 disertakan
            'image' => 'required|url', // Validasi sebagai URL
        ]);
    
        Destination::create($request->all());
    
        return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }
    

    // Tampilkan form edit
    public function edit($id)
    {
        // Find the destination by its ID or fail if it doesn't exist
        $destination = Destination::findOrFail($id);
    
        // Get all categories for the dropdown or selection field
        $categories = Category::all();
    
        // Return the edit view and pass the destination and categories
        return view('datawisata.edit', compact('destination', 'categories'));
    }
    

    // Update data destinasi
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string',
        'kategori_id' => 'required|exists:categories,id',
        'fasilitas' => 'required|string',
        'rating_rata2' => 'required|numeric',
        'image' => 'required|url', // Validasi sebagai URL
    ]);

    $destination = Destination::findOrFail($id);
    $destination->update($request->all());

    return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil diperbarui.');
}


    // Hapus destinasi
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}
