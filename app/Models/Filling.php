<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filling extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
