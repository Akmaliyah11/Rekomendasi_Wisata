<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Tambah review baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'destinasi_id' => 'required|exists:destinations,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);

        Review::create($request->all());

        // Update rata-rata rating di tabel destinasi
        $avgRating = Review::where('destinasi_id', $request->destinasi_id)->avg('rating');
        Destination::where('id', $request->destinasi_id)->update(['rating_rata2' => $avgRating]);

        return response()->json(['message' => 'Review berhasil ditambahkan']);
    }

    // (Opsional) Tampilkan review untuk satu destinasi
    public function showByDestination($destinasi_id)
    {
        $reviews = Review::where('destinasi_id', $destinasi_id)->with('user')->get();
        return response()->json($reviews);
    }
}
