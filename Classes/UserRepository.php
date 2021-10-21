<?php
require_once '.env.php';
require_once 'User.php';
require_once 'Pet.php';

class UserRepository
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos']
            );
            if (self::$conexion->connect_error) {
                $error = 'Error de conexión: ' . self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8');
        }
    }

    public function login($user, $password)
    {
        $q = "SELECT userID, password, name, lastName FROM users ";
        $q .= "WHERE user = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $user);
        if ($query->execute()) {
            $query->bind_result($userID, $encripted_password, $name, $lastName);
            if ($query->fetch()) {
                if (password_verify($password, $encripted_password) === true) {
                    return new User($user, $name, $lastName, $userID);
                }
            }
        }
        return false;
    }

    public function save(User $u, $password)
    {
        $q = "INSERT INTO users (user, lastName, name, password) ";
        $q .= "VALUES (?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param(
            "ssss",
            $u->getUser(),
            $u->getName(),
            $u->getLastName(),
            password_hash($password, PASSWORD_DEFAULT)
        );

        if ($query->execute()) {
            // Retornamos el id del usuario recién insertado.
            return self::$conexion->insert_id;
        } else {
            return false;
        }
    }

}
