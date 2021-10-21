<?php
require_once 'User.php';
require_once 'UserRepository.php';

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
}
