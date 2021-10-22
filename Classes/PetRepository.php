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


    public function save(Pet $u)
    {
        $q = "INSERT INTO pets (userID, petName, breed)";
        $q .= "VALUES (?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param(
            "sss",
            $u->getOwner(),
            $u->getName(),
            $u->getBreed()
        );

        if ($query->execute()) {
            // Return id of pet.
            return self::$conexion->insert_id;
        } else {
            return false;
        }
    }

    public function getPets($ownerID)
    {
        $q = "SELECT * FROM pets ";
        $q .= "WHERE userID = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $ownerID);

        if ($query->execute()) {

            $result = $query->get_result();
            $pets = array();

            while ($row = $result->fetch_assoc()) {
                array_push($pets, new Pet($row['userID'], $row['petName'], $row['breed'], $row['petID']));
            }
            return $pets;
        } else {
            return false;
        }
    }

    public function deletePet($petId)
    {
        $q = "DELETE FROM pets ";
        $q .= "WHERE petID = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $petId);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function howManyPets($userId)
    {
        $q = "SELECT COUNT(p.petID) from pets p inner join users u on p.userID = u.userID ";
        $q .= "WHERE u.userID = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("s", $userId);

        if ($query->execute()) {
            $query->store_result();
            $query->bind_result($number);
            $query->fetch();
            return $number;
        } else {
            return false;
        }
    }
}
