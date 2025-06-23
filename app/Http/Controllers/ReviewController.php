<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form ulasan dan rating
        $request->validate([
            'destinasi_id' => 'required|exists:destinations,id',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Menyimpan ulasan ke dalam database
        $review = new Review();
        $review->destinasi_id = $request->destinasi_id;
        $review->user_id = auth()->id(); // Pastikan user sudah login
        $review->komentar = $request->isi;
        $review->rating = $request->rating;
        $review->save();

        // Update rating rata-rata ke tabel destinasi
        $avgRating = Review::where('destinasi_id', $request->destinasi_id)->avg('rating');

        $destination = Destination::find($request->destinasi_id);
        $destination->rating_rata2 = $avgRating;
        $destination->save();

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
}


