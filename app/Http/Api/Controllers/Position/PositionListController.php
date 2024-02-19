<?php

namespace App\Http\Api\Controllers\Position;

use App\Http\Api\Controllers\ApiController;
use App\Models\Position;
use Illuminate\Http\JsonResponse;

class PositionListController extends ApiController
{

    public function __invoke(): JsonResponse
    {

        $positions = Position::select(['id', 'name'])->get();


        return response()->json([
            'success' => true,
            'positions' => $positions
        ]);

    }
}
