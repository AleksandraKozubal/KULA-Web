<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Weekdays;
use App\Http\Requests\KebabPlaceFilterRequest;
use App\Http\Requests\KebabPlaceRequest;
use App\Models\Comment;
use App\Models\Favorites;
use App\Models\Filling;
use App\Models\KebabPlace;
use App\Models\Sauce;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KebabPlaceController extends Controller
{
    public function index(KebabPlaceFilterRequest $request): JsonResponse
    {
        $paginate = $request->paginate ?? 20;
        $sby = $request->sby ?? "id";
        $sdirection = $request->sdirection ?? "asc";
        $fopen = $request->fopen ?? null;
        $fdatetime = $request->fdatetime ?? date("N-H:i");
        $ffillings = $request->ffillings ? json_decode($request->ffillings, true) : null;
        $fsauces = $request->fsauces ? json_decode($request->fsauces, true) : null;
        $fstatus = $request->fstatus ?? null;
        $fkraft = $request->fkraft ?? null;
        $flocation = $request->flocation ?? null;
        $fchain = $request->fchain ?? null;
        $fordering = $request->fordering ?? null;


        $kebabPlaces = KebabPlace::query()
            ->when($ffillings, fn($query): Builder => $query->whereJsonContains("fillings", $ffillings))
            ->when($flocation, fn($query): Builder => $query->where("location_type", $flocation))
            ->when($fsauces, fn($query): Builder => $query->whereJsonContains("sauces", $fsauces))
            ->when($fkraft !== null, fn($query): Builder => $query->where("is_craft", $fkraft))
            ->when($fchain !== null, fn($query): Builder => $query->where("is_chain_restaurant", $fchain))
            ->when($fstatus, fn($query): Builder => $query->where("status", $fstatus))
            ->when($fordering, fn($query): Builder => $query->whereJsonContains("order_options", $fordering))
            ->orderBy($sby, $sdirection)
            ->when($fopen !== null, fn($query): Builder => $query->where(function ($query) use ($fdatetime, $fopen) {
                $day = explode("-", $fdatetime)[0] - 1;
                $time = explode("-", $fdatetime)[1];
                $converted_time = fn($time) => explode(":", $time)[0] + (explode(":", $time)[1] != "00" ? explode(":", $time)[1] / 60 : 0);
                $converted_time_value = $converted_time($time);
                if ($fopen === "open") {
                    $query->whereRaw("(open_from::jsonb->>?)::numeric <= ?", [$day, $converted_time_value])
                        ->whereRaw("(open_to::jsonb->>?)::numeric >= ?", [$day, $converted_time_value]);
                } else {
                    $query->whereRaw("(open_from::jsonb->>?)::numeric > ?", [$day, $converted_time_value])
                        ->orWhereRaw("(open_to::jsonb->>?)::numeric < ?", [$day, $converted_time_value]);
                }
            }))
            ->paginate($paginate);

        dd($kebabPlaces);
        foreach ($kebabPlaces as $kebabPlace) {
            $kebabPlace->opening_hours = array_map(function ($from, $to) {
                return [
                    'from' => $from ? (is_int($from) ? $from . ":00" : floor($from) . ":30") : null,
                    'to' => $to ? (is_int($to) ? $to . ":00" : floor($to) . ":30") : null
                ];
            }, json_decode($kebabPlace->open_from ?? "[]"), json_decode($kebabPlace->open_to ?? "[]"));
        }
        if (auth()->check()) {
            foreach ($kebabPlaces as $kebabPlace) {
                $kebabPlace->is_favorite = Favorites::query()->where("user_id", auth()->id())->where("kebab_place_id", $kebabPlace->id)->exists();
            }
        }

        return response()->json($kebabPlaces);
    }

    public function store(KebabPlaceRequest $request): JsonResponse
    {
        $request = $request->validated();

        $kebabPlace = KebabPlace::query()->create([
            "name" => $request->name,
            "address" => $request->address,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "google_maps_url" => $request->google_maps_url,
            "google_maps_rating" => $request->google_maps_rating,
            "phone" => $request->phone,
            "website" => $request->website,
            "email" => $request->email,
            "fillings" => $request->fillings,
            "sauces" => $request->sauces,
            "opening_hours" => $request->opening_hours,
            "status" => $request->status,
            "is_craft" => $request->is_craft,
            "is_chain_restaurant" => $request->is_chain_restaurant,
            "location_type" => $request->location_type,
            "order_options" => $request->order_options,
            "social_media" => $request->social_media,
            "image" => $request->image,
        ]);

        if ($request->hasFile("image")) {
            $request->file("image")->store("kebab_places", "public");
        }

        return response()->json($kebabPlace, 201);
    }

    public function show(Request $request, ?User $user): JsonResponse
    {
        $kebabPlace = KebabPlace::find($request->kebabPlace);

        if (auth()->check()) {
            $kebabPlace->is_favorite = Favorites::where("user_id", auth()->id())->where("kebab_place_id", $request->kebabPlace)->exists();
        }
        $kebabPlace->comments = Comment::where("kebab_place_id", $request->kebabPlace)->get();
        $kebabPlace->comments->each(function ($comment): void {
            $comment->is_owner = $comment->user_id === auth()->id();
        });
        $kebabPlace->fillings = Filling::whereIn("id", $kebabPlace->fillings)->get();
        $kebabPlace->sauces = Sauce::whereIn("id", $kebabPlace->sauces)->get();

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
