<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorites extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ["user_id", "kebab_place_id"];
    protected $keyType = "string";
    protected $fillable = [
        "user_id",
        "kebab_place_id",
    ];

    public function getKey(): string
    {
        return $this->getAttribute($this->primaryKey[0]) . "_" . $this->getAttribute($this->primaryKey[1]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kebabPlace(): BelongsTo
    {
        return $this->belongsTo(KebabPlace::class);
    }

    protected function setKeysForSaveQuery($query): Builder
    {
        $keys = $this->getKeyName();

        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $key) {
            $query->where($key, "=", $this->getAttribute($key));
        }

        return $query;
    }

    protected function getKeyForSaveQuery(): array
    {
        $keys = $this->getKeyName();

        if (!is_array($keys)) {
            return parent::getKeyForSaveQuery();
        }

        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $this->getAttribute($key);
        }

        return $result;
    }
}
