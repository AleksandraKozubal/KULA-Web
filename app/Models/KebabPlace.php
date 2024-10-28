<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}
