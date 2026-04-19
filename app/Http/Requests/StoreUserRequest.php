<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool // Permitir que qualquer usuário possa criar um novo usuário (ajuste conforme necessário)
    {
        return true; // implementar lógica de autorização conforme necessário (Ex: verificar se o usuário é um administrador)
    }

    public function rules(): array // Definir as regras de validação para os campos do formulário de criação de usuário
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'cpf'        => 'required|string|unique:users,cpf',
            'password'   => 'required|string|min:8|confirmed',
            'profile_id' => 'required|exists:profiles,id',
            'birth_date' => 'nullable|date',
            'weight'     => 'nullable|numeric',

            'addresses'                => 'sometimes|array',
            'addresses.*.street'       => 'required_with:addresses|string|max:255',
            'addresses.*.number'       => 'required_with:addresses|string|max:10',
            'addresses.*.neighborhood' => 'required_with:addresses|string|max:255',
            'addresses.*.city'         => 'required_with:addresses|string|max:255',
            'addresses.*.state'        => 'required_with:addresses|string|size:2',
            'addresses.*.zip_code'     => 'required_with:addresses|string',
        ];
    }
}
