<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
