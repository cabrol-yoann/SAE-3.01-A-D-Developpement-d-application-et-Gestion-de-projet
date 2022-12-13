<?php
function Recherche($score, $trouver,  $nomDossierTrouver, $dossierParent, $objetAPlacer){
    //Parcour puis recherche
        //initialisation des points
        $point = 0;

        //Recherche et attribution des points
            //Recherche pour les fichiers
            if ($dossierParent->getListeEnfantFichier() != NULL) {
                $nbEnfant = sizeof($dossierParent->getListeEnfantFichier());
                for ($enfantFichier=0; $enfantFichier < $nbEnfant-1; $enfantFichier++) { 
                    //Recherche Tag
                    if ($dossierParent->getlisteEnfantFichier[$enfantFichier]->getTag() == $objectAPlacer->getTag()) {
                        $point++;
                    }
                    //Recherche du type
                    if ($dossierParent->getlisteEnfantFichier[$enfantFichier]->getType() == $objectAPlacer->getType()) {
                        $conteur++;
                    }
                    if ($conteur == $nbEnfant) {
                        $point++;
                    }
                    //recherche du nom
                    if ($dossierParent->getlisteEnfantFichier[$enfantFichier]->getNom() == $objectAPlacer->getNom()) {
                        $point++;
                    }
                }
            }
            //Recherche pour les dossiers
            if ($dossierParent->getListeEnfantDossier() != NULL) {
                $nbEnfant = sizeof($dossierParent->getListeEnfantDossier());
                for ($enfantDossier=0; $enfantDossier < $nbEnfant-1; $enfantDossier++) { 
                    //Recherche du tag
                    if ($dossierParent->getlisteEnfantFichier[$enfantDossier].getTag() == $objectAPlacer->getTag()) {
                        $point++;
                    }
                    if ($dossierParent->getlisteEnfantFichier[$enfantDossier].getNom() == $objectAPlacer->getNom()) {
                        $point++;
                    }
                }
            }

        //Enregistre les points si score est egale à 0 ou si aucun fichier ou dossier a était trouver
        if ($score == 0) {
            $score = $point;
        }

        //Enregistrement de valeur trouver
        if ($points > $score) {
            $score = $point;
            $nomDossierTrouver = $dossierParent.getNom();
            $trouver = true ;
        }

        //Regarde les enfants
        for ($enfantDossier=0; $enfantDossier < $nbEnfant-1; $enfantDossier++) { 
            Recherche($score, $trouver,  $nomDossierTrouver, $dossierParent, $objetAPlacer);
        }
}
?>