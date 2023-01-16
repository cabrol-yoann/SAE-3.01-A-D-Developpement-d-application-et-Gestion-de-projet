<?php

include_once "../code/baseDeDonneePhysique.php";

echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Duolcloud</title>
        <link rel="stylesheet" href="">
    </head>
    <body>';
    while($Stockage->valid()) {
        echo '<h1>'.$Stockage->current()->getNom().'</h1>';
        echo '<p>'.$Stockage->current()->getNom().'NOM <br>'
        .$Stockage->current()->getTaille().'Taille <br>'
        .$Stockage->current()->getTailleMax().'TAILLEMAX <br>'
        .$Stockage->current()->getChemin().'CHEMIN <br>'
        .$Stockage->current()->getRestructurable().'RESTRUCTURATION <br>
        </p>';
        $Stockage->next();
    }
echo '</body>
    </html>';
    
?>