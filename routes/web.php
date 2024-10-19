<?php
use Illuminate\Support\Facades\Route;

Route::get('/init-app', [App\Http\Controllers\InitAppController::class, 'index']);
Route::post('/init-app', [App\Http\Controllers\InitAppController::class, 'store']);
