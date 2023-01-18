<?php
/**
 * @file trierList.php
 * @author Da Silva Eduardo, Cabrol Yoann
 * @brief fichier contenant la fonction trierList
 * @detais Fonction permettant de trier une liste d'objet
 * @version 2.0
 */
include_once "baseDeDonneePhysique.php";
include_once "../classe/Dossier.php";

/**
 * @brief Fonction permettant de trier une liste d'objet
 * @param SplObjectStorage &$ObjectStockage liste d'objet à trier
 * @return void
 */
function trierList(&$ObjectStockage){
    //Initialisation des variables
    /**
     * @var Stockage $petit Objet le plus petit de la liste
     * @var Stockage $sauvegarde Objet en cours de comparaison
     * @var int $key clé de l'objet le plus petit
     * @var int $foyer variable d'échange (pointeur)
     * @var int $pivot variable d'échange (tampon, pointeur)
     * @var bool $modifier savoir si on a modifier la liste
     * @var int $i itérateur de la boucle for
     */
    $petit = new Stockage("petit","","",true);
    $sauvegarde = new Stockage("sauvegarde","","",true);
    $key=0;  

    //Trie
    for ($foyer = 0; $foyer < $ObjectStockage->count()-1; $foyer++) { 
        //retour au début de la liste pour chaque foyer
        $ObjectStockage->rewind();
        $modifier=false;
        //Initialisation de la variable de comparaison
        for($i=0; $i != $foyer; $i++){
            $ObjectStockage->next();
        }
        // enregistrement du premier objet
        $petit->clone($ObjectStockage->current());
        //sauvegarde de l'objet en cours de comparaison
        $sauvegarde->clone($ObjectStockage->current());
        
        //Recherche de la valeur la plus petite de la liste
        for ($pivot=0; $pivot < $ObjectStockage->count()-$foyer; $pivot++) { 
            //Test de la valeur la plus petite de la liste
            if ($ObjectStockage->current()->getTaille() < $petit->getTaille()) {
                //sauvegarde de l'objet le plus petit
                $petit->clone($ObjectStockage->current());
                //recuperation de la clé de l'objet le plus petit
                $key=$ObjectStockage->key();
                // validation de la possibilité de modification
                $modifier=true;
            }
            //passage à l'objet suivant
            $ObjectStockage->next();
        }
        //remplacement de l'objet le plus petit par l'objet en cours de comparaison
        if ($modifier == true) {
            $ObjectStockage->rewind();
            while ($ObjectStockage->key() < $key) { 
                $ObjectStockage->next();
            }
            // sauvegarde de l'objet en cours de comparaison
            $ObjectStockage->current()->clone($sauvegarde);
            // retour au foyer de comparaison
            $ObjectStockage->rewind();
            for($i=0; $i != $foyer; $i++){
                $ObjectStockage->next();
            }
            //remplacement de l'objet en cours de comparaison par l'objet le plus petit
            $ObjectStockage->current()->clone($petit);

            $key=0;
        } 
    }
}