<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository; // ← PASSO 1: declarar a propriedade separado

    public function __construct(UserRepository $repository) // ← PASSO 2: injetar o repositório via construtor
    {
        $this->repository = $repository; // ← PASSO 3: atribuir o repositório à propriedade
    }

    public function index(array $filters = [])
    {
        return $this->repository->all($filters); // ← PASSO 4: usar o repositório para buscar os dados
    }

    public function show(int $id)
    {
        return $this->repository->findById($id); // ← método novo para buscar por ID
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']); // ← hash da senha
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // não atualiza senha se não foi enviada
        }
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
