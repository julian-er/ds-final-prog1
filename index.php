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
      <h1>Check your pets!</h1>
      </div>    
      <div class="text-center">
        <h3>Log in to add or see your info</h3>
        <?php
            if (isset($_GET['message'])) {
                echo '<div id="message" class="alert alert-primary text-center">
                    <p>'.$_GET['message'].'</p></div>';
            }
        ?>

        <form action="login.php" method="post">
            <input name="user" class="form-control form-control-lg" placeholder="User" required><br>
            <input name="password" type="text" class="form-control form-control-lg" placeholder="Password" required><br>
            <input type="submit" value="Login" class="btn btn-primary">
        </form><br>
        <p><a href="create.php">Create new user</a></p>
      </div> 
    </body>
</html>
