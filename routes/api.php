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

/**
 * @OA\Info(
 *     title="API KULA",
 *     version="1.0.0",
 *     description="API do wyświetlania miejsc z kebabami"
 * )
 */

/**
 * @OA\Get(
 *     path="/kebab-places",
 *     summary="Pobierz listę miejsc z kebabami",
 *     @OA\Response(
 *         response=200,
 *         description="Lista miejsc z kebabami",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/KebabPlace"))
 *     )
 * )
 */
Route::get('/kebab-places', [KebabPlaceController::class, 'index']);

/**
 * @OA\Get(
 *     path="/kebab-places/{kebabPlace}",
 *     summary="Pobierz szczegóły miejsca z kebabem",
 *     @OA\Parameter(
 *         name="kebabPlace",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Szczegóły miejsca z kebabem",
 *         @OA\JsonContent(ref="#/components/schemas/KebabPlace")
 *     )
 * )
 */
Route::get('/kebab-places/{kebabPlace}', [KebabPlaceController::class, 'show']);

/**
 * @OA\Post(
 *     path="/register",
 *     summary="Zarejestruj nowego użytkownika",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Użytkownik zarejestrowany",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     )
 * )
 */
Route::post('/register', [UserController::class, 'store']);
/**
 * @OA\Get(
 *     path="/sauces",
 *     summary="Pobierz listę sosów",
 *     @OA\Response(
 *         response=200,
 *         description="Lista sosów",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Sauce"))
 *     )
 * )
 */
Route::get('/sauces', [SauceController::class, 'index']);

/**
 * @OA\Get(
 *     path="/fillings",
 *     summary="Pobierz listę dodatków",
 *     @OA\Response(
 *         response=200,
 *         description="Lista dodatków",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Filling"))
 *     )
 * )
 */
Route::get('/fillings', [FillingController::class, 'index']);

/**
 * @OA\Post(
 *     path="/login",
 *     summary="Zaloguj użytkownika",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/UserLogin")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Zalogowano pomyślnie",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     )
 * )
 */
Route::post('/login', [UserController::class, 'login']);

/**
 * @OA\Get(
 *     path="/user",
 *     summary="Pobierz dane zalogowanego użytkownika",
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Dane użytkownika",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show']);

/**
 * @OA\Patch(
 *     path="/user",
 *     summary="Zaktualizuj dane zalogowanego użytkownika",
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dane użytkownika zaktualizowane",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->patch('/user', [UserController::class, 'edit']);

/**
 * @OA\Post(
 *     path="/logout",
 *     summary="Wyloguj użytkownika",
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Wylogowano pomyślnie"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

/**
 * @OA\Put(
 *     path="/kebab-places/{kebabPlace}/fav",
 *     summary="Dodaj miejsce do ulubionych",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="kebabPlace",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dodano do ulubionych"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->put('/kebab-places/{kebabPlace}/fav', [FavoritesController::class, 'store']);

/**
 * @OA\Delete(
 *     path="/kebab-places/{kebabPlace}/unfav",
 *     summary="Usuń miejsce z ulubionych",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="kebabPlace",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Usunięto z ulubionych"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->delete('/kebab-places/{kebabPlace}/unfav', [FavoritesController::class, 'destroy']);

/**
 * @OA\Put(
 *     path="/kebab-places/{kebabPlace}/comment",
 *     summary="Dodaj komentarz do miejsca",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="kebabPlace",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Comment")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dodano komentarz",
 *         @OA\JsonContent(ref="#/components/schemas/Comment")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->put('/kebab-places/{kebabPlace}/comment', [CommentController::class, 'store']);

/**
 * @OA\Patch(
 *     path="/comment/{comment}",
 *     summary="Edytuj komentarz",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="comment",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Comment")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Komentarz zaktualizowany",
 *         @OA\JsonContent(ref="#/components/schemas/Comment")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->patch('/comment/{comment}', [CommentController::class, 'edit']);

/**
 * @OA\Delete(
 *     path="/comment/{comment}",
 *     summary="Usuń komentarz",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="comment",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Komentarz usunięty"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->delete('/comment/{comment}', [CommentController::class, 'destroy']);

/**
 * @OA\Get(
 *     path="/mysuggestions",
 *     summary="Pobierz sugestie użytkownika",
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista sugestii",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Suggestion"))
 *     )
 * )
 */
Route::middleware('auth:sanctum')->get('/mysuggestions', [SuggestionController::class, 'index']);

/**
 * @OA\Post(
 *     path="/kebab-places/{kebabPlace}/suggest",
 *     summary="Dodaj sugestię dla miejsca",
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="kebabPlace",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Suggestion")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Dodano sugestię",
 *         @OA\JsonContent(ref="#/components/schemas/Suggestion")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->post('/kebab-places/{kebabPlace}/suggest', [SuggestionController::class, 'store']);
