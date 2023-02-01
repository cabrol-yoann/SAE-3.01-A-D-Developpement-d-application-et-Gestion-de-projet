<?php
$header = '
<!DOCTYPE html>
<html lang="FR">
<meta charset="utf-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuolCloud</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/ae52c2fd44.js" crossorigin="anonymous"></script>
</head>

<body>
    <header role="banner">
        <img src="logo_DuolCloud.png">
        <p class="header-title">DuolCloud</p>
        <nav id="navigation" class="nav-title" role="navigation" aria-label="menu de navigation">
            <ul>
                <li><a class="menu-link" href="#Fichiers">Fichiers</a></li>
                <li><a class="menu-link" href="#Connexion Espace de Stockage">Connexion Espace de Stockage</a></li>
                <li><a class="menu-link" href="#Partage">Partage</a></li>
            </ul>
        </nav>
        <div class="profile">
            <img src="avatar.jpg">
            <p>'.$_SESSION['pseudo'].'</p>
        </div>
    </header>
    <hr>
    <main role="main">
    
';    
$footer = '</main>
</body>
<footer>
    <div class="footer-section">
        <h3>Informations juridiques</h3>
        <ul>
            <li><a href="#">Mentions légales</a></li>
            <li><a href="#">Conditions d utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
        </ul>
    </div>
    <p>DuolCloud © 2023 | Tous droits réservés</p>
</footer>

</html>';
?>