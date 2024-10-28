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
        $favorite = new Favorites();
        $favorite->user_id = $request->user_id;
        $favorite->kebab_place_id = $request->kebabPlace_id;
        $favorite->save();
    }

    public function destroy(Favorites $favorites)
    {
        $favorites->delete();
    }
}
