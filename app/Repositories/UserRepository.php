<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private User $entidade;

    public function __construct(User $model)
    {
        $this->entidade = $model;
    }

    // Listar com filtros
    public function all(array $filters = [])
    {
        $query = $this->entidade->with(['profile', 'addresses']);

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['cpf'])) {
            $query->where('cpf', $filters['cpf']);
        }

        if (!empty($filters['from'])) {
            $query->whereDate('created_at', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('created_at', '<=', $filters['to']);
        }

        return $query->get();
    }

    // Buscar por ID
    public function findById(int $id): User
    {
        return $this->entidade
            ->with(['profile', 'addresses'])
            ->findOrFail($id);
    }

    // Criar usuário
    public function create(array $data): User
    {
        // Hash da senha
        $data['password'] = Hash::make($data['password']);

        // Remove a máscara do CPF
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);

        $user = $this->entidade->create($data);

        // Salva os endereços se foram enviados
        if (!empty($data['addresses'])) {
            foreach ($data['addresses'] as $addressData) {
                $address = Address::firstOrCreate(
                    [
                        'zip_code' => $addressData['zip_code'],
                        'number'   => $addressData['number'],
                    ],
                    $addressData
                );
                $user->addresses()->attach($address->id);
            }
        }

        // Retorna com os relacionamentos
        return $user->load(['profile', 'addresses']);
    }

    // Atualizar usuário
    public function update(int $id, array $data): User
    {
        $user = $this->entidade->findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (!empty($data['cpf'])) {
            $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        }

        $user->update($data);

        // Atualiza endereços se foram enviados
        if (!empty($data['addresses'])) {
            $addressIds = [];
            foreach ($data['addresses'] as $addressData) {
                $address = Address::firstOrCreate(
                    [
                        'zip_code' => $addressData['zip_code'],
                        'number'   => $addressData['number'],
                    ],
                    $addressData
                );
                $addressIds[] = $address->id;
            }
            $user->addresses()->sync($addressIds);
        }

        // Retorna com os relacionamentos
        return $user->load(['profile', 'addresses']);
    }

    // Deletar usuário
    public function delete(int $id): void
    {
        $user = $this->entidade->findOrFail($id);
        $user->addresses()->detach();
        $user->delete();
    }
}
