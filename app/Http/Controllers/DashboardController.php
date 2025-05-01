<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination; // Pastikan model Destination sudah ada

class DashboardController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Destination::query();

    if ($request->has('kategori') && $request->kategori != '') {
        $query->where('kategori', $request->kategori);
    }

    $destinasi = $query->get();

    return view('dashboard', compact('destinasi'));
}

}
