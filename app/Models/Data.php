<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Data extends Model
{
    protected $fillable = [
        "user_id",
        "data",
        "schema_id"
    ];

    protected $casts =  [
        "data" => "array",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function schemas(): HasMany
    {
        return $this->hasMany(TableSchema::class);
    }
}
