<?php
require_once '.env.php';
require_once 'Pet.php';

class PetRepository
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }


    public function save(Pet $u)
    {
        $q = "INSERT INTO pets (userID, petName, breed)";
        $q.= "VALUES (?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param("sss", $u->getOwner(), $u->getName(),
            $u->getBreed());

        if ( $query->execute() ) {
            // Return id of pet.
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }


    }
}
    
