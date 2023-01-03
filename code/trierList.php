<?php

include_once "baseDeDonneePhysique.php";
include_once "../classe/Dossier.php";


function trierList(&$ObjectStockage){
    //Initialisation des variables
    $petit = new Dossier("petit",0,"");
    $sauvegarde = new Dossier("sauvegarde",0,"");
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
        $petit->setTaille($ObjectStockage->current()->getTaille());
        $petit->setNom($ObjectStockage->current()->getNom());
        $petit->setChemin($ObjectStockage->current()->getChemin());
        //sauvegarde de l'objet en cours de comparaison
        $sauvegarde->setTaille($ObjectStockage->current()->getTaille());
        $sauvegarde->setNom($ObjectStockage->current()->getNom());
        $sauvegarde->setChemin($ObjectStockage->current()->getChemin());
        
        //Recherche de la valeur la plus petite de la liste
        for ($pivot=0; $pivot < $ObjectStockage->count()-$foyer; $pivot++) { 
            //Test de la valeur la plus petite de la liste
            if ($ObjectStockage->current()->getTaille() < $petit->getTaille()) {
                //sauvegarde de l'objet le plus petit
                $petit->setTaille($ObjectStockage->current()->getTaille());
                $petit->setNom($ObjectStockage->current()->getNom());
                $petit->setChemin($ObjectStockage->current()->getChemin());
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
            $ObjectStockage->current()->setNom($sauvegarde->getNom());
            $ObjectStockage->current()->setTaille($sauvegarde->getTaille());
            $ObjectStockage->current()->setChemin($sauvegarde->getChemin());
            // retour au foyer de comparaison
            $ObjectStockage->rewind();
            for($i=0; $i != $foyer; $i++){
                $ObjectStockage->next();
            }
            //remplacement de l'objet en cours de comparaison par l'objet le plus petit
            $ObjectStockage->current()->setNom($petit->getNom());
            $ObjectStockage->current()->setTaille($petit->getTaille());
            $ObjectStockage->current()->setChemin($petit->getChemin());

            $key=0;
        } 
    }
}