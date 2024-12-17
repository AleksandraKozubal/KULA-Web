<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\KebabPlace;


class Sauce extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'spiciness',
        'is_vegan',
        'is_gluten_free',
        'hex_color'
    ];

    /**
     * @return BelongsToMany
     */
    public function kebabPlaces()
    {
        return $this->belongsToMany(KebabPlace::class);
    }
}
