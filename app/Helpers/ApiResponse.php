<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, string $message = "success", int $statusCode = 200): JsonResponse
    {
        $response = [
            "status" => "success",
            "message" => $message,
        ];

        if ($data) {
            $response["data"] = $data;
        }

        return response()->json($response, $statusCode);
    }

    public static function error($errors = null, string $message = "error", int $statusCode = 500): JsonResponse
    {
        $response = [
            "status" => "error",
        ];

        if ($errors) {
            $response["errors"] = $errors;
        }

        return response()->json($response, $statusCode);
    }
}
