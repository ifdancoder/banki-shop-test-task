<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait APIReturnTrait
{
    public function sendResponse($message, $data = [], $code = 200)
    {
        return new JsonResponse([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function sendError($message, $data = [], $code = 404)
    {
        return new JsonResponse([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}