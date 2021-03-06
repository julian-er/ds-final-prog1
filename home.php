<?php
require_once 'Classes/user.php';
session_start();
if (isset($_SESSION['user'])) {
  $user = unserialize($_SESSION['user']);
  $nomApe = $user->getNameLastName();
} else {
  header('Location: index.php');
}

// delete pet
require_once 'Classes/SessionController.php';
if (isset($_POST['petID'])) {
  $cs = new SessionController();
  $result = $cs->deletePet($_POST['petID']);
  if ($result[0] === true) {
    $redirigir = 'home.php?message=' . $result[1];
  } else {
    $redirigir = 'home.php?message=' . $result[1];
  }
  header('Location: ' . $redirigir);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Pet Wallet</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css" >
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


  function deletePet(petID) {

    const deletePet = new XMLHttpRequest();

    deletePet.onload = function() {
      document.getElementById("pets").innerHTML = `<div id="message" class="alert alert-primary text-center">
              <p>Deleting your pet, please wait...</p>
          </div>`
      setTimeout(() => {
        //restore count
        countPets();
        document.getElementById("pets").innerHTML = `<div id="message" class="alert alert-primary text-center">
              <p>${this.responseText}</p>
          </div>`
      }, 2000);
    }

    deletePet.open("GET", "delete-pet.php?petID=" + petID);
    deletePet.send();
    
  };

  function checkPets() {
    document.getElementById("pets").innerHTML = `<div id="message" class="alert alert-primary text-center">
              <p>Loading your pets...</p>
          </div>`;

       
    const fetchPets = new XMLHttpRequest();

    
    fetchPets.onload = function() {

      const myObj = JSON.parse(this.responseText);
      let html = `<p id="prep">These are your pets: </p> <p> You can delete some or just see the info </p>`;
      myObj.forEach(pet => {
        html += `<div class='petCard'>
                      <p>${pet.name}</p>
                      <button class="btn btn-primary" onclick=deletePet(${pet.id})>Delete Pet</button>
                  </div>`
      });
      setTimeout(() => {
        document.getElementById("pets").innerHTML = html
    }, 2000); 
    }
  
    fetchPets.open("GET", "view-pet.php");
    fetchPets.send();
  }

  function countPets() {

    const fetchPets = new XMLHttpRequest();

    fetchPets.onload = function() {

      const count = this.responseText
      viewPet.innerHTML = `view my ${count} pets `
    }

    fetchPets.open("GET", "count-pets.php");
    fetchPets.send();
  }

  countPets();
</script>

</html>