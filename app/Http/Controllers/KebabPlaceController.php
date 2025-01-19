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
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KebabPlaceController extends Controller
{
    protected $kebabPlaces;
    protected $kebabPlace;
    protected ?int $paginate;
    protected string $sby;
    protected string $sdirection;
    protected ?string $fopen;
    protected ?string $fdatetime;
    protected ?array $ffillings;
    protected ?array $fsauces;
    protected ?string $fstatus;
    protected ?bool $fcraft;
    protected ?string $flocation;
    protected ?bool $fchain;
    protected ?string $fordering;
    protected int $day;
    protected Carbon $time;
    protected string $weekday;

    public function index(KebabPlaceFilterRequest $request): JsonResponse
    {
        $this->paginate = $request->paginate ? json_decode($request->paginate) : 20;
        $this->sby = $request->sby ?? "id";
        $this->sdirection = $request->sdirection ?? "asc";
        $this->fopen = $request->fopen ?? null;
        $this->fdatetime = $request->fdatetime ?? date("N-H:i");
        $this->ffillings = $request->ffillings ? json_decode($request->ffillings, true) : null;
        $this->fsauces = $request->fsauces ? json_decode($request->fsauces, true) : null;
        $this->fstatus = $request->fstatus ?? null;
        $this->fcraft = isset($request->fcraft) ? json_decode($request->fcraft) : null;
        $this->flocation = $request->flocation ?? null;
        $this->fchain = isset($request->fchain) ? json_decode($request->fchain) : null;
        $this->fordering = $request->fordering ?? null;
        $this->day = explode("-", $this->fdatetime)[0] - 1;
        $this->weekday = Weekdays::cases()[$this->day]->value;
        $this->time = Carbon::parse(explode("-", $this->fdatetime)[1]);
        $query = KebabPlace::query();
        $query = $this->filter($query);
        $query = $this->sort($query);
        $this->kebabPlaces = $query->paginate($this->paginate);
        $this->attachFormattedOpeningHours();
        $this->attachUserDataAll();

        return response()->json($this->kebabPlaces);
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
            "opening_hours_monday" => $request->opening_hours_monday,
            "opening_hours_tuesday" => $request->opening_hours_tuesday,
            "opening_hours_wednesday" => $request->opening_hours_wednesday,
            "opening_hours_thursday" => $request->opening_hours_thursday,
            "opening_hours_friday" => $request->opening_hours_friday,
            "opening_hours_saturday" => $request->opening_hours_saturday,
            "opening_hours_sunday" => $request->opening_hours_sunday,
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

    public function show(Request $request): JsonResponse
    {
        $this->kebabPlace = KebabPlace::find($request->kebabPlace);
        $this->kebabPlace = $this->formatOpeningHours($this->kebabPlace);
        $this->attachUserData();
        $this->attachDetails();
        $this->attachComments();

        return response()->json($this->kebabPlace, 200);
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

    protected function filter(Builder $kebabPlaces): Builder
    {
        return $kebabPlaces
            ->when($this->fstatus, fn(Builder $query) => $query->where("status", $this->fstatus))
            ->when(isset($this->fcraft), fn(Builder $query) => $query->where("is_craft", $this->fcraft))
            ->when($this->flocation, fn(Builder $query) => $query->where("location_type", $this->flocation))
            ->when(isset($this->fchain), fn(Builder $query) => $query->where("is_chain_restaurant", $this->fchain))
            ->when($this->ffillings, fn(Builder $query) => $query->whereJsonContains("fillings", $this->ffillings))
            ->when($this->fsauces, fn(Builder $query) => $query->whereJsonContains("sauces", $this->fsauces))
            ->when($this->fordering, fn(Builder $query) => $query->whereJsonContains("order_options", $this->fordering))
            ->when($this->fopen === "open", function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->whereRaw(DB::raw("CAST(REPLACE(opening_hours_{$this->weekday}::jsonb ->> 0, ':', '.') AS FLOAT) <= ?"), [floatval($this->time->format("H.i"))])
                        ->whereRaw(DB::raw("CAST(REPLACE(opening_hours_{$this->weekday}::jsonb ->> 1, ':', '.') AS FLOAT) > ?"), [floatval($this->time->format("H.i"))]);
                });
            })
            ->when($this->fopen === "closed", function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->whereRaw(DB::raw("CAST(REPLACE(opening_hours_{$this->weekday}::jsonb ->> 0, ':', '.') AS FLOAT) > ?"), [floatval($this->time->format("H.i"))])
                        ->orWhereRaw(DB::raw("CAST(REPLACE(opening_hours_{$this->weekday}::jsonb ->> 1, ':', '.') AS FLOAT) <= ?"), [floatval($this->time->format("H.i"))]);
                });
            });
    }

    protected function sort(Builder $kebabPlaces): Builder
    {
        return $kebabPlaces
            ->orderBy($this->sby, $this->sdirection);
    }

    protected function attachFormattedOpeningHours(): void
    {
        if ($this->kebabPlaces === null) {
            throw new \RuntimeException("Kebab places are null");
        }

        $this->kebabPlaces->each(function ($kebabPlace): void {
            $kebabPlace = $this->formatOpeningHours($kebabPlace);
        });
    }

    protected function formatOpeningHours($kebabPlace): mixed
    {
        $openFrom = array_map(fn($hours) => $hours[0] ?? "", $kebabPlace->only([
            "opening_hours_monday",
            "opening_hours_tuesday",
            "opening_hours_wednesday",
            "opening_hours_thursday",
            "opening_hours_friday",
            "opening_hours_saturday",
            "opening_hours_sunday",
        ]));
        $openTo = array_map(fn($hours) => $hours[1] ?? "nieczynne", $kebabPlace->only([
            "opening_hours_monday",
            "opening_hours_tuesday",
            "opening_hours_wednesday",
            "opening_hours_thursday",
            "opening_hours_friday",
            "opening_hours_saturday",
            "opening_hours_sunday",
        ]));

        $kebabPlace->opening_hours = array_map(fn($from, $to, $index) => [
            "day" => Weekdays::cases()[$index]->getLabel(),
            "from" => $from,
            "to" => $to,
        ], $openFrom, $openTo, array_keys(Weekdays::cases()));

        unset($kebabPlace->opening_hours_monday, $kebabPlace->opening_hours_tuesday, $kebabPlace->opening_hours_wednesday, $kebabPlace->opening_hours_thursday, $kebabPlace->opening_hours_friday, $kebabPlace->opening_hours_saturday, $kebabPlace->opening_hours_sunday);

        return $kebabPlace;
    }

    protected function attachUserDataAll(): void
    {
        if (auth()->check()) {
            foreach ($this->kebabPlaces as $kebabPlace) {
                $kebabPlace->is_favorite = Favorites::query()->where("user_id", auth()->id())->where("kebab_place_id", $kebabPlace->id)->exists();
            }
        }
    }

    protected function attachUserData(): void
    {
        if (auth()->check()) {
            $this->kebabPlace->is_favorite = Favorites::query()->where("user_id", auth()->id())->where("kebab_place_id", $this->kebabPlace->id)->exists();
        }
    }

    protected function attachDetails(): void
    {
        $this->kebabPlace->fillings = Filling::whereIn("id", $this->kebabPlace->fillings)->get();
        $this->kebabPlace->sauces = Sauce::whereIn("id", $this->kebabPlace->sauces)->get();
    }

    protected function attachComments(): void
    {
        $this->kebabPlace->comments = Comment::where("kebab_place_id", $this->kebabPlace->id)->get();
        $this->kebabPlace->comments->each(function ($comment): void {
            $comment->is_owner = $comment->user_id === auth()->id();
            $comment->user_name = $comment->user->name;
            $comment->makeHidden("user");
        });
    }
}
