<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Destination;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    
    public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required|exists:categories,id',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Cek apakah ada destinasi_id, jika tidak, ambil destinasi pertama dari kategori tersebut
    $destinasi_id = $request->destinasi_id;
    if (!$destinasi_id) {
        $destinasi = Destination::where('kategori_id', $request->kategori_id)->first();
        if ($destinasi) {
            $destinasi_id = $destinasi->id;
        } else {
            return redirect()->back()->with('error', 'Tidak ada destinasi untuk kategori ini');
        }
    }

    // Gunakan updateOrCreate untuk menghindari duplikasi
    $preference = UserPreference::updateOrCreate(
        [
            'user_id' => auth()->id(),
        ],
        [
            'kategori_id' => $request->kategori_id,
            'destinasi_id' => $destinasi_id,
            'rating' => $request->rating,
            'updated_at' => now(), // Pastikan timestamp diperbarui
        ]
    );

    // Log untuk debugging
    \Log::info('Preferensi disimpan: ', $preference->toArray());

    // Hapus cache rekomendasi jika ada
    \Cache::forget('recommendations_' . auth()->id());

    // Redirect langsung ke controller rekomendasi
    return redirect()->route('recommendations');
}

    public function getRecommendations()
{
    // Ambil preferensi pengguna
    $userPreference = UserPreference::where('user_id', auth()->id())->first();

    if (!$userPreference) {
        return redirect()->back()->with('error', 'Tidak ada preferensi yang disimpan');
    }

    // Cari destinasi berdasarkan kategori favorit pengguna
    $recommendations = Destination::where('kategori_id', $userPreference->kategori_id)
        ->where('id', '!=', $userPreference->destinasi_id) // Jangan menampilkan destinasi yang sudah dipilih
        ->get();

    return view('recommendations', compact('recommendations'));
}

    public function getDestinationsByCategory($id)
{
$destinasi = Destination::where('kategori_id', $id)->get();
return response()->json($destinasi->map(function ($item) {
    return [
        'id' => $item->id,
        'nama' => $item->nama
    ];
}));

}
    public function index()
    {
        $kategori = Category::all();
        return view('user.preferensi', compact('kategori'));
    }

    public function create()
{
    $categories = Category::all();
    $destinations = Destination::all();

    return view('preferensi.create', compact('categories', 'destinations'));
}


}


