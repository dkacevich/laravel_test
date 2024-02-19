<?php

namespace App\Http\Api\Controllers\Token;

use App\Http\Api\Controllers\ApiController;
use App\Models\AccessToken;
use Illuminate\Http\JsonResponse;

class CreateTokenController extends ApiController
{

    public function __invoke(): JsonResponse
    {
        $token = AccessToken::factory()->createOne();

        return response()->json([
            'success' => true,
            'token' => $token->payload
        ]);

    }
}
