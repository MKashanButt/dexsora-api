<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSchemaRequest;
use App\Models\TableSchema;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TableSchemaController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $schemas = TableSchema::where("user_id", Auth::id())->get();

            return response()->json([
                "status" => "success",
                "data" => $schemas
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "data" => [
                    "message" => "Unexpected error",
                    "error" => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $schema = TableSchema::where("id", $id)
                ->where("user_id", Auth::id())
                ->firstOrFail();

            return response()->json([
                "status" => "success",
                "data" => [
                    "slug" => $schema->slug,
                    "schema" => $schema->schema,
                    "user_id" => $schema->user_id
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => "error",
                "data" => [
                    "message" => "Schema not found or access denied."
                ]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "data" => [
                    "message" => "Unexpected error",
                    "error" => $e->getMessage()
                ]
            ], 500);
        }
    }
    public function store(CreateSchemaRequest $request): JsonResponse
    {
        try {
            $validatedRequest = $request->validated();
            $validatedRequest["user_id"] = Auth::id();

            TableSchema::create($validatedRequest);

            return response()->json([
                "status" => "success",
                "data" => [
                    "message" => "Schema was Created"
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "data" => [
                    "message" => "Schema Creation Failed",
                    "error" => $e->getMessage()
                ]
            ], 500);
        }
    }
}
