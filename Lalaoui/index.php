<?php
  //Pour éviter les notices
  if (session_status() == PHP_SESSION_NONE) {
    // Démarrer la session
    session_start();
  }
  var_dump($_SESSION);
  require_once "config/databaseConnexion.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="image\icon.png">
  <title>Naturia Shop</title>
</head>

<body>
  <header>
    <div>
      <?php require_once "components\header.php"; ?>
    </div>
  </header>
  <main>
    <?php require_once "controller/userController.php"; ?>
    <?php require_once "controller/itemController.php"; ?>
  </main>
</body>

</html>