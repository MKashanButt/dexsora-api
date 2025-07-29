<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CreateSchemaRequest;
use App\Models\TableSchema;
use App\Services\TableSchemaService;
use App\Transformers\TableSchemaTransformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TableSchemaController extends Controller
{
    use AuthorizesRequests;
    private TableSchemaService $schemaService;
    public function __construct(TableSchemaService $schemaService)
    {
        $this->schemaService = $schemaService;
    }
    public function index(): JsonResponse
    {
        try {
            $this->authorize('viewAny',  TableSchema::class);
            $schemas = $this->schemaService->index();
            return ApiResponse::success(data: TableSchemaTransformer::collection($schemas));
        } catch (\Exception $e) {
            return ApiResponse::error(message: "Unexpected error", errors: $e->getMessage(), statusCode: 500);
        }
    }
    public function show(TableSchema $tableSchema): JsonResponse
    {
        try {
            $this->authorize('view',  $tableSchema);
            $schema = $this->schemaService->show($tableSchema);
            return ApiResponse::success(data: (new TableSchemaTransformer($schema)->transform()));
        } catch (\Exception $e) {
            return ApiResponse::error(message: "Unexpected error", errors: $e->getMessage(), statusCode: 500);
        }
    }
    public function store(CreateSchemaRequest $request): JsonResponse
    {
        try {
            $this->authorize('create',  TableSchema::class);
            $validatedRequest = $request->validated();
            $this->schemaService->store($validatedRequest);
            return ApiResponse::success(message: "Schema was Created", statusCode: 201);
        } catch (\Exception $e) {
            return ApiResponse::error(message: "Unexpected error", errors: $e->getMessage(), statusCode: 500);
        }
    }
}
