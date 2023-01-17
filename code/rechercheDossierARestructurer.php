<?php

function RechercheDossierARestructurer(&$somme,$dossierParent,&$listeFichierARestructurer,&$trouver,$objetAPlacer){
    if ($trouver == true) {
        //Fin procedure
        return;
    }
    elseif ($dossierParent->getListeEnfantFichier()->valid()) {
        //Debut de la recherche
        $listeEnfantFichier = $dossierParent->getListeEnfantFichier();
        while ($listeEnfantFichier->valid()) { 
            $somme = $somme + $listeEnfantFichier->current()->getTaille();
            $listeFichierARestructurer->attach($listeEnfantFichier->current());
            
            //Test si on a trouver tout nos fichier
            if ($somme > $objetAPlacer->getTaille()) {
                $trouver = true;
                break;
            }
            $listeEnfantFichier->next();
        }
    }
    //Recherche avec les enfants
    $listeEnfantDossier = $dossierParent->getListeEnfantDossier();
    while ($listeEnfantDossier->valid()) { 
        RechercheDossierARestructurer($somme,$listeEnfantDossier->current(),$listeFichierARestructurer,$trouver,$objetAPlacer);
        $listeEnfantDossier->next();
    }
}
?>