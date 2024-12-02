<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $name
 * @property ?string $logo
 * @property string $address
 * @property string $lat
 * @property string $long
 * @property ?string $opened_at_year
 * @property ?string $closed_at_year
 * @property array $opening_hours
 * @property array $fillings
 * @property array $sauces
 * @property string $status
 * @property bool $is_craft
 * @property bool $is_chain_restaurant
 * @property string $location_type
 * @property array $order_options
 * @property Collection $social_media
 */
class Kebab extends Model
{
    use HasFactory;

    public const string PHOTOS_DIRECTORY = "kebab";

    protected $fillable = [
        "name",
        "logo",
        "address",
        "lat",
        "long",
        "opened_at_year",
        "closed_at_year",
        "opening_hours",
        "fillings",
        "sauces",
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
        "social_media" => "collection",
        "opened_at_year" => "date:Y",
        "closed_at_year" => "date:Y",
    ];

    /**
     *
     * @param array $value
     * @return void
     */
    protected function setOpeningHoursAttribute($value)
    {
        $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];

        $formatted = collect($value)->map(function ($item, $index) use ($days) {
            return [
                'day' => $days[$index],
                'from' => $item['from'] ?? null,
                'to' => $item['to'] ?? null,
            ];
        })->toArray();

        $this->attributes['opening_hours'] = json_encode($formatted);
    }

}
