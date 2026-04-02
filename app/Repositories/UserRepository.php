<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $entidade;
    public function __construct(User $model)
    {
        $this->entidade = $model;
    }
    public function create(array $data)
    {
        $user = User::create($data);
        $user->profile()->create(['name' => $data['name']]);
        return $user;
    }
    public function index ()
    {
        return $this->entidade->get();
    }
    public function update ()
    {
        return  $this->entidade->update();
    }

      public function delete ()
    {
        return  $this->entidade->delete();
    }

}

