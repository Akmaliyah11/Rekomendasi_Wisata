<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataWisataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\DestinationController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Auth\CustomLoginController;

Route::middleware(['auth', 'user'])->get('/user.home', function () {
    return view('dashboard.user'); // arahkan ke view yang kamu buat
})->name('user.home');



Route::post('/login/custom', [CustomLoginController::class, 'login'])->name('login.custom');




// Route untuk login Admin
Route::post('login-admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

// Route untuk login User
Route::post('logi   n-user', [AuthController::class, 'loginUser'])->name('login.user');

// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/wisata/{id}', [DestinationController::class, 'show'])->name('wisata.show');
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::post('/favorit', [FavoriteController::class, 'store'])
    ->middleware('auth')
    ->name('favorit.store');

    use App\Http\Controllers\FavoriteController;



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/wisata', function () {
    return view('wisata');
})->middleware(['auth', 'verified'])->name('wisata');

Route::get('/layouts.front', function () {
    return view('layouts.front');
})->middleware(['auth', 'verified'])->name('layouts.front');

Route::get('/user.preferensi', function () {
    return view('user.preferensi');
})->middleware(['auth', 'verified'])->name('user.preferensi');

Route::get('/destinasi.index', function () {
    return view('destinasi.index');
})->middleware(['auth', 'verified'])->name('destinasi.index');

use App\Http\Controllers\ReviewController;

// Route untuk menyimpan ulasan
Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/destinasi', [DestinasionController::class, 'index'])->name('destinasi.index');;
});

Route::get('/datawisata', [DataWisataController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('datawisata.index');


Route::get('/datawisata/edit/{id}', [DataWisataController::class, 'edit'])->name('datawisata.edit');
Route::put('/datawisata/{id}', [DataWisataController::class, 'update'])->name('datawisata.update');
Route::delete('/datawisata/{id}', [DataWisataController::class, 'destroy'])->name('datawisata.destroy');
Route::get('/datawisata/create', [DataWisataController::class, 'create'])->name('datawisata.create');
Route::post('/datawisata', [DataWisataController::class, 'store'])->name('datawisata.store');


Route::middleware(['auth'])->group(function () {
    Route::get('/preferensi', [UserPreferenceController::class, 'create'])->name('user-preferences.create');
    Route::post('/preferensi', [UserPreferenceController::class, 'store'])->name('user-preferences.store');
});

Route::get('/recommendations', [RecommendationController::class, 'recommendDestinations'])->name('recommendations');


require __DIR__.'/auth.php';
