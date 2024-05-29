<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LedController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/dht11', [SensorController::class, 'api_dht11']);
Route::post('/mq5', [SensorController::class, 'api_mq5']);
Route::post('/rain', [SensorController::class, 'api_rain']);

//CRUD
// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::get('/users', [UserController::class, 'store']);
// Route::get('/users/{id}', [UserController::class, 'update']);
// Route::get('/users/{id}', [UserController::class, 'destroy']);


//resource route
Route::resource('users', UserController::class)
    ->except(['create', 'edit']);

Route::prefix('/leds')->name('leds.')->group(function () {
    Route::get('/', [LedController::class, 'index'])
        -> name ('index');
    Route::get('/{id}', [LedController::class, 'show'])
        -> name ('show');
    Route::post('/', [LedController::class, 'store'])
        -> name ('store');
    Route::put('/{id}', [LedController::class, 'update'])
        -> name ('update');
    Route::delete('/{id}', [LedController::class, 'destroy'])
        -> name ('destroy');
    });
