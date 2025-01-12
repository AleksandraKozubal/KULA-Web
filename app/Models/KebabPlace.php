<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\KebabObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $name
 * @property ?string $image
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property ?string $google_maps_url
 * @property ?string $google_maps_rating
 * @property string $phone
 * @property ?string $website
 * @property ?string $android
 * @property ?string $ios
 * @property ?string $email
 * @property ?string $opened_at_year
 * @property ?string $closed_at_year
 * @property array $opening_hours
 * @property ?array $fillings
 * @property ?array $sauces
 * @property string $status
 * @property bool $is_craft
 * @property bool $is_chain_restaurant
 * @property string $location_type
 * @property array $order_options
 * @property Collection $social_media
 */
class KebabPlace extends Model
{
    use HasFactory;

    public const string PHOTOS_DIRECTORY = "kebab-place";

    protected $fillable = [
        "name",
        "image",
        "address",
        "latitude",
        "longitude",
        "google_maps_url",
        "google_maps_rating",
        "phone",
        "website",
        "android",
        "ios",
        "email",
        "fillings",
        "sauces",
        "opening_hours",
        "status",
        "is_craft",
        "is_chain_restaurant",
        "location_type",
        "order_options",
        "social_media",
    ];
    protected $casts = [
        "opening_hours" => "array",
        "fillings" => "array",
        "sauces" => "array",
        "is_craft" => "boolean",
        "is_chain_restaurant" => "boolean",
        "order_options" => "array",
        "social_media" => "array",
        "opened_at_year" => "date:Y",
        "closed_at_year" => "date:Y",
    ];

    public static function boot(): void
    {
        parent::boot();
        static::observe(KebabObserver::class);
    }

    public function fillings(): BelongsToMany
    {
        return $this->belongsToMany(Filling::class);
    }

    public function sauces(): BelongsToMany
    {
        return $this->belongsToMany(Sauce::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param array $value
     */
    protected function setOpeningHoursAttribute($value): void
    {
        $days = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];

        $formatted = collect($value)->map(fn($item, $index) => [
            "day" => $days[$index],
            "from" => $item["from"] ?? null,
            "to" => $item["to"] ?? null,
        ])->toArray();

        $this->attributes["opening_hours"] = json_encode($formatted);
    }
}
