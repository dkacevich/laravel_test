<?php

namespace App\Actions\User;

use App\Data\User\RegisterUserData;
use App\Exceptions\BusinessException;
use App\Models\User;
use App\Services\ImageManager\Data\ResizeImageData;
use App\Services\ImageManager\Enum\ResizeMethod;
use App\Services\ImageManager\ImageManager;

class RegisterUserAction
{
    public function __construct(
        private readonly ImageManager $imageManager
    ) {}


    /**
     * @throws BusinessException
     */
    public function run(RegisterUserData $data): int
    {
        $existingUser = User::query()
            ->where('email', $data->email)
            ->orWhere('phone', $data->phone)
            ->first();

        if ($existingUser) {
            throw new BusinessException('User with this phone or email already exist', 409);
        }

        $photo = $this->imageManager
            ->optimize($data->photo)
            ->resize(new ResizeImageData(
                resize_method: ResizeMethod::COVER,
                width: 50,
                height: 50
            ))
            ->store();


        $user = User::create([
            ...$data->all(),
            'photo' => $photo
        ]);

        return $user->id;
    }
}
