<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kebab_place_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kebabPlace()
    {
        return $this->belongsTo(KebabPlace::class);
    }
}
