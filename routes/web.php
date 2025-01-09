<?php

declare(strict_types=1);
use App\Http\Controllers\InitAppController;
use Illuminate\Support\Facades\Route;

Route::get("/init-app", [InitAppController::class, "index"]);
Route::post("/init-app", [InitAppController::class, "store"]);
