<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Send success response
     *
     * @param  mixed  $data
     * @param  string $message
     * @param  int    $code
     * @return JsonResponse
     */
    protected function sendResponse($data = [], string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Send error response
     *
     * @param  string $message
     * @param  int    $code
     * @param  mixed  $errors
     * @return JsonResponse
     */
    protected function sendError(string $message = 'Error', int $code = 400, $errors = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
