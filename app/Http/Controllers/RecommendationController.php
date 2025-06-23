<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\UserPreference;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Illuminate\Http\Request;
use App\Models\Recommendation;


class RecommendationController extends Controller
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

    public function recommendDestinations()
    {
        // 1. Ambil preferensi pengguna yang sudah diberikan rating
        $preferensi = UserPreference::where('user_id', auth()->id())
            ->whereNotNull('rating')
            ->with('destination')
            ->orderByDesc('updated_at')
            ->get();
        
        // Jika tidak ada preferensi, kembalikan view kosong
        if ($preferensi->isEmpty()) {
            $recommended_destinations = collect();
            return view('rekomendasi.recommendations', compact('recommended_destinations'))
                ->with('message', 'Kamu belum mengatur preferensi wisata. Atur preferensi untuk mendapatkan rekomendasi yang sesuai.');
        }

        // 2. Ambil deskripsi destinasi yang disukai oleh pengguna
        $deskripsi_user = $preferensi->map(function ($pref) {
            return $pref->destination->deskripsi ?? '';
        })->filter()->implode(' ');
        
        // 3. Ambil semua destinasi dengan data tambahan
        $semua_destinasi = Destination::withAvg('reviews', 'rating')
                                      ->withCount('reviews as review_count')
                                      ->get();
        
        // Inisialisasi array untuk menyimpan skor akhir
        $final_scores = [];
        
        // 4. Jika ada deskripsi yang cukup, lakukan analisis TF-IDF
        if (!empty($deskripsi_user) && str_word_count($deskripsi_user) > 10) {
            // Proses TF-IDF seperti kode asli
            $corpus = $semua_destinasi->pluck('deskripsi')->filter(function ($deskripsi) {
                return is_string($deskripsi) && str_word_count($deskripsi) > 3;
            })->values()->toArray();
            
            // Tambahkan deskripsi pengguna ke dalam corpus
            $corpus[] = $deskripsi_user;
            
            // Tokenisasi deskripsi untuk TF-IDF
            $tokenizer = new \Phpml\Tokenization\WhitespaceTokenizer();
            $corpus_tokens = array_map(function ($text) use ($tokenizer) {
                $tokens = $tokenizer->tokenize($text);
                $tokens = array_map('strtolower', $tokens);
                return $this->cleanTokens($tokens);
            }, $corpus);
        
            // Hitung term frequencies
            $tfSamples = $this->computeTermFrequencies($corpus_tokens);
        
            // Proses TF-IDF
            $tfidf = new \Phpml\FeatureExtraction\TfIdfTransformer();
            $tfidf->fit($tfSamples);
            $tfidf->transform($tfSamples);
            $tfidf_matrix = $tfSamples;
        
            // Hitung cosine similarity
            $user_vector = $tfidf_matrix[count($tfidf_matrix) - 1];
            $destinasi_vectors = array_slice($tfidf_matrix, 0, count($tfidf_matrix) - 1);
        
            // Simpan skor TF-IDF ke array skor akhir (bobot 60%)
            foreach ($destinasi_vectors as $index => $dest_vector) {
                if (isset($semua_destinasi[$index])) {
                    $similarity = $this->cosineSimilarity($user_vector, $dest_vector);
                    $destination_id = $semua_destinasi[$index]->id;
                    $final_scores[$destination_id]['tfidf'] = $similarity * 0.6; // Bobot 60% untuk TF-IDF
                }
            }
        }
        
        // 5. Tambahkan faktor-faktor lain untuk semua destinasi
        foreach ($semua_destinasi as $destinasi) {
            // Lewati destinasi yang sudah dipilih user
            if ($preferensi->contains('destinasi_id', $destinasi->id)) {
                continue;
            }
            
            // Inisialisasi skor jika belum ada
            if (!isset($final_scores[$destinasi->id])) {
                $final_scores[$destinasi->id] = [
                    'tfidf' => 0 // Default jika tidak ada analisis TF-IDF
                ];
            }
            
            // 5.1 Faktor kategori (bobot 20%)
            $kategori_match = $preferensi->contains('kategori_id', $destinasi->kategori_id) ? 1.0 : 0.3;
            $final_scores[$destinasi->id]['kategori'] = $kategori_match * 0.2;
            
            // 5.2 Faktor rating (bobot 10%)
            $rating_factor = min(($destinasi->reviews_avg_rating ?? 0) / 5, 1.0);
            $final_scores[$destinasi->id]['rating'] = $rating_factor * 0.1;
            
            // 5.3 Faktor popularitas (bobot 5%)
            $popularity_factor = min(($destinasi->review_count ?? 0) / 20, 1.0);
            $final_scores[$destinasi->id]['popularitas'] = $popularity_factor * 0.05;
            
            // 5.4 Faktor fasilitas jika ada destinasi spesifik (bobot 5%)
            $fasilitas_factor = 0;
            foreach ($preferensi as $pref) {
                if ($pref->destination && !empty($pref->destination->fasilitas)) {
                    $user_fasilitas = is_array($pref->destination->fasilitas) ? 
                                     $pref->destination->fasilitas : 
                                     explode(',', $pref->destination->fasilitas);
                    
                    $dest_fasilitas = is_array($destinasi->fasilitas) ? 
                                     $destinasi->fasilitas : 
                                     explode(',', $destinasi->fasilitas);
                    
                    $common_fasilitas = array_intersect($user_fasilitas, $dest_fasilitas);
                    $current_factor = count($common_fasilitas) / max(count($user_fasilitas), 1);
                    $fasilitas_factor = max($fasilitas_factor, $current_factor);
                }
            }
            $final_scores[$destinasi->id]['fasilitas'] = $fasilitas_factor * 0.05;
        }
        
        // 6. Hitung skor total dan simpan ke database
        $total_scores = [];
        foreach ($final_scores as $destinasi_id => $scores) {
            $total_score = array_sum($scores);
            $total_scores[$destinasi_id] = $total_score;
            
            // Simpan ke database
            Recommendation::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'destinasi_id' => $destinasi_id
                ],
                [
                    'skor_kemiripan' => $total_score
                ]
            );
        }
        
        // 7. Filter & urutkan berdasarkan skor total
        arsort($total_scores);
        
        // Ambil hanya destinasi dengan skor >= 0.2 dan batasi ke 5 teratas
        $filtered_ids = array_keys(array_filter($total_scores, fn($score) => $score >= 0.2));
        $top_ids = array_slice($filtered_ids, 0, 8);
        
        // 8. Ambil destinasi & skor similarity-nya
        $recommended_destinations = Destination::whereIn('id', $top_ids)
            ->withAvg('reviews', 'rating')
            ->get();
        
        // Tambahkan skor ke setiap destinasi
        $recommended_destinations = $recommended_destinations->map(function ($dest) use ($total_scores) {
            $dest->skor_kemiripan = round($total_scores[$dest->id] ?? 0, 3);
            $dest->avg_rating = round($dest->reviews_avg_rating ?? 0, 1);
            return $dest;
        });
        
        // 9. Urutkan berdasarkan skor kemiripan tertinggi
        $recommended_destinations = $recommended_destinations->sortByDesc('skor_kemiripan')->values();
        
        // 10. Tampilkan ke view dengan informasi tambahan
        return view('rekomendasi.recommendations', compact('recommended_destinations'))
            ->with('debug_info', [
                'preferensi_count' => $preferensi->count(),
                'last_preference' => $preferensi->first() ? $preferensi->first()->updated_at : null,
            ]);
    }

    // Metode alternatif jika tidak ada deskripsi
    private function recommendByCategory()
    {
        // Ambil kategori favorit user berdasarkan rating tertinggi
        $topPreference = UserPreference::where('user_id', auth()->id())
            ->whereNotNull('rating')
            ->orderByDesc('rating')
            ->orderByDesc('updated_at')
            ->first();
        
        if (!$topPreference) {
            $recommended_destinations = collect();
            return view('rekomendasi.recommendations', compact('recommended_destinations'));
        }
        
        // Ambil destinasi dengan kategori yang sama
        $recommended_destinations = Destination::where('kategori_id', $topPreference->kategori_id)
            ->where('id', '!=', $topPreference->destinasi_id) // Jangan tampilkan yang sudah dipilih
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get();
        
        // Tambahkan skor kemiripan berdasarkan kategori yang sama
        $recommended_destinations = $recommended_destinations->map(function ($dest) {
            $dest->skor_kemiripan = 0.8; // Skor default untuk kategori yang sama
            $dest->avg_rating = round($dest->reviews_avg_rating ?? 0, 1);
            return $dest;
        });
        
        return view('rekomendasi.recommendations', compact('recommended_destinations'))
            ->with('method', 'category_based');
    }

private function cleanTokens($tokens)
{
    return array_filter(array_map(function ($token) {
        $token = preg_replace('/[^a-zA-Z0-9]/', '', $token); // hapus tanda baca
        return strtolower($token);
    }, $tokens), function ($token) {
        return strlen($token) > 2;  // buang token pendek (seperti 'di', 'ke', dsb)
    });
}


    


private function computeTermFrequencies($corpus_tokens)
{
    // Ambil semua token unik dari seluruh dokumen
    $allTokens = [];
    foreach ($corpus_tokens as $doc) {
        foreach ($doc as $token) {
            $allTokens[$token] = true;
        }
    }
    $allTokens = array_keys($allTokens); // Daftar semua token unik

    $tf = [];
    foreach ($corpus_tokens as $docTokens) {
        $counts = array_count_values($docTokens);
        $total = count($docTokens);
        $docTf = [];

        // Isi nilai TF untuk semua token
        foreach ($allTokens as $token) {
            $docTf[$token] = isset($counts[$token]) ? $counts[$token] / $total : 0.0;
        }

        $tf[] = $docTf;
    }

    return $tf;
}

    

    // Fungsi untuk menghitung cosine similarity
    private function cosineSimilarity(array $vec1, array $vec2): float
    {
        $dotProduct = 0.0;
        $normA = 0.0;
        $normB = 0.0;
    
        foreach ($vec1 as $key => $val) {
            $dotProduct += $val * ($vec2[$key] ?? 0.0);
            $normA += $val ** 2;
        }
    
        foreach ($vec2 as $val) {
            $normB += $val ** 2;
        }
    
        if ($normA == 0.0 || $normB == 0.0) {
            return 0.0;
        }
    
        return $dotProduct / (sqrt($normA) * sqrt($normB));
    }
    
}


