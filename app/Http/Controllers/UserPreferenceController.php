<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Destination;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
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

    public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required|exists:categories,id',
        'destinasi_id' => 'required|exists:destinations,id',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    UserPreference::create([
        'user_id' => auth()->id(),
        'kategori_id' => $request->kategori_id,
        'destinasi_id' => $request->destinasi_id,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'Preferensi berhasil disimpan.');
}

}

