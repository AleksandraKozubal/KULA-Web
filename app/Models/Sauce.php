<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\SauceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 */
class Sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public static function boot(): void
    {
        parent::boot();
        static::observe(SauceObserver::class);
    }

}
