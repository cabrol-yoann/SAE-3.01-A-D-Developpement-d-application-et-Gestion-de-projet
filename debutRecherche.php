<?php

function debutRecherche ($stockage, $objetAPlacer){
//Meilleur Emplacement
    //initialisation
    $score = 0;
    $nomDossierTrouver = "";
    $listStockage = array("","","","");
    $trouver = false;
    $tailleCalculer = 0;

    //Recherche de taille
    for ($nomStockage=$stockage->first(); $nomStockage < $stockage->end(); $nomStockage++) { 
        //Calcul de la taille de l'espace de stockage avec le dossier à placer
        $tailleCalculer = $nomStockage->getTaille() + $objetAPlacer->getTaille();

        //On regarde si on peut stocker le dossier dans un espace puis enregistre la valeur dans une liste
        if ($tailleCalculer > $nomStockage->getTailleMax()) {
            $restructurationEnCour = false;
            if ($nomStockage->getRestructurable() == true) {
                $nomStockage = $stockageTravailler[$iterateur];
            }
        } elseif ($nomStockage->getNom() != $espacePlein->getNom()) {
            $listStockage->insertValues($nomStockage); 
        }
    }

    //tri de la list
    trierList($listStockage);


    //Recherche dans tous les espaces de stockage
    for ($nomStockage=0; $nomStockage < $longueurListeStockage-1; $nomStockage++) { 
        $trouver = false;
        Recherche($score, $trouver,  $nomDossierTrouver, $dossierParent, $objetAPlacer);
        //Recupération du nom de l'espace de stockage comportent la meilleur position
        if ($trouver == true) {
            $nomEspaceStockageTrouver = $stockage[$nomStockage];
        }
    }
}
?>