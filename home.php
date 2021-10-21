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
    <h3>Wellcome <?php echo $nomApe; ?></h3>
    <p>What do you want to do today? </p>
    <p><a href="create-pet.php">Add new pet</a></p>
    <p><a href="#" id="view-pet">View my pets</a></p>
    <div id="pets">

    </div>
    <p><a href="logout.php">Logout</a></p>
  </div>
</body>

<script>
  let petsContainer = document.querySelector('#pets');
  let viewPet = document.querySelector('#view-pet')
  window.onload = viewPet.addEventListener('click', checkPets);

  function checkPets() {
    document.getElementById("pets").innerHTML = '<p>Loading your pets</p>';

    const fetchPets = new XMLHttpRequest();

    fetchPets.onload = function() {

      const myObj = JSON.parse(this.responseText);
      let html = `<p id="prep">Ther are your registered pets</p>`; 
      myObj.forEach(pet => {
        html += `<p>${pet.name}</p>`
      });
      document.getElementById("pets").innerHTML =   html
    }
    fetchPets.open("GET", "view-pet.php");
    fetchPets.send();
  }
</script>

</html>