<?php

namespace App\Http\Api\Controllers\User;

use App\Actions\User\RegisterUserAction;
use App\Exceptions\BusinessException;
use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\User\RegisterUserRequest;
use Illuminate\Http\JsonResponse;

class RegisterUserController extends ApiController
{
    
    /**
     * @throws BusinessException
     */
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $data = $request->toData();

        $userId = app(RegisterUserAction::class)->run($data);

        return response()->json([
            'success' => true,
            'user_id' => $userId,
            'message' => "New user successfully registered"
        ]);

    }
}
