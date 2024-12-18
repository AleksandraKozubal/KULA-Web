<?php

namespace App\Http\Controllers;

use App\Models\KebabPlace;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\Comment;
use App\Models\Filling;
use App\Models\Sauce;
use Illuminate\Http\JsonResponse;

class KebabPlaceController extends Controller
{
    public function index(): JsonResponse
    {
        $kebabPlaces = KebabPlace::paginate(20);
        if (auth()->check()) {
            foreach ($kebabPlaces as $kebabPlace) {
                $kebabPlace->is_favorite = Favorites::where('user_id', auth()->id())->where('kebab_place_id', $kebabPlace->id)->exists();
            }
        }
        return response()->json($kebabPlaces);
    }

    public function store(Request $request): JsonResponse
    {
        $kebabPlace = new KebabPlace();
        $kebabPlace->name = $request->name;
        $kebabPlace->street = $request->street;
        $kebabPlace->building_number = $request->building_number;
        $kebabPlace->latitude = $request->latitude;
        $kebabPlace->longitude = $request->longitude;
        $kebabPlace->google_maps_url = $request->google_maps_url;
        $kebabPlace->google_maps_rating = $request->google_maps_rating;
        $kebabPlace->phone = $request->phone;
        $kebabPlace->website = $request->website;
        $kebabPlace->email = $request->email;
        $kebabPlace->fillings = $request->fillings;
        $kebabPlace->sauces = $request->sauces;
        $kebabPlace->image = $request->image;
        $kebabPlace->save();

        return response()->json($kebabPlace, 201);
    }

    public function show(Request $request, ?User $user): JsonResponse
    {
        $kebabPlace = KebabPlace::find($request->kebabPlace);
        if (auth()->check()) {
            $kebabPlace->is_favorite = Favorites::where('user_id', auth()->id())->where('kebab_place_id', $request->kebabPlace)->exists();
        }
        $kebabPlace->comments = Comment::where('kebab_place_id', $request->kebabPlace)->get();
        $kebabPlace->comments->each(function ($comment) {
            $comment->is_owner = $comment->user_id === auth()->id();
        });
        $kebabPlace->fillings = Filling::where('id', $kebabPlace->fillings)->get();
        $kebabPlace->sauces = Sauce::where('id', $kebabPlace->sauces)->get();

        return response()->json($kebabPlace, 200);
    }

    public function update(Request $request, KebabPlace $kebabPlace): JsonResponse
    {
        $kebabPlace->name ? $kebabPlace->name = $request->name : null;
        $kebabPlace->street ? $kebabPlace->street = $request->street : null;
        $kebabPlace->building_number ? $kebabPlace->building_number = $request->building_number : null;
        $kebabPlace->latitude ? $kebabPlace->latitude = $request->latitude : null;
        $kebabPlace->longitude ? $kebabPlace->longitude = $request->longitude : null;
        $kebabPlace->google_maps_url ? $kebabPlace->google_maps_url = $request->google_maps_url : null;
        $kebabPlace->google_maps_rating ? $kebabPlace->google_maps_rating = $request->google_maps_rating : null;
        $kebabPlace->phone ? $kebabPlace->phone = $request->phone : null;
        $kebabPlace->website ? $kebabPlace->website = $request->website : null;
        $kebabPlace->email ? $kebabPlace->email = $request->email : null;
        $kebabPlace->fillings ? $kebabPlace->fillings = $request->fillings : null;
        $kebabPlace->sauces ? $kebabPlace->sauces = $request->sauces : null;
        $kebabPlace->image ? $kebabPlace->image = $request->image : null;
        $kebabPlace->save();

        return response()->json("Zaktualizowano kebab", 200);
    }

    public function destroy(KebabPlace $kebabPlace): JsonResponse
    {
        $kebabPlace->delete();

        return response()->json("Usunięto kebab", 200);
    }
}
