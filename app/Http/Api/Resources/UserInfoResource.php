<?php

namespace App\Http\Api\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserInfoResource extends JsonResource
{

    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position_id' => $this->position_id,
            'position' => $this->position?->name,
            'photo' => $this->photoUrl(),
        ];
    }
}
