<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GachaApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {
    Route::get('/gacha/draw', [GachaApiController::class, 'index']);
    Route::post('/gacha/draw', [GachaApiController::class, 'store']);
});

// 負荷試験専用
Route::post(
    '/gacha/load-test',
    [GachaApiController::class, 'loadTest']
);
