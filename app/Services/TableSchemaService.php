<?php

namespace App\Services;

use App\Models\Data;
use App\Models\TableSchema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TableSchemaService
{
    public function index(): Collection
    {
        return TableSchema::where("user_id", Auth::id())->get();
    }

    public function show(TableSchema $tableSchema): TableSchema
    {
        return $tableSchema;
    }

    public function store(array $tableSchema): TableSchema
    {
        return TableSchema::create([
            ...$tableSchema,
            "user_id" => Auth::id()
        ]);
    }
}
