<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Favorites extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'kebab_place_id'];
    protected $keyType = 'string';


    protected $fillable = [
        'user_id',
        'kebab_place_id'
    ];
    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getAttribute($this->primaryKey[0]) . '_' . $this->getAttribute($this->primaryKey[1]);
    }
    /**
     * @param Builder $query
     * @return Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }

        return $query;
    }

    /**
     * @return array
     */
    protected function getKeyForSaveQuery() : array
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

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function kebabPlace()
    {
        return $this->belongsTo(KebabPlace::class);
    }
}
