<?php

namespace App\Http\Api\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UseInfoRequest extends FormRequest
{


    public function rules(): array
    {

        return [
            'user_id' => ['required', 'int', Rule::exists('users', 'id')],
        ];
    }


    public function validationData(): ?array
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters());
            $this->query->add($this->route()->parameters());

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }


}
