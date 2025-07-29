<?php

namespace App\Services;

use App\Models\Data;
use App\Models\TableSchema;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DataService
{
    public function index(TableSchema  $tableSchema): Collection
    {
        return $tableSchema->load('data')->data;
    }

    public function show(Data $data): Data
    {
        return $data;
    }

    public function store(array $data): Data
    {
        return Data::create([
            ...$data,
            "user_id" => Auth::id()
        ]);
    }

    public function update(Data $data, array $validatedData): Data
    {
        $data->update($validatedData);
        return $data;
    }

    public function delete(Data $data): bool
    {
        return $data->delete();
    }
}
