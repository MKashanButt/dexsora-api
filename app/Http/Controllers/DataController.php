<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\Data;
use App\Models\TableSchema;
use App\Services\DataService;
use App\Transformers\DataTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    use AuthorizesRequests;

    protected DataService $service;
    public function __construct(DataService $service)
    {
        $this->service = $service;
    }
    public function index(TableSchema  $tableSchema): JsonResponse
    {
        try {
            $this->authorize('viewAny', [Data::class, $tableSchema]);

            $data = $this->service->index($tableSchema);

            return ApiResponse::success(data: DataTransformer::collection($data));
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error(message: "data not found or access denied", statusCode: 404);
        } catch (\Exception $e) {
            return ApiResponse::error(errors: $e->getMessage(), message: "unexpected error", statusCode: 500);
        }
    }
    public function show(Data $data): JsonResponse
    {
        try {
            $this->authorize('view', $data);

            $data = $this->service->show($data);

            return ApiResponse::success(data: (new DataTransformer($data)->transform()));
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error(message: "data not found or access denied", statusCode: 404);
        } catch (\Exception $e) {
            return ApiResponse::error(errors: $e->getMessage(), message: "unexpected error", statusCode: 500);
        }
    }
    public function store(StoreDataRequest $request, TableSchema $tableSchema): JsonResponse
    {
        $validatedRequest = $request->validated();
        try {
            $this->authorize('create', [Data::class, $tableSchema]);

            $this->service->store($validatedRequest);

            return ApiResponse::success(message: "data added", statusCode: 201);
        } catch (\Exception $e) {
            return ApiResponse::error(errors: $e->getMessage(), message: "unexpected error", statusCode: 500);
        }
    }

    public function update(UpdateDataRequest $request, Data $data): JsonResponse
    {
        $validated = $request->validated();

        try {
            $this->authorize('update', $data);

            $this->service->update($data, $validated);

            return ApiResponse::success(message: "data updated");
        } catch (\Exception $e) {
            return ApiResponse::error(errors: $e->getMessage(), message: "unexpected error", statusCode: 500);
        }
    }

    public function destroy(Data $data): JsonResponse
    {
        try {
            $this->authorize('delete', $data);

            $this->service->delete($data);

            return ApiResponse::success(message: "data deleted");
        } catch (\Exception $e) {
            return ApiResponse::error(errors: $e->getMessage(), message: "unexpected error", statusCode: 500);
        }
    }
}
