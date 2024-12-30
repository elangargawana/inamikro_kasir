<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\MetodeBayarController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\TransaksiCepatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/master')->group(function () {
        Route::resource('/satuan', SatuanController::class);
        Route::resource('/metode-bayar', MetodeBayarController::class);
    });

    Route::prefix('/transaksi')->group(function () {
        Route::post('/cepat', [TransaksiCepatController::class, 'store']);
    });
});

Route::post('/transaksi/callback', [MidtransController::class, 'callback']);
