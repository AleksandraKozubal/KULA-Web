<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function getKey()
    {
        return $this->getAttribute($this->primaryKey[0]) . '_' . $this->getAttribute($this->primaryKey[1]);
    }
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

    protected function getKeyForSaveQuery()
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kebabPlace()
    {
        return $this->belongsTo(KebabPlace::class);
    }
}
