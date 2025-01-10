<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\SauceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property string $hex_color
 */
class Sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "hex_color",
    ];

    public static function boot(): void
    {
        parent::boot();
        static::observe(SauceObserver::class);
    }

    public function kebabPlaces(): BelongsToMany
    {
        return $this->belongsToMany(KebabPlace::class);
    }
}
