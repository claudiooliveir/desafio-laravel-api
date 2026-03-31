<?php
namespace App\UserServices;

use App\Repositories\UserRepository;

class UserService{
    private $entidade;
    public function __construct(UserRepository$repository)
    {
        $this->entidade = $repository;
    }


    public function index ()
    {
        return $this->entidade->index();
    }
}
