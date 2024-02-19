<?php

namespace App\Http\Api\Requests\User;

use App\Data\User\RegisterUserData;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:60'],
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
            'position_id' => ['required', 'int', Rule::exists('positions', 'id')],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg', 'max:5120'],
        ];
    }


    public function toData(): RegisterUserData
    {
        return RegisterUserData::fromArray($this->validated());
    }
}
