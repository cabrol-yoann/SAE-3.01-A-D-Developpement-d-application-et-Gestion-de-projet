<?php
function trierList($ObjectStockage){

    //Declaration variable
    $incrementeur;

    //Initialisation des variables
    $incrementeur = $ObjectStockage->first();
    $petit = $incrementeur;

    //Trie
    for ($foyer=0; $foyer < $listeStockage->size()-1; $foyer++) { 
        //Recherche de la valeur la plus petite
        for ($pivot=0; $pivot < $listeStockage->size()-1; $pivot++) { 
            $incrementeur++;

            //Test de la valeur la plus petite de la liste
            if ($incrementeur->getTaille() < $petit->getTaille()) {
                $petit = $incrementeur;
            }

            //Test fin de liste
            if ($incrementeur == $ObjectStockage->end()) {
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

?>