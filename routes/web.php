<?php

use App\Http\Controllers\DetailTiketController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    Route::get('pdf', [LaporanController::class, 'pdf'])->name('user.pdf');
    Route::get('excel', [ExcelController::class, 'export'])->name('user.excel');
    Route::resource('home', HomeController::class);
    Route::resource('lokasi', LokasiController::class);
    Route::resource('event', EventController::class);
    Route::resource('tiket', TiketController::class)->names([
        'index'   => 'admin.tiket.index',
        'create'  => 'admin.tiket.create',
        'store'   => 'admin.tiket.store',
        'show'    => 'admin.tiket.show',
        'edit'    => 'admin.tiket.edit',
        'update'  => 'admin.tiket.update',
        'destroy' => 'admin.tiket.destroy',
    ]);
    Route::resource('sponsor', SponsorController::class);
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('detail', DetailTiketController::class);
    Route::post('pemesanan/{id}/bayar', [PemesananController::class, 'bayar'])->name('pemesanan.bayar');
});

// endpoint untuk notifikasi Midtrans
Route::post('/midtrans/create-transaction', [PemesananController::class, 'createTransaction']);
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
Route::get('/detail-tiket/qr/{id}', [DetailTiketController::class, 'generateQr'])->name('detail-tiket.qr');
Route::get('/detail-tiket/scan/{id}', [DetailTiketController::class, 'scanQr'])->name('detail-tiket.scan');
