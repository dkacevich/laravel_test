<?php

namespace App\Http\Api\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
{

    public function rules(): array
    {

        return [
            'count' => ['required', 'int'],
            'page' => ['required', 'int', 'min:1'],
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
