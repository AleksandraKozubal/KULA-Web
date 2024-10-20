<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InitAppController;

Route::get('/init-app' ,[InitAppController::class, 'index']);
Route::post('/init-app', [InitAppController::class, 'store']);
