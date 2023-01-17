<?php

include_once "trierList.php";
include_once "recherche.php";



function debutRecherche ($stockage, $objetAPlacer, &$nomEspaceTrouver, &$nomDossierTrouver, $restructuration){

//Meilleur Emplacement
    //initialisation
    $score = 0;
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
            echo $tailleCalculer.$nomStockage->getNom(); echo '<br><br><br>';
            if ($restructuration == false) {
                if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                    if($objetAPlacer->getTaille() < $nomStockage->getTaille()){   // Et que le poids du fichier < taille totale du stockage
                        $listStockage->attach($nomStockage);
                    }
                }
            }
            elseif ($nomStockage->getNom() == $nomEspaceTrouver->getNom()) { // Si on est en mode restructuration
                echo $nomStockage->getNom(). $nomEspaceTrouver->getNom();
                if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                    if($objetAPlacer->getTaille() < $nomStockage->getTaille()){   // Et que le poids du fichier < taille totale du stockage
                        $listStockage->attach($nomStockage);
                    }
                }
            }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
            $listStockage->attach($nomStockage);
        }

        $stockage->next();
    }
    //tri de la list
    trierList($listStockage);

    //Recherche dans tous les espaces de stockage
    $listStockage -> rewind();
    while($listStockage->valid()) { 
        recherche($score, $trouver, $nomDossierTrouver, $listStockage->current()->getMaRacine(), $objetAPlacer, $restructuration);
        //Recupération du nom de l'espace de stockage comportent la meilleur position
        if ($trouver == true) {
            $nomEspaceTrouver = $listStockage->current();
        }
    
        $listStockage->next(); // A chaque itération de la boucle for, on passe à l'objet suivant de listStockage
    }
}




?>