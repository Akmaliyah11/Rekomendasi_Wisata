<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil preferensi user
        $preferensi = UserPreference::where('user_id', $userId)->get();

        // Ambil semua destinasi
        $destinasi = Destination::with('kategori')->get();

        $rekomendasi = [];

        foreach ($destinasi as $d) {
            $skor = 0;

            foreach ($preferensi as $p) {
                if ($p->kategori_id == $d->kategori_id) {
                    // Contoh sederhana: rating user dijadikan skor kemiripan
                    $skor += $p->rating;
                }
            }

            if ($skor > 0) {
                $rekomendasi[] = (object)[
                    'id' => $d->id,
                    'nama' => $d->nama,
                    'lokasi' => $d->lokasi,
                    'deskripsi' => $d->deskripsi,
                    'skor_kemiripan' => $skor
                ];
            }
        }

        // Urutkan berdasarkan skor tertinggi
        usort($rekomendasi, function ($a, $b) {
            return $b->skor_kemiripan <=> $a->skor_kemiripan;
        });

        return view('rekomendasi.index', compact('rekomendasi'));
    }
}
