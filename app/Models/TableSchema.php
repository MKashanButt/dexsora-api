<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableSchema extends Model
{
    protected $table = "schemas";

    protected $fillable = [
        "slug",
        "schema",
        "user_id",
    ];

    protected $casts = [
        'schema' => 'array',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function data(): HasMany
    {
        return $this->hasMany(Data::class);
    }
}
