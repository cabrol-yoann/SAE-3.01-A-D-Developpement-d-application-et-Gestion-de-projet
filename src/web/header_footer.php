<?php
$header = headerIf();

function headerIf() {
  include_once "../class/Utilisateur.php";
  session_start();
  $connexion = '<li><a class="dropdown-item" href="page_Connexion.php">Connexion</a></li>';
  $pseudo = 'Connectez-vous !';
  if (isset($_SESSION['utilisateur'])) {
    $connexion = '<li><a class="dropdown-item" href="../code/deconnexion.php">Deconnexion</a></li>';
    $pseudo = $_SESSION['utilisateur']->getNom();
  }
    return '
<!DOCTYPE html>
<html lang="FR">
<meta charset="utf-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuolCloud</title>
    <link rel="stylesheet" href="style.css">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    </head>

<body>
  <header class="p-3 border-bottom">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
        <a href="index.php" class="d-flex align-items-center  text-dark text-decoration-none">
          <img class="bi" width="50" height="50" role="img" src="img/logo_DuolCloud.png">
          <p class="fs-5 text-white" style="margin-bottom: 0; font-weight:bold;">DuolCloud</p>
        </a>

        <ul class="text-center nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="affichageStockage.php" class="nav-link fs-5 text-white">Stockage</a></li>
        <li class="nav-item"><a href="page_ConnexionStockage.php" class="nav-link fs-5 text-white">Connexion stockage</a></li>
        <li class="nav-item"><a href="page_Partage.php" class="nav-link fs-5 text-white">Partage</a></li>
        </ul>

        <div class="text-end d-flex align-items-center">
          <p class="fs-5 text-white" style="margin-bottom: 0; font-weight:bold; width: 100px; height: 30px;">'. $pseudo .'</p>
          <div class="dropdown">
            <a class="d-block text-decoration-none" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="img/avatar PP.png" alt="Profil" width="40" height="40" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small">
              <li><a class="dropdown-item" href="page_Parametres.php">Paramètres</a></li>
              <li><hr class="dropdown-divider"></li> '.
              $connexion
              .'
            </ul>
          </div>
          </div>
      </div>
    </div>
  </header>
    <main role="main">
    
';    
}
      $footer = '
</main>
<footer class="py-4 my-4 px-5">
    <ul class="nav justify-content-center mb-2">
      <li class="nav-item"><a href="page_MentionsLegales.php" class="nav-link px-2 text-muted">Mentions légales</a></li>
      <li class="nav-item"><a href="page_ConditionUtilisation.php" class="nav-link px-2 text-muted">Conditions d`utilisation</a></li>
    </ul>
    <hr class="my-4">
    <p class="text-center text-muted">DuolCloud © 2023 | Tous droits réservés</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>';
?>