<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FillingController;
use App\Http\Controllers\KebabPlaceController;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;


Route::get('/kebab-places', [KebabPlaceController::class, 'index']);
Route::get('/kebab-places/{kebabPlace}', [KebabPlaceController::class, 'show']);
Route::get('/sauces', [SauceController::class, 'index']);
Route::get('/fillings', [FillingController::class, 'index']);
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});
Route::middleware('auth:sanctum')->patch('/user', [UserController::class, 'edit']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
// comments
Route::middleware('auth:sanctum')->post('/kebab-places/{kebabPlace}/comment', [CommentController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/comment/{comment}', [CommentController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/comment/{comment}', [CommentController::class, 'update']);
// favorites
Route::middleware('auth:sanctum')->put('/kebab-places/{kebabPlace}/fav', [FavoritesController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/kebab-places/{kebabPlace}/unfav', [FavoritesController::class, 'destroy']);
// suggestions
Route::middleware('auth:sanctum')->get('/kebab-places/{kebabPlace}/suggest', [SuggestionController::class, 'index']);
