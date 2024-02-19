<?php

namespace App\Http\Api\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/** @mixin LengthAwarePaginator */
class UserListResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'success' => true,

            'page' => $this->currentPage(),
            'total_users' => $this->total(),
            'total_pages' => $this->lastPage(),
            'count' => $this->perPage(),

            'links' => [
                'next_url' => $this->nextPageUrl(),
                'prev_url' => $this->previousPageUrl(),
            ],

            'users' => UserInfoResource::collection($this->items())
        ];
    }
}
