<?php
require_once 'Classes/SessionController.php';
if (isset($_POST['user']) && isset($_POST['password'])) {
    $cs = new SessionController();
    $result = $cs->create($_POST['user'], $_POST['name'], 
                          $_POST['lastName'], $_POST['password']);
    if( $result[0] === true ) {
        $redirigir = 'home.php?message='.$result[1];
    }
    else {
        $redirigir = 'create.php?message='.$result[1];
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
      <h1>New User</h1>
      </div>    
      <div class="text-center">
        <h3>Please Complete the inputs to create a new user</h3>
        <?php
            if (isset($_GET['message'])) {
                echo '<div id="message" class="alert alert-primary text-center">
                    <p>'.$_GET['message'].'</p></div>';
            }
        ?>

        <form action="create.php" method="post">
            <input name="user" class="form-control form-control-lg" placeholder="User Name" required><br>
            <input name="password" type="password" class="form-control form-control-lg" placeholder="Password" required><br>
            <input name="name" class="form-control form-control-lg" placeholder="Your Name" required><br>
            <input name="lastName" class="form-control form-control-lg" placeholder="Last Name"><br>
            <input type="submit" value="Register" class="btn btn-primary">
        </form>  
        
        <p><a href="index.php">Back to Login</a></p>
      </div> 
    </body>
</html>
