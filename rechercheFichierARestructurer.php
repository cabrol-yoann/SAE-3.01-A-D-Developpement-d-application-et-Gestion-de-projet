<?php

function RechercheFichierARestructurer($somme,$dossierParent,$listeObject,$trouver,$objectAPlacer){

    if ($trouver == true) {
        //Fin procedure
        return;
    }elseif ($dossier->getListeEnfantFichier()!= NULL) {
        //Debut de la recherche 
        $nbEnfant = sizeof($dossierParent.getListeEnfantFichier());

        for ($enfant=0; $enfant < $nbEnfant-1; $enfant++) { 
            $somme = $somme + $dossierParent->getListeEnfantFichier()[$enfant]->getTaille();
            
            //Test si on a trouver tout nos fichier
            if ($somme > $objectAPlacer->getTaille()) {
                $trouver = true;
                break;
            }
        }

        //Initialisation du/des fichier(s) a restructurer et mise a jour du pointeur
        $listeObject = insertValue($dossierParent->getListeEnfantFichier()[$enfant]);
        $dossierParent->supprimerEnfant($enfant);

        //Recherche avec les enfants
        RechercheFichierARestructurer($somme,$dossierParent,$listeObject,$trouver,$objectAPlacer);
    }
}

?>