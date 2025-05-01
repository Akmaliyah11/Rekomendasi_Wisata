<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return view('user.preferensi', compact('kategori'));
    }

    public function store(Request $request)
    {
        UserPreference::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('user.preferensi')->with('success', 'Preferensi berhasil disimpan!');
    }
}

