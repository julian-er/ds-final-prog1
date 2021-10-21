<?php
require_once 'User.php';
require_once 'Pet.php';
require_once 'UserRepository.php';
require_once 'PetRepository.php';

class SessionController
{
    protected $user = null;

    public function login($user_name, $password)
    {
        $repo = new UserRepository();
        $user = $repo->login($user_name, $password);
        //Si falló el login:
        if ($user === false) {
            return [false, "Error : check your user or password"];
        } else {
            session_start();
            $_SESSION['user'] = serialize($user);
            return [true, "User loged correctly"];
        }
    }

    public function create($user_name, $name, $lastName, $password)
    {
        $repo = new UserRepository();
        $user = new User($user_name, $name, $lastName);
        $id = $repo->save($user, $password);
        if ($id === false) {
            return [ false, "Error on creation"];
        }
        else {
            $user->setId($id);
            session_start();
            $_SESSION['user'] = serialize($user);
            return [ true, "User created" ];
        }
    }

    public function createPet($ownerID, $name, $breed)
    {
        $repo = new PetRepository();
        $pet = new Pet($ownerID, $name, $breed);
        $id = $repo->save($pet);
        if ($id === false) {
            return [ false, "Error on creation"];
        }
        else {
            $pet->setId($id);
            return [ true, $pet->getName() ." the " . $pet->getBreed() . " Pet created" ];
        }
    }
}
