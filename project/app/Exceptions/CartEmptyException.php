<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CartEmptyException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => 422,
                'message' => 'Cart is empty'
            ]
        ],422);
    }
}
