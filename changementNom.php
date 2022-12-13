<?php

function ChangementNomDossier($nomDossierTrouver,$ObjetAPlacer){

    //Variables
    $conteur = 0;

    //Pour changer le nom d'un dossier
    while (TRUE) {
        if ($nomDossierTrouver->listeEnfantDossier[$conteur]->getNom() == $ObjetAPlacer->getNom()) {
            $ObjetAPlacer->setNom("$objetAPlacer->getNom()"+"(1)");
            break;
        }
        $conteur++;
    }

}

function ChangementNomFichier($nomDossierTrouver,$ObjetAPlacer){

    //Variables
    $conteur = 0;

    //Pour changer le nom d'un dfichier
    while (TRUE) {
        if ($nomDossierTrouver->listeEnfantFichier[$conteur]->getNom() == $ObjetAPlacer->getNom()) {
            $ObjetAPlacer->setNom("$objetAPlacer->getNom()"+"(1)");
            break;
        }
        $conteur++;
    }

}
?>