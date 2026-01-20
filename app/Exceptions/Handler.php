<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    // existing code...
    public function render($request, Throwable $exception)
    {
        // Handle unauthenticated API requests
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
