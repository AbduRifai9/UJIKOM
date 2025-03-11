<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    Route::resource('home', HomeController::class);
    Route::resource('lokasi', LokasiController::class);
    Route::resource('event', EventController::class);
    Route::resource('tiket', TiketController::class);
    Route::resource('sponsor', SponsorController::class);
    Route::resource('pemesanan', PemesananController::class);
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
