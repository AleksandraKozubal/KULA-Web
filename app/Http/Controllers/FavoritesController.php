<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\User;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(User $user)
    {
        return json_encode(Favorites::where('user_id', $user->id)->get());
    }

    public function store(Request $request)
    {

        $userId = auth()->id();
        $kebabPlaceId = $request->kebabPlace;

        $existingFavorite = Favorites::where('user_id', $userId)
            ->where('kebab_place_id', $kebabPlaceId)
            ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'Favorite already exists'], 409);
        }

        $favorite = new Favorites();
        $favorite->user_id = $userId;
        $favorite->kebab_place_id = $kebabPlaceId;
        $favorite->save();

        return response()->json($favorite, 201);
    }


    public function destroy()
    {
        $kebabPlaceId = request()->route('kebabPlace');
        $userId = auth()->id();

        $favorite = Favorites::where('user_id', $userId)
            ->where('kebab_place_id', $kebabPlaceId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        return response()->json(['message' => 'Favorite deleted successfully']);
    }



}
