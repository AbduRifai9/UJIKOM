<?php

use App\Http\Controllers\Api\ApiProfileController;
use App\Http\Controllers\Api\ApiTiketController;
use App\Http\Controllers\MidtransController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('profile', ApiProfileController::class)->except('create', 'edit');
    Route::resource('tiket', ApiTiketController::class)
        ->except('create', 'edit')
        ->names([
            'index'   => 'api.tiket.index',
            'store'   => 'api.tiket.store',
            'show'    => 'api.tiket.show',
            'update'  => 'api.tiket.update',
            'destroy' => 'api.tiket.destroy',
        ]);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

