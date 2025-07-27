<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableSchema extends Model
{
    protected $table = "scehmas";

    protected $fillable = [
        "slug",
        "schema",
        "user_id",
    ];

    protected function casts()
    {
        return [
            "schema" => "json",
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
