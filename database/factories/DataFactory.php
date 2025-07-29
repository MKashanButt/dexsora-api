<?php

namespace Database\Factories;

use App\Models\TableSchema;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::latest()->first()->id,
            "data" => ['1', 'Jhon Doe'],
            "schema_id" => TableSchema::latest()->first()->id,
        ];
    }
}
