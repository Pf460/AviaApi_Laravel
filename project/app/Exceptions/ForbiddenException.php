<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ForbiddenException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => 'Forbidden for you'
        ], 403);
    }
}
