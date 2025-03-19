<?php
use App\Http\Controllers\STAGING\AuthController;
use App\Http\Controllers\STAGING\LookupsController;
use App\Http\Controllers\STAGING\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// staging and live
// Open Routes
Route::prefix('v1/staging')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/order_statuses', [OrderController::class, 'order_statuses']);
    Route::get('/cities', [LookupsController::class, 'cities']);
    Route::get('/countries', [LookupsController::class, 'countries']);
    Route::get('/neighbourhoods', [LookupsController::class, 'neighbourhoods']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::resource('orders', OrderController::class);
    });
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
