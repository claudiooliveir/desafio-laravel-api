<?php
namespace App\Services;

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

     public function update ()
    {
        return  $this->entidade->update();
    }

    public function delete ()
    {
        return  $this->entidade->delete();
    }

}
