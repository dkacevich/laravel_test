<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Response;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (ValidationException $exception) {

            return Response::validationException(
                message: 'Validation failed',
                fails: $exception->errors()
            );

        });


        $this->renderable(function (BusinessException $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], $exception->getCode());

        });

    }
}
