<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name'       => 'sometimes|string|max:255',
            'email'      => 'sometimes|email|unique:users,email,' . $id,
            'cpf'        => 'sometimes|string|unique:users,cpf,' . $id,
            'password'   => 'sometimes|string|min:8|confirmed',
            'profile_id' => 'sometimes|exists:profiles,id',
            'birth_date' => 'nullable|date',
            'weight'     => 'nullable|numeric',

            'addresses'                => 'sometimes|array',
            'addresses.*.street'       => 'sometimes|string|max:255',
            'addresses.*.number'       => 'sometimes|string|max:10',
            'addresses.*.neighborhood' => 'sometimes|string|max:255',
            'addresses.*.city'         => 'sometimes|string|max:255',
            'addresses.*.state'        => 'sometimes|string|size:2',
            'addresses.*.zip_code'     => 'sometimes|string',
        ];
    }
}
