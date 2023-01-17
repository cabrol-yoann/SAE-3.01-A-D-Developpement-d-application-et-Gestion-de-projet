<?php

include_once "../code/baseDeDonneePhysique.php";
include_once "../code/debutRecherche.php";

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

    ajoutFichier($stockage); // Vérifier si un fichier a été ajouté, faire le nécessaire si c'est le cas

    // Afficher les stockages et leurs arborésences -> Ici les stockages sont passé en paramètre depuis l'import d'un fichier
    // En pratique ils seront récupérés depuis la base de données
    // afficherStockage($stockage); 
    
    // formulaire du fichier à ajouter (possibilité de choisir un fichier .txt)
    echo '<form action="#" method="post" enctype="multipart/form-data">
        <label for="fichier">Fichier à ajouter :</label>
        <input type="file" name="fichier" id="fichier"> <br>
        <label for="tag">Tag :</label>
        <input type="text" name="tag" id="tag" placeholder="Tag">
        <input type="submit" value="Ajouter">
    </form>';
        
echo '</body>
    </html>';


// AFFICHAGE DES STOCKAGES
function afficherStockage($stockage){
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
}

// Affichage du contenu des stockages (arborésence)
function affichageContenu($racine, &$espace = 0) {
    // Gestion de l'espacement pour l'affichage de l'arborésence (décalage à droite des sous-dossiers / sous-fichiers)
    $espace += 1;
    $espacement = "";
    for ($i = 0; $i < $espace; $i++) {
        $espacement = $espacement . "--";
    }

    // Affichage des sous-dossiers -> récursif : rappel de la fonction pour chaque sous dossier
    $enfantsDoss = $racine->getListeEnfantDossier();
    while($enfantsDoss->valid()){
        echo$espacement."|".$enfantsDoss->current()->getNom().'<br>';
        affichageContenu($enfantsDoss->current(), $espace);
        $enfantsDoss->next();
    }

    // Affichage des sous-fichiers  
    $enfantsFich = $racine->getListeEnfantFichier();
    while($enfantsFich->valid()){
        echo $espacement."-".$enfantsFich->current()->getNom()."<br>";
        $enfantsFich->next();
    }
}

// Ajout d'un fichier 
function ajoutFichier($stockage){
    if(isset($_FILES["fichier"])){
        // Lecture du fichier dans lequel sont situés ses informations
        $file = file($_FILES['fichier']['tmp_name']);

        // 1er paramètre : type du fichier (dossier ou fichier)

        // Création d'un objet 
        // 2e paramètre : nom 
        // 3e paramètre : taille   
        // 4e paramètre : type 

        // if($file[0] == "fichier"){
        //     echo "création du fichier";
        // $ajout = new Fichier($file[1], intval($file[2]), "", $file[3]);
        // }
        // else{
        //     echo "création du dossier";
        //     $ajout = new Dossier($file[1], intval($file[2]), "", $file[3]);
        // }

        $ajout = new Fichier($file[1], intval($file[2]), "", $file[3]);

        // choix du stockage dans lequel le fichier sera ajouté
        // debutRecherche($stockage, $objetAPlacer,$nomEspaceStockageTrouver,$nomDossierTrouver,$restructuration);

        $restructuration = false;
        debutRecherche($stockage, $ajout, $nomEspaceStockageTrouver, $nomDossierTrouver, $restructuration);

        $nomDossierTrouver->ajouterEnfantFichier($ajout);
    }

    
}

?>