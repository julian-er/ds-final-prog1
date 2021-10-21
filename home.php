<?php
require_once 'Classes/user.php';
session_start();
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $nomApe = $user->getNameLastName();
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
      <h1>Member Dashboard!</h1>
      </div>    
      <div class="text-center">
        <h3>Wellcome <?php echo $nomApe;?></h3>
        <p>What do you want to do today? </p>
        <p><a href="create-pet.php">Add new pet</a></p>
        <p><a href="view-pet.php">View my pets</a></p>
        <p><a href="logout.php">Logout</a></p>
      </div> 
    </body>
</html>

