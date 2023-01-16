<?php

include_once "trierList.php";
include_once "recherche.php";



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

    while($stockage->valid()){
        $nomStockage = $stockage->current();

        $tailleCalculer = $nomStockage->getTaille() + $objetAPlacer->getTaille();

        //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
        if ($tailleCalculer > $nomStockage->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
            if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                if($objetAPlacer->getTaille() < $nomStockage->getTaille()){   // Et que le poids du fichier < taille totale du stockage
                    $listStockage->attach($nomStockage); 
                    echo "Dossier dans lequel on peut stocker (avec restructuration) : ".$nomStockage->getNom()."<br>";
                }
            }
        }  
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
            $listStockage->attach($nomStockage); 
            echo "Dossier dans lequel on peut stocker (sans restructuration) :".$nomStockage->getNom()."  <br>";
        }
    
        $stockage->next();
    }

    //tri de la list
    trierList($listStockage);


    //Recherche dans tous les espaces de stockage
    $listStockage -> rewind();

    while($listStockage->valid()) { 


        recherche($score, $trouver, $nomDossierTrouver, $listStockage->current()->getMaRacine(), $objetAPlacer);
        //Recupération du nom de l'espace de stockage comportent la meilleur position

        if ($trouver == true) {
            $nomDossierTrouver = $listStockage->current();
            echo "trouvé".$nomDossierTrouver->getNom();
        }
    
        $listStockage->next(); // A chaque itération de la boucle for, on passe à l'objet suivant de listStockage
    }
}




?>