<?php
// start session
require_once 'Classes/user.php';
session_start();
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $nomApe = $user->getNameLastName();
    $id = $user->getId();
} else {
    header('Location: index.php');
}


require_once 'Classes/SessionController.php';
$cs = new SessionController();

echo json_encode($cs->viewPets($id)) 

?>
