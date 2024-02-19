<?php

namespace App\Http\Api\Controllers\User;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\User\UseInfoRequest;
use App\Http\Api\Resources\UserInfoResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Response;

class UserInfoController extends ApiController
{

    public function __invoke(UseInfoRequest $request): JsonResponse
    {

        $user = User::find($request->user_id)
            ->load('position');

        return Response::json([
            'success' => true,
            'user' => UserInfoResource::make($user)
        ]);

    }
}
