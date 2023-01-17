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

    // AFFICHAGE DES STOCKAGES
    $stockage -> rewind();
    while($stockage->valid()) {
        echo '<h1>'.$stockage->current()->getNom().'</h1>';
        echo '<h2>Caractéristiques</h2>';
        echo '<p> Nom : '.$stockage->current()->getNom().' | '.
        'Nom : '.$stockage->current()->getTaille().' | '.
        ' Taille maximale : '.$stockage->current()->getTailleMax().' | '.
        'Chemin : '.$stockage->current()->getChemin().' | '.
        'Restructurable ? : ';
        if ($stockage->current()->getRestructurable()){
            echo 'oui';
        }
        else{
            echo "non";
        }
        echo '<br></p><hr>';

        echo "<h2>Contenu</h2>";
        // affichage de l'arborésence
        affichageContenu($stockage->current()->getMaRacine());

        echo '<hr>';
        $stockage->next();
    }

    



echo '</body>
    </html>';


function affichageContenu($racine) {
    $enfantsDoss = $racine->getListeEnfantDossier();
    while($enfantsDoss->valid()){
        echo"|".$enfantsDoss->current()->getNom();
        affichageContenu($enfantsDoss->current());
        $enfantsDoss->next();
    }

    $enfantsFich = $racine->getListeEnfantFichier();
    while($enfantsFich->valid()){
        echo"-".$enfantsFich->current()->getNom();
        $enfantsFich->next();
    }
}

?>