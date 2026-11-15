<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCanditionsException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'password' => 'Login failed',
        ], 401);
    }
}
