<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/sensors', [SensorController::class, 'index']);
Route::post('/sensors', [SensorController::class, 'store']);
Route::get('/sensors/{id}', [SensorController::class, 'show']);
Route::put('/sensors/{id}', [SensorController::class, 'update']);
Route::delete('/sensors/{id}', [SensorController::class, 'destroy']);
