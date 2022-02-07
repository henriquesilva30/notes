<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if (!empty($_SESSION['email'])) {
  $iduser = $_SESSION['id'];
  // var_dump($iduser);
}




?>



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trabalho 1</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="./components/style.css"> -->

</head>

<body>
  <nav>
    <ul class="nav-list">
      <li class="nav-item">
       <a href="#"> My store Box</a>
      </li>
      <li class="nav-item">
        <?php if (!empty($_SESSION)) {
          echo '<a href="http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php" class="nav-link active">Apontamentos</a>';
        } else echo '' ?>
      </li>
      <li class="nav-item">
        <?php if (!empty($_SESSION)) {
          echo '<a href="http://localhost:81/SIR2122/Trabalho/User/editar.php" class="nav-link">' . $_SESSION['email'] . '</a>';
        } else echo '<a href="http://localhost:81/SIR2122/Trabalho/Home/login.php" class="nav-link">Iniciar sessão</a>' ?>
      </li>
      <li class="nav-item">
            <p href="#" class="nav-link ">|</p>
      </li>
      <li class="nav-item">
        <?php if (!empty($_SESSION)) {
          echo '<a href="../Home/logout.php" class="nav-link">Terminar sessão</a>';
        } else echo '<a href="registar.php" class="nav-link">Registar conta</a>' ?>
      </li>
    </ul>
  </nav>
