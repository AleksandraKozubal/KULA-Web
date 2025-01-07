<?php

namespace App\Http\Controllers;

use App\Http\Requests\KebabPlaceRequest;
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
                $kebabPlace->is_favorite = Favorites::query()->where('user_id', auth()->id())->where('kebab_place_id', $kebabPlace->id)->exists();
            }
        }
        return response()->json($kebabPlaces);
    }

    public function store(KebabPlaceRequest $request): JsonResponse
    {
        $request = $request->validated();

        $kebabPlace = KebabPlace::query()->create([
            'name' => $request->name,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'google_maps_url' => $request->google_maps_url,
            'google_maps_rating' => $request->google_maps_rating,
            'phone' => $request->phone,
            'website' => $request->website,
            'email' => $request->email,
            'fillings' => $request->fillings,
            'sauces' => $request->sauces,
            'opening_hours' => $request->opening_hours,
            'status' => $request->status,
            'is_craft' => $request->is_craft,
            'is_chain_restaurant' => $request->is_chain_restaurant,
            'location_type' => $request->location_type,
            'order_options' => $request->order_options,
            'social_media' => $request->social_media,
            'image' => $request->image,
        ]);

        if ($request->hasFile('image')) {
             $request->file('image')->store('kebab_places', 'public');
        }

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

    public function update(KebabPlaceRequest $request, KebabPlace $kebabPlace): JsonResponse
    {
        $kebabPlace->update($request->validated());

        return response()->json("Zaktualizowano kebab", 200);
    }

    public function destroy(KebabPlace $kebabPlace): JsonResponse
    {
        $kebabPlace->delete();

        return response()->json("Usunięto kebab", 200);
    }
}
