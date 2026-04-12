<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $entidade;

    // CONSTRUTOR FALTAVA — sem ele $this->entidade fica null
    public function __construct(User $model)
    {
        $this->entidade = $model;
    }

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

    public function findById(int $id)
    {
        return $this->entidade->with(['profile', 'addresses'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->entidade->create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->entidade->findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id): void
    {
        $this->entidade->findOrFail($id)->delete();
    }
}
