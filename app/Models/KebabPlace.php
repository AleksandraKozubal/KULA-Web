<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KebabPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'building_number',
        'latitude',
        'longitude',
        'google_maps_url',
        'google_maps_rating',
        'phone',
        'website',
        'email',
        'fillings',
        'sauces',
        'image'
    ];

    /**
     * @return BelongsToMany
     */
    public function fillings()
    {
        return $this->belongsToMany(Filling::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sauces()
    {
        return $this->belongsToMany(Sauce::class);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
