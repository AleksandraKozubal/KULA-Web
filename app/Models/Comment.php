<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "content",
        "user_id",
        "kebab_place_id",
        "parent_id",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kebabPlace(): BelongsTo
    {
        return $this->belongsTo(KebabPlace::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, "parent_id");
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, "parent_id");
    }
}
