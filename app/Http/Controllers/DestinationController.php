<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // Tampilkan semua destinasi
    public function index()
    {
        $destinations = Destination::with('kategori')->get(); // pastikan ada relasi
        return response()->json($destinations);
    }

    // Tampilkan satu destinasi
    public function show($id)
    {
        $destination = Destination::with('kategori')->findOrFail($id);
        return response()->json($destination);
    }

    // (Opsional) Tambah destinasi
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|string',
        ]);

        $destinasi = Destination::create($request->all());

        return response()->json(['message' => 'Destinasi berhasil ditambahkan', 'data' => $destinasi]);
    }
}
