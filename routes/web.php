<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataWisataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\KategoriWisataController;
use App\Http\Controllers\AdminDashboardController;


Route::get('/datawisata/dashboard', [DataWisataController::class, 'adminDashboard'])->name('datawisata.dashboard');


Route::get('/', function () {
    return view('auth.login');
});

// Login standar (akan mengarahkan berdasarkan role)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Hapus route login.custom karena tidak diperlukan lagi
// Route::post('/login/custom', [AuthController::class, 'customLogin'])->name('login.custom');

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin dashboard routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/export/pdf', [AdminDashboardController::class, 'exportPDF'])->name('admin.export.pdf');
Route::get('/admin/destinations/print', [AdminDashboardController::class, 'printDestinations'])->name('admin.destinations.print');
Route::get('/admin/destinations/download-pdf', [AdminDashboardController::class, 'downloadPDF'])->name('admin.destinations.download-pdf');

// User dashboard
Route::middleware(['auth', 'user'])->get('/user.home', function () {
    return view('dashboard.user');
})->name('user.home');

Route::get('/user/home', function () {
    return view('user.home');
})->name('user.dashboard');

Route::resource('kategoriwisata', KategoriWisataController::class);


// About, Wisata, etc.
Route::get('/about', fn() => view('about'))->middleware(['auth', 'verified'])->name('about');
Route::get('/wisata', fn() => view('wisata'))->middleware(['auth', 'verified'])->name('wisata');
Route::get('/layouts.front', fn() => view('layouts.front'))->middleware(['auth', 'verified'])->name('layouts.front');
Route::get('/user.preferensi', fn() => view('user.preferensi'))->middleware(['auth', 'verified'])->name('user.preferensi');

// Destinasi (frontend)
Route::get('/destinasi.index', fn() => view('destinasi.index'))->middleware(['auth', 'verified'])->name('destinasi.index');

// Rekomendasi
Route::get('/recommendations', [RecommendationController::class, 'recommendDestinations'])->name('recommendations');

// Tampilkan detail wisata
Route::get('/wisata/{id}', [DestinationController::class, 'show'])->name('wisata.show');

// Route favorit
Route::middleware('auth')->group(function () {
    Route::post('/favorit', [FavoriteController::class, 'store'])->name('favorit.store');
    Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit.index');
    Route::delete('/favorit/{id}', [FavoriteController::class, 'destroy'])->name('favorit.destroy');
});

// Route profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Data Wisata Admin (CRUD)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/datawisata', [DataWisataController::class, 'index'])->name('datawisata.index');
    Route::get('/datawisata/create', [DataWisataController::class, 'create'])->name('datawisata.create');
    Route::post('/datawisata', [DataWisataController::class, 'store'])->name('datawisata.store');
    Route::get('/datawisata/edit/{id}', [DataWisataController::class, 'edit'])->name('datawisata.edit');
    Route::put('/datawisata/{id}', [DataWisataController::class, 'update'])->name('datawisata.update');
    Route::delete('/datawisata/{id}', [DataWisataController::class, 'destroy'])->name('datawisata.destroy');
});

// Preferensi user
Route::middleware(['auth'])->group(function () {
    Route::get('/preferensi', [UserPreferenceController::class, 'create'])->name('user-preferences.create');
    Route::post('/preferensi', [UserPreferenceController::class, 'store'])->name('user-preferences.store');
    Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinasi.index');
});

// Get destinasi by kategori (AJAX)
Route::get('/get-destinations-by-category/{category_id}', [UserPreferenceController::class, 'getDestinationsByCategory']);

// Review
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Default home (jika login berhasil)
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rekomendasi
Route::middleware(['auth'])->group(function () {
    Route::get('/recommendations', [App\Http\Controllers\RecommendationController::class, 'recommendDestinations'])->name('recommendations');
});

// Auth scaffolding (jika pakai Laravel Breeze/Fortify)
require __DIR__.'/auth.php';





