<?php

namespace Tests\Feature\Tables;

use App\Models\TableSchema;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchemaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_post_schemas_when_authenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'slug' => 'Test Document #1',
            'schema' => [
                "s.no" => "integer",
                "name" => "string",
                "age" => "integer",
                "files" => "files"
            ],
        ];

        TableSchema::create([
            ...$data,
            "user_id" => $user->id
        ]);

        $response = $this->postJson('/api/v1/schema', [
            'slug' => 'Test Document #2',
            'schema' => [
                "s.no" => "integer",
                "name" => "string",
                "age" => "integer",
                "files" => "files"
            ],
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'status' => 'success',
            'data' => [
                'message' => 'Schema was Created'
            ]
        ]);
    }

    public function test_user_can_get_schemas_when_authenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/v1/schema');

        $response->assertStatus(201);
    }

    public function test_user_can_get_certain_schema_when_authenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'slug' => 'Test Document #1',
            'schema' => [
                "s.no" => "integer",
                "name" => "string",
                "age" => "integer",
                "files" => "files"
            ],
        ];

        $schema = TableSchema::create([
            ...$data,
            "user_id" => $user->id
        ]);

        $response = $this->getJson("/api/v1/schema/{$schema->id}");

        $response->assertStatus(200);
        $response->assertJson([
            "status" => "success",
            "data" => [
                "slug" => $schema->slug,
                "schema" => $schema->schema,
                "user_id" => $schema->user_id
            ]
        ]);
    }
}
