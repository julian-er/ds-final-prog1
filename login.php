<?php
require_once 'Classes/SessionController.php';

if (! isset($_POST['user']) || ! isset($_POST['password'])) {
    $redirect = 'index.php?message=Error: field missing';
} else {
    $cs = new SessionController();
    $login = $cs->login($_POST['user'], $_POST['password']);
    if ($login[0] === true) {
        $redirect = 'home.php';
    } else {
        $redirect = 'index.php?message=' . $login[1];
    }
}
header('Location: '.$redirect);
