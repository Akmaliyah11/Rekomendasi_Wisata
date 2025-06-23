<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use App\Models\User;
use App\Models\Review;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataWisataController extends Controller
{
    // Tampilkan semua destinasi
   
public function adminDashboard()
{
    $stats = [
        'destinasiCount' => Destination::count(),
        'usersCount'     => User::count(),
        'kategoriCount'  => Category::count(),
        'average_rating' => Review::avg('rating') ?? 0,
        'total_revenue'  => 100_000_000, // contoh
    ];

    $categories   = Category::all();
    $activities   = ActivityLog::latest()->take(10)->get() ?? collect();

    // data tabel Destinasi
    $destinations = Destination::with(['kategori'])   // relasi kategori
                             ->withCount('reviews') // hitung reviews
                             ->get();

    // data untuk chart "Top 5 Destinasi Populer"
    $topDestinations = Destination::withCount('reviews as visitors')   // alias visitors
                      ->orderByDesc('visitors')
                      ->take(5)
                      ->get(['id', 'nama', 'visitors']);
                      
    // Data untuk grafik kategori populer
    $popularCategories = Category::withCount('destinations')
        ->orderByDesc('destinations_count')
        ->take(5)
        ->get(['id', 'nama', 'destinations_count']);
        
    // Data untuk grafik rating per bulan (6 bulan terakhir)
    $monthlyRatings = Review::select(
            DB::raw('MONTH(created_at) as month'), 
            DB::raw('YEAR(created_at) as year'),
            DB::raw('AVG(rating) as average_rating')
        )
        ->where('created_at', '>=', now()->subMonths(6))
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
        
    $monthLabels = [];
    $ratingData = [];
    
    foreach ($monthlyRatings as $rating) {
        $date = \Carbon\Carbon::createFromDate($rating->year, $rating->month, 1);
        $monthLabels[] = $date->format('M Y');
        $ratingData[] = round($rating->average_rating, 1);
    }
    
    // Jika tidak ada data, tambahkan data default
    if (empty($monthLabels)) {
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            $ratingData[] = 0;
        }
    }

    return view('dashboard.admin', compact(
        'stats',
        'categories',
        'activities',
        'destinations',
        'topDestinations',
        'popularCategories',
        'monthLabels',
        'ratingData'
    ));
}




    public function index()
    
    {
        
        $destinations = Destination::with('kategori')->get();
        return view('datawisata.index', compact('destinations'));
    }

    // Tampilkan form tambah destinasi
    public function create()
    {
        $categories = Category::all();
        return view('datawisata.create', compact('categories'));
    }

    // Simpan data destinasi baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'fasilitas' => 'required|string', // memastikan fasilitas disertakan
            'rating_rata2' => 'required|numeric', // memastikan rating_rata2 disertakan
            'image' => 'required|url', // Validasi sebagai URL
        ]);
    
        Destination::create($request->all());
    
        return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }
    

    // Tampilkan form edit
    public function edit($id)
    {
        // Find the destination by its ID or fail if it doesn't exist
        $destination = Destination::findOrFail($id);
    
        // Get all categories for the dropdown or selection field
        $categories = Category::all();
    
        // Return the edit view and pass the destination and categories
        return view('datawisata.edit', compact('destination', 'categories'));
    }
    

    // Update data destinasi
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'deskripsi' => 'required|string',
        'lokasi' => 'required|string',
        'kategori_id' => 'required|exists:categories,id',
        'fasilitas' => 'required|string',
        'rating_rata2' => 'required|numeric',
        'image' => 'required|url', // Validasi sebagai URL
    ]);

    $destination = Destination::findOrFail($id);
    $destination->update($request->all());

    return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil diperbarui.');
}


    // Hapus destinasi
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('datawisata.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}





