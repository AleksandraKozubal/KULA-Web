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
 * @property ?int $opened_at_year
 * @property ?int $closed_at_year
 * @property array $opening_hours_monday
 * @property array $opening_hours_tuesday
 * @property array $opening_hours_wednesday
 * @property array $opening_hours_thursday
 * @property array $opening_hours_friday
 * @property array $opening_hours_saturday
 * @property array $opening_hours_sunday
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

    public const PHOTOS_DIRECTORY = "kebab-place";

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
        "opening_hours_monday",
        "opening_hours_tuesday",
        "opening_hours_wednesday",
        "opening_hours_thursday",
        "opening_hours_friday",
        "opening_hours_saturday",
        "opening_hours_sunday",
        "status",
        "is_craft",
        "is_chain_restaurant",
        "location_type",
        "order_options",
        "social_media",
    ];
    protected $casts = [
        "opening_hours_monday" => "array",
        "opening_hours_tuesday" => "array",
        "opening_hours_wednesday" => "array",
        "opening_hours_thursday" => "array",
        "opening_hours_friday" => "array",
        "opening_hours_saturday" => "array",
        "opening_hours_sunday" => "array",
        "fillings" => "array",
        "sauces" => "array",
        "is_craft" => "boolean",
        "is_chain_restaurant" => "boolean",
        "order_options" => "array",
        "social_media" => "array",
        "opened_at_year" => "integer",
        "closed_at_year" => "integer",
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
    // protected function setOpeningHoursAttribute($value): void
    // {
    //     $days = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];

    //     $formatted = collect($value)->map(fn($item, $index) => [
    //         "day" => $days[$index],
    //         "from" => $item["from"] ?? null,
    //         "to" => $item["to"] ?? null,
    //     ])->toArray();

    //     $this->attributes["opening_hours"] = json_encode($formatted);
    // }
}
