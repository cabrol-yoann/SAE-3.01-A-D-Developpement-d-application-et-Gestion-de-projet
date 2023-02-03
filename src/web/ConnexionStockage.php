<?php
include_once "header_footer.php";

echo $header;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuolCloud - Connexion Stockage</title>

</head>

<body>
    <header role="banner">
        <a href="index.php" class="header-tittle">WORLDS CUPS HITS</a>
        <nav class="nav-tittle">
            <ul class="list-tittle">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="gestion.php">Gestion</a></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="form-edit">
            <article class="form-titre">
                <h2 style="margin-left: 210px; font-size: 30px;">Ajout d'un disque</h1>
            </article>
            <form action="add.php" method="POST">
                <label>Auteur : </label>
                <input type="text" name="auteur" required>
                <br />
                <label>Titre : </label>
                <input type="text" name="titre" required>
                <br />
                <label>Genre : </label>
                <input type="text" name="genre" required>
                <br />
                <label>Prix : </label>
                <input min=1 type="number" name="prix" required>
                <br />
                <label>Image : </label>
                <input type="text" name="image" required><br />
                <input class="edit-bouton" type="submit" value="Ajouter !">
            </form>
        </section>
    </main>
    <footer role="contentinfo"> </footer>
</body>

</html>

<?php
include_once "header_footer.php";

echo $footer;

?>