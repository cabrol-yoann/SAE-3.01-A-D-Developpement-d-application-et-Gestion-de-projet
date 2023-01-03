<?php

function RechercheDossierARestructurer($somme,$dossierParent,$listeObject,$trouver,$objetAPlacer){

    if ($trouver == true) {
        //Fin procedure
        return;
    }elseif ($dossierParent->getListeEnfantFichier()!= NULL) {
        //Debut de la recherche 
        $nbEnfant = sizeof($dossierParent->getListeEnfantFichier());

        for ($enfant=0; $enfant < $nbEnfant-1; $enfant++) { 
            $somme = $somme + $dossierParent->getListeEnfantFichier()[$enfant]->getTaille();
            
            //Test si on a trouver tout nos fichier
            if ($somme > $objectAPlacer->getTaille()) {
                $trouver = true;
                break;
            }
        }

        //Initialisation du/des fichier(s) a restructurer et mise a jour du pointeur
        $listeObject->attach($dossierParent->getListeEnfantFichier()[$enfant]);
        $dossierParent->supprimerEnfant($enfant);

        //Recherche avec les enfants
        RechercheDossierARestructurer($somme,$dossierParent,$listeObject,$trouver,$objetAPlacer);
    }
}



RechercheDossierARestructurer(0,$dossier1, ,false,$objetAPlacer);
?>