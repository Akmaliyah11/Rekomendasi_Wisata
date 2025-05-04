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
    public function recommendDestinations()
{
    // 1. Ambil preferensi pengguna yang sudah diberikan rating
    $preferensi = UserPreference::where('user_id', auth()->id())
            ->whereNotNull('rating')
            ->with('destination')
            ->orderByDesc('rating')
            ->get();

    // 2. Ambil deskripsi destinasi yang disukai oleh pengguna
    $deskripsi_user = $preferensi->map(function ($pref) {
        return $pref->destination->deskripsi;
    })->implode(' ');  // Gabungkan deskripsi destinasi yang disukai oleh pengguna

    // 3. Ambil semua deskripsi destinasi
    $semua_destinasi = Destination::all();
    $corpus = $semua_destinasi->pluck('deskripsi')->filter(function ($deskripsi) {
        return is_string($deskripsi) && str_word_count($deskripsi) > 3;
    })->values()->toArray();
    
    
    // Tambahkan profil pengguna (gabungan deskripsi destinasi yang disukai)
    if (!empty($deskripsi_user)) {
        $corpus[] = $deskripsi_user;
    }
    // 4. Tokenisasi deskripsi untuk menghitung TF-IDF
    $tokenizer = new WhitespaceTokenizer();
    $corpus_tokens = array_map(function ($text) use ($tokenizer) {
        // Tokenisasi
        $tokens = $tokenizer->tokenize($text);
        $tokens = array_map('strtolower', $tokens); // Normalisasi ke huruf kecil
        return $this->cleanTokens($tokens);  // Bersihkan token yang tidak relevan
    }, $corpus);

    
    // Debug: Periksa token yang dihasilkan
    // dd($corpus_tokens);

    // 5. Hitung term frequencies
    $tfSamples = $this->computeTermFrequencies($corpus_tokens);

    // 6. Proses TF-IDF
    $tfidf = new TfIdfTransformer();
    $tfidf->fit($tfSamples);
    $tfidf->transform($tfSamples); // Langsung transformasi di tempat

    // Gunakan hasilnya
    $tfidf_matrix = $tfSamples;

    // 7. Hitung cosine similarity antara profil pengguna dan destinasi lainnya
    $user_vector = $tfidf_matrix[count($tfidf_matrix) - 1];  // Profil pengguna (dokumen terakhir)
    $destinasi_vectors = array_slice($tfidf_matrix, 0, count($tfidf_matrix) - 1);  // Semua destinasi

    // 8. Hitung similarity
    $similarities = [];
    foreach ($destinasi_vectors as $index => $dest_vector) {
        $similarity = $this->cosineSimilarity($user_vector, $dest_vector);
        $destination_id = $semua_destinasi[$index]->id;
        $similarities[$destination_id] = $similarity;
    
        // Simpan ke tabel recommendations
        Recommendation::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'destinasi_id' => $destination_id
            ],
            [
                'skor_kemiripan' => $similarity
            ]
        );
    }

    // 9. Urutkan berdasarkan similarity tertinggi
    arsort($similarities);
    $recommended_ids = array_keys($similarities);  // ID destinasi yang disarankan

    // 10. Ambil destinasi yang direkomendasikan berdasarkan ID
    $recommended_destinations = Destination::whereIn('id', $recommended_ids)->get();

    // 11. Tampilkan hasil rekomendasi di view
    return view('rekomendasi.recommendations', compact('recommended_destinations'));

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
