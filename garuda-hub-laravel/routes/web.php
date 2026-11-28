<?php
// NIM: 252410102107

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/projects');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/bids/{bid}/rating', [RatingController::class, 'store'])->middleware('auth')->name('ratings.store');

// Urutan penting: rute yang butuh login (create, edit, dst.) didaftarkan SEBELUM show
Route::resource('projects', ProjectController::class)
    ->except(['index', 'show'])
    ->middleware('auth');
Route::resource('projects', ProjectController::class)
    ->only(['index', 'show']);
