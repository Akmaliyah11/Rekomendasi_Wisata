<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // Konstruktor untuk middleware auth
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan user sudah login
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'destinasi_id' => 'required|exists:destinations,id', // Pastikan destinasi_id ada di tabel destinations
        ]);

        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Cek apakah destinasi sudah ada di daftar favorit
        $exists = Favorite::where('user_id', $user->id)
            ->where('destinasi_id', $request->destinasi_id)
            ->exists();

        if (!$exists) {
            // Jika belum ada, simpan ke favorit
            Favorite::create([
                'user_id' => $user->id,
                'destinasi_id' => $request->destinasi_id,
            ]);

            return back()->with('success', 'Destinasi berhasil ditambahkan ke favorit!');
        } else {
            return back()->with('error', 'Destinasi sudah ada di daftar favorit!');
        }
    }
}
?>