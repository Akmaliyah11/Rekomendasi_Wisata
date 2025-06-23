<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // Konstruktor untuk middleware auth
    public function index()
{
    $user = Auth::user();
    $favorites = Favorite::with('destinasi')
        ->where('user_id', $user->id)
        ->get();

    return view('favorit.index', compact('favorites'));
}

public function store(Request $request)
{
    $request->validate([
        'destinasi_id' => 'required|exists:destinations,id',
    ]);

    $user = Auth::user();

    $exists = Favorite::where('user_id', $user->id)
                      ->where('destinasi_id', $request->destinasi_id)
                      ->exists();

    if (! $exists) {
        Favorite::create([
            'user_id' => $user->id,
            'destinasi_id' => $request->destinasi_id,
        ]);

        return redirect()->route('favorit.index')
                         ->with('success', 'Destinasi berhasil ditambahkan!');
    }

    return redirect()->route('favorit.index')
                     ->with('error', 'Destinasi sudah ada di favorit.');
}
public function destroy($id)
{
    $favorit = Favorite::findOrFail($id);

    // Opsional: cek apakah favorit ini milik user yang login
    if ($favorit->user_id != auth()->id()) {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    $favorit->delete();

    return redirect()->back()->with('success', 'Destinasi dihapus dari favorit.');
}


}
?>