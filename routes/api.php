<?php

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
Route::prefix('/v1')->group(function () {
    Route::get('/locations/nearest', [App\Http\Controllers\LocationController::class, 'nearest']);
    Route::apiResource('locations', App\Http\Controllers\LocationController::class);

    Route::post('/cashback', App\Http\Controllers\CashbackController::class);
});
