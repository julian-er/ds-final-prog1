<?php
require_once 'Classes/user.php';
session_start();
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $nomApe = $user->getNombreApellido();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Pet Wallet</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Check your wallet!</h1>
      </div>    
      <div class="text-center">
        <h3>Wellcome <?php echo $nomApe;?></h3>
        <p><a href="logout.php">Logout</a></p>
      </div> 
    </body>
</html>

