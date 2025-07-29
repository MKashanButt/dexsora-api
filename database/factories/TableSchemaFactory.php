<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TableSchema>
 */
class TableSchemaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "slug" => fake()->slug(),
            "schema" => [
                "s.no" => "integer",
                "name" => "string",
            ],
            "user_id" => User::latest()->first()->id,
        ];
    }
}
