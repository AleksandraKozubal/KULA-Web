<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\FillingObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property bool $is_vegan
 * @property string $hex_color
 */
class Filling extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_vegan',
        'hex_color'
    ];

    public function kebabPlaces(): BelongsToMany
    {
        return $this->belongsToMany(KebabPlace::class);
    }
    public static function boot(): void
    {
        parent::boot();
        static::observe(FillingObserver::class);
    }
}
