<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;


    class ReviewController extends Controller
    {
        public function store(Request $request)
        {
            // Validasi input form ulasan
            $request->validate([
                'destinasi_id' => 'required|exists:destinations,id',
                'isi' => 'required|string',
            ]);
    
            // Menyimpan ulasan ke dalam database
            $review = new Review();
            $review->destinasi_id = $request->destinasi_id;

            $review->user_id = auth()->id(); // Pastikan user sudah login
            $review->komentar = $request->isi;
            $review->rating = 5; // Atau dapat diubah sesuai input rating dari form jika ada
            $review->save();
    
            return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
        }
    }
    

