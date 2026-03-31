<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\UserServices\UserService;

class UserController
{
    private $entidade;
    public function __construct(UserService $model)
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
        return $this->entidade->index();
    }
}



