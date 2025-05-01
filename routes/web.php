<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recommendations', [RecommendationController::class, 'getRecommendations'])->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/destinasi', [DestinasionController::class, 'index'])->name('destinasi.index');;
});

require __DIR__.'/auth.php';
