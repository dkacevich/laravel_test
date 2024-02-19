<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;

class FallbackController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => 'Page not found'
        ], 404);
    }
}
