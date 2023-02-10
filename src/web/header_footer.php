<?php
$header = '
<!DOCTYPE html>
<html lang="FR">
<meta charset="utf-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuolCloud</title>
    <link rel="stylesheet" href="style.css">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

<body>
<header class="p-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
        <a href="accueil.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img class="bi me-2" width="50" height="50" role="img" src="img/logo_DuolCloud.png">
          <p style="margin-bottom: 0; font-weight:bold; color:white ;">DuolCloud</p>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="Fichier.php" class="nav-link" style="color:white ;">Fichiers</a></li>
        <li class="nav-item"><a href="connexionStockage.php" class="nav-link" style="color:white ;">Connexion stockage</a></li>
        <li class="nav-item"><a href="partage.php" class="nav-link" style="color:white ;">Partage</a></li>
        </ul>

        <div class="dropdown col-md-3 text-end">
          <a href="#" class=" d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="img/avatar PP.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end text-small" style="">
            <li><a class="dropdown-item" href="connexion.php">New project...</a></li>
            <li><a class="dropdown-item" href="inscription.php">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
    <main role="main">
    
';    
      $footer = '
</main>
<footer class="py-4 my-4 px-5">
    <ul class="nav justify-content-center mb-2">
      <li class="nav-item"><a href="mentionsLegales.php" class="nav-link px-2 text-muted">Mentions légales</a></li>
      <li class="nav-item"><a href="conditionUtilisation.php" class="nav-link px-2 text-muted">Conditions d`utilisation</a></li>
    </ul>
    <hr class="my-4">
    <p class="text-center text-muted">DuolCloud © 2023 | Tous droits réservés</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>
</html>';
?>