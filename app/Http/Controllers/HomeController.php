<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserPreference;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        // Cek apakah user sudah pernah mengisi preferensi
        $hasPreference = false;
        if (auth()->check()) {
            $hasPreference = UserPreference::where('user_id', auth()->id())->exists();
        }
        
        return view('home', compact('categories', 'hasPreference'));
    }
}
