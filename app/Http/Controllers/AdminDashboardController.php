<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik dasar
        $stats = [
            'destinasiCount' => Destination::count(),
            'usersCount' => User::count(),
            'kategoriCount' => Category::count(),
            'average_rating' => Review::avg('rating') ?? 0,
        ];
        
        // Data untuk ulasan terbaru
        $ulasanBaru = Review::with('user', 'destination')->latest()->take(5)->get();
        
        // Data untuk pengguna baru
        $userBaru = User::latest()->take(5)->get();
        
        // Data untuk grafik destinasi populer (berdasarkan jumlah review)
        $topDestinations = Destination::withCount('reviews as review_count')
            ->orderByDesc('review_count')
            ->take(5)
            ->get(['id', 'nama', 'review_count']);
            
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
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        $monthLabels = [];
        $ratingData = [];
        
        foreach ($monthlyRatings as $rating) {
            $date = Carbon::createFromDate($rating->year, $rating->month, 1);
            $monthLabels[] = $date->format('M Y');
            $ratingData[] = round($rating->average_rating, 1);
        }

        // Data destinasi untuk tabel
        $destinations = Destination::with('kategori')->latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'stats',
            'ulasanBaru',
            'userBaru',
            'topDestinations',
            'popularCategories',
            'monthLabels',
            'ratingData',
            'destinations'
        ));
    }
    
    public function exportExcel()
    {
        // Membuat objek spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Judul laporan
        $sheet->setCellValue('A1', 'LAPORAN DESTINASI WISATA POPULER');
        $sheet->mergeCells('A1:D1');
        
        // Header tabel
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama Destinasi');
        $sheet->setCellValue('C3', 'Kategori');
        $sheet->setCellValue('D3', 'Jumlah Review');
        
        // Data destinasi
        $destinations = Destination::withCount('reviews')
            ->with('kategori')
            ->orderByDesc('reviews_count')
            ->get();
            
        $row = 4;
        foreach ($destinations as $index => $destination) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $destination->nama);
            $sheet->setCellValue('C' . $row, $destination->kategori ? $destination->kategori->nama : 'Tidak ada kategori');
            $sheet->setCellValue('D' . $row, $destination->reviews_count);
            $row++;
        }
        
        // Styling
        $sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);
        
        // Menyimpan file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'destinasi_populer_' . date('Y-m-d') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
    
    public function exportPDF()
    {
        // Ambil data destinasi populer
        $destinations = Destination::withCount('reviews')
            ->with('kategori')
            ->orderByDesc('reviews_count')
            ->get();
        
        // Render PDF
        $pdf = \PDF::loadView('exports.destinations-pdf', [
            'destinations' => $destinations,
            'date' => date('Y-m-d')
        ]);
        
        return $pdf->download('destinasi_populer_' . date('Y-m-d') . '.pdf');
    }

    public function printDestinations()
    {
        // Ambil data destinasi populer
        $destinations = Destination::withCount('reviews')
            ->with('kategori')
            ->orderByDesc('reviews_count')
            ->get();
        
        // Ambil top 5 destinasi untuk grafik
        $topDestinations = $destinations->take(5);
        
        return view('exports.destinations-print', [
            'destinations' => $destinations,
            'topDestinations' => $topDestinations,
            'date' => date('Y-m-d')
        ]);
    }

    public function downloadPDF()
    {
        // Ambil data destinasi populer
        $destinations = Destination::withCount('reviews')
            ->with('kategori')
            ->orderByDesc('reviews_count')
            ->get();
        
        // Render PDF tanpa grafik (karena PDF tidak mendukung Chart.js)
        $pdf = \PDF::loadView('exports.destinations-pdf', [
            'destinations' => $destinations,
            'date' => date('Y-m-d')
        ]);
        
        return $pdf->download('destinasi_populer_' . date('Y-m-d') . '.pdf');
    }
}































