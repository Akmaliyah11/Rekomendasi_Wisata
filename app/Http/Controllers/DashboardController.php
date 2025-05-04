<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $kategoriDipilih = $request->input('kategori');

    // Ambil destinasi dengan relasi kategori dan reviews
    $destinasi = Destination::with(['kategori', 'reviews.user']);  // Tambahkan 'reviews.user'

    // Jika kategori difilter
    if ($kategoriDipilih) {
        $destinasi->whereHas('kategori', function ($query) use ($kategoriDipilih) {
            $query->where('nama', $kategoriDipilih);
        });
    }

    $destinasi = $destinasi->get();

    // Kirim ke view dashboard
    return view('dashboard', compact('destinasi'));
}

}
