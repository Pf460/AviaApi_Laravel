<?php

use App\Exceptions\CartEmptyException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\InvalidPasswordException;
use App\Http\Middleware\UserRoleMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api-flight',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => null);
        $middleware->alias([
            'role' => UserRoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //Обработка исключений

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api-flight/*') || $request->expectsJson(),
        );

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                return response()->json([
                    'message' => 'Login failed'
                ], 403);
            }
        });

        $exceptions->render(function (InvalidPasswordException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                return response()->json([
                    'password' => "Login failed"
                ], 401);
            }
        });

        $exceptions->render(function (AuthorizationException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                return response()->json([
                    'message' => 'Forbidden for you'
                ], 403);
            }
        });

        $exceptions->render(function (NotFoundHttpException|ModelNotFoundException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                return response()->json([
                    'message' => 'Not Found'
                ], 404);
            }
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                $message = 'Validation error';

                foreach ($e->errors() as $field => $errors) {
                    $message[$field] = $errors[0];
                }
                return response()->json($message, 422);
            }
        });

        $exceptions->render(function(CartEmptyException $e, Request $request) {
            if ($request->is('api-flight/*')) {
                return response()->json([
                    'error' => [
                        'message' => 'Cart is empty',
                    ]
                ], 422);
            }
        });
    })->create();
