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
if (isset($_POST['breed']) && isset($_POST['petName'])) {
    $cs = new SessionController();
    $result = $cs->createPet($_POST['userID'], $_POST['petName'],  $_POST['breed']);
    if( $result[0] === true ) {
        $redirigir = 'create-pet.php?message='.$result[1];
    }
    else {
        $redirigir = 'create-pet.php?message='.$result[1];
    }
    header('Location: ' . $redirigir);
}

?>
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Wellcome!</title>
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Your Wallet</h1>
      </div>    
      <div class="text-center">
        <h3>Add a new pet!</h3>
        <?php
            if (isset($_GET['message'])) {
                echo '<div id="message" class="alert alert-primary text-center">
                    <p>'.$_GET['message'].'</p></div>';
            }
        ?>

        <form action="create-pet.php" method="post">
            <input name="userID" type="hidden" class="form-control form-control-lg" value=<?php echo $id ?>><br>
            <input name="petName" class="form-control form-control-lg" placeholder="Your Pet Name" required><br>
            <input name="breed" class="form-control form-control-lg" placeholder="Your Pet Breed" required><br>
            <input type="submit" value="Add" class="btn btn-primary">
        </form>   
        
        <p><a href="home.php">Back to Home</a></p>
      </div> 
    </body>
</html>
