<?php

function RechercheDossierARestructurer(&$somme,$dossierParent,&$listeFichierARestructurer,&$trouver,$objetAPlacer){
    $listeEnfantFichier = $dossierParent->getListeEnfantFichier();
    $listeEnfantFichier->rewind();
    if ($trouver == true) {
        //Fin procedure
        return;
    }
    elseif ($listeEnfantFichier->valid()) {
        //Debut de la recherche
        $listeEnfantFichier->rewind();
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
    $listeEnfantDossier->rewind();
    while ($listeEnfantDossier->valid()) { 
        RechercheDossierARestructurer($somme,$listeEnfantDossier->current(),$listeFichierARestructurer,$trouver,$objetAPlacer);
        $listeEnfantDossier->next();
    }
}
?>