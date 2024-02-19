<?php

namespace App\Data\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    public function __construct(
        public readonly string       $name,
        public readonly string       $email,
        public readonly string       $phone,
        public readonly int          $position_id,
        public readonly UploadedFile $photo,
    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            position_id: $data['position_id'],
            photo: $data['photo'],
        );
    }
}
