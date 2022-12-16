<?php

include_once "baseDeDonneePhysique.php";
include_once "Dossier.php";
include_once "Fichier.php";

function trierList($ObjectStockage){

    //Initialisation des variables
    $petit = new Dossier("",-1,"");
    print_r($ObjectStockage);
        while ($ObjectStockage->valid()) {
            print_r($ObjectStockage->current()->getNom());echo '<br>';
            print_r($ObjectStockage->current()->getTaille());
            $ObjectStockage->next();
        }
        echo '<br>';echo '<br>';
        $ObjectStockage->rewind();
        $petit->setNom($ObjectStockage->current()->getNom());
        $petit->setTaille($ObjectStockage->current()->getTaille());
        $petit->setChemin($ObjectStockage->current()->getChemin());
        echo'1<br>';echo '<br>';
    //Trie
    for ($foyer=0; $foyer < $ObjectStockage->count()-1; $foyer++) { 
        //Recherche de la valeur la plus petite
        for ($pivot=0; $pivot < $ObjectStockage->count()-1; $pivot++) { 
            print_r($ObjectStockage->current()->getNom());echo '<br>';
            print_r($ObjectStockage->current()->getTaille());echo '<br>';
            print_r($petit->getTaille());echo '<br>';
            echo'2<br>';echo '<br>';

            //Test de la valeur la plus petite de la liste
            print_r($ObjectStockage->current()->getTaille()); echo '<br>';
            print_r($petit->getTaille());
            if ($ObjectStockage->current()->getTaille() < $petit->getTaille()) {
                echo'3<br>';
                $petit->setNom($ObjectStockage->current()->getNom());
                $petit->setTaille($ObjectStockage->current()->getTaille());
                $petit->setChemin($ObjectStockage->current()->getChemin());
                print_r($ObjectStockage->current()->getNom());
                print_r($ObjectStockage->current()->getTaille());echo '<br>';
                print_r($petit->getTaille());echo '<br>';
                echo'4<br>';
            }
        
            //Test fin de liste
            if ($ObjectStockage->valid()) {
                break;
            }
            $ObjectStockage->next();
        }

        //Remplacement des données
        
        $echange = $ObjectStockage->current();
        $ObjectStockage->detach($ObjectStockage);
        $ObjectStockage->attach($petit);
        $petit = $echange;echo '<br>';echo '<br>';

    }
    $ObjectStockage->rewind();
    while ($ObjectStockage->valid()) {
        print_r($ObjectStockage->current()->getNom());echo '<br>';
        print_r($ObjectStockage->current()->getTaille());
        $ObjectStockage->next();
        echo '<br>';
    }
}
trierList($listTest);
echo '<br> fin';
?> 