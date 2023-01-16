<?php

include_once "baseDeDonneePhysique.php";
include_once "trierList.php";



function debutRecherche ($stockage, $objetAPlacer){
//Meilleur Emplacement
    //initialisation
    $score = 0;
    $nomDossierTrouver = "";
    $listStockage = new \SplObjectStorage(); 
    $trouver = false;
    $tailleCalculer = 0;

    //Recherche de taille
    $stockage->rewind(); // placement de l'itérateur au début de la structure

    while($listStockage->valid()){
        $nomStockage = $stockage->current();

        $tailleCalculer = $nomStockage->getTaille() + $objetAPlacer->getTaille();

        //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
        if ($tailleCalculer > $nomStockage->getTailleMax()) { // Non restructurable
            if ($nomStockage->getRestructurable() == true) {  // Mais taille restante suffisante
                $nomStockage = $stockageTravailler[$iterateur]; 
                $listStockage->insertValues($nomStockage); 
            }
        } 
        elseif ($nomStockage->getNom() != $nomStockage->getNom()) { // Sinon (restructurable ou non, mais taille restante déjà suffisante)
            $listStockage->insertValues($nomStockage); 
        }

        $listStockage->next();
    }

    //tri de la list
    trierList($listStockage);


    //Recherche dans tous les espaces de stockage
    for ($nomStockage=0; $nomStockage < $longueurListeStockage-1; $nomStockage++) { 
        $listStockage->next(); // A chaque itération de la boucle for, on passe à l'objet suivant de listStockage

        recherche($score, $trouver,  $nomDossierTrouver, $dossierParent, $objetAPlacer);
        //Recupération du nom de l'espace de stockage comportent la meilleur position

        if ($trouver == true) {
            $nomDossierTrouver = $listStockage->current();
        }
    }
}

debutRecherche($stockage,$fichier);


?>