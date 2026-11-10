<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user)
        {
            return response()->json([
                'message' => 'Login failed'
            ], 404);
        }

        if ($user->role->value !== $role)
        {
            return response()->json([
                'message' => 'Forbidden for you'
            ], 403);
        }

        return $next($request);
    }
}
