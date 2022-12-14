<?php

include_once "baseDeDonneePhysique.php";
include_once "Dossier.php";
include_once "Fichier.php";

function trierList($ObjectStockage){

    var_dump($ObjectStockage);
    //Initialisation des variables
    $petit = new Dossier("",-1,);

    //Trie
    for ($foyer=0; $foyer < $ObjectStockage->count()-1; $foyer++) { 
        //Recherche de la valeur la plus petite
        for ($pivot=0; $pivot < $ObjectStockage->count()-1; $pivot++) { 
            

            //Test de la valeur la plus petite de la liste
            if ($ObjectStockage->current()->getTaille() < $petit->getTaille()) {
                $petit = $ObjectStockage->current();
            }

            //Test fin de liste
            if ($ObjectStockage->valid()) {
                break;
            }
        }

        //Mise a jour des variables
        $incrementeur = $ObjectStockage->first() + $foyer;
        $petit = $incrementeur;

        //Remplacement des données
        $ObjectStockage->swap($incrementeur,$petit);
    }
}
trierList($listTest);
echo 'fin';
?>