<?php

include_once "trierList.php";
include_once "recherche.php";



function debutRecherche ($stockage, $objetAPlacer, &$nomEspaceTrouver, &$nomDossierTrouver, $restructuration){

//Meilleur Emplacement
    //initialisation
    $score = 0;
    if (!isset($nomDossierTrouver))
        $nomDossierTrouver = "";
    $listStockage = new \SplObjectStorage();
    $trouver = false;
    $tailleCalculer = 0;

    //Recherche de taille
    $stockage->rewind(); // placement de l'itérateur au début de la structure
    
    while($stockage->valid()){
        $nomStockage = $stockage->current();
        $tailleCalculer = $nomStockage->getTaille() + $objetAPlacer->getTaille();
        //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
        if ($tailleCalculer > $nomStockage->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
            if ($restructuration == false) {                                // Si on n'est pas en face de restructuration
                if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                    $listStockage->attach($nomStockage);
                }
            }
            elseif($restructuration == true && $nomStockage != $nomDossierTrouver) {    // Si on est en face de restructuration et que le stockage n'est pas celui du dossier à restructurer
                if ($nomStockage->getRestructurable() == true) {                        // Et restructurable (donc peut potentiellement être intégré)
                    $listStockage->attach($nomStockage);
                }
            }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
            $listStockage->attach($nomStockage);
        }

        $stockage->next();
    }
    if (!$listStockage->valid()) {
        echo 'le fichier ne peut pas être stocké dans aucun espace de stockage';
        exit();
    }

    //tri de la list
    trierList($listStockage);

    //Recherche dans tous les espaces de stockage
    $listStockage -> rewind();
    while($listStockage->valid()) { 
        echo $objetAPlacer->getNom() . ' recherche dans ' . $listStockage->current()->getNom() . ' ';echo '<br>';
        recherche($score, $trouver, $nomDossierTrouver, $listStockage->current()->getMaRacine(), $objetAPlacer, $restructuration);
        //Recupération du nom de l'espace de stockage comportent la meilleur position
        if ($trouver == true) {
            $nomEspaceTrouver = $listStockage->current();
        }
    
        $listStockage->next(); // A chaque itération de la boucle for, on passe à l'objet suivant de listStockage
    }

    Restructuration($nomEspaceTrouver,$objetAPlacer,$nomDossierTrouver,$stockage,$restructuration);
}




?>