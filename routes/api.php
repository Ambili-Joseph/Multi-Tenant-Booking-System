<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\AnalyticsController;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('bookings', BookingController::class);
    Route::get('analytics/bookings', [AnalyticsController::class, 'bookings']);
});

// Route::prefix('v1')->group(function () {
//     Route::apiResource('bookings', BookingController::class);
//     Route::get('analytics/bookings', [AnalyticsController::class, 'bookings']);
// });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
