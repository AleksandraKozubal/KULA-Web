<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $description
 * @property SuggestionStatus $status
 * @property int $user_id
 * @property int $kebab_place_id
 * @property ?string $comment
 * @property-read  User $user
 * @property-read  KebabPlace $kebabPlace
 */
class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "status",
        "user_id",
        "kebab_place_id",
        "comment",
    ];
    protected $casts = [
        "status" => SuggestionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
