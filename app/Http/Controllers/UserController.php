<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserController
{
    private $entidade;
    public function __construct(UserService $service)
    {
        $this->entidade = $service;
    }
    public function create(array $data)
    {
        $user = User::create($data);
        $user->profile()->create(['name' => $data['name']]);
        return $user;
    }
    public function index ()
    {
        return $this->entidade->index();
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



