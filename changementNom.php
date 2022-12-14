<?php

function ChangementNomDossier($nomDossierTrouver,$ObjetAPlacer){

    include_once "Fichier.php";
    include_once "Dossier.php";
    include_once "baseDeDonnéePhysique.php";

    //Variables
    $listeEnfantDossier = $nomDossierTrouver->getListeEnfantDossier();
    $conteur=1;
    $nouveauNom = "";
    $testDossier = new Dossier("",0,"");
    print_r($objetAPlacer);

    if (get_class($objetAPlacer) == get_class($testDossier)) {
        //Pour changer le nom d'un dossier
        while ($listeEnfantDossier->valid()) {
            $DossierTraiter= $listeEnfantDossier->current();
            if ($DossierTraiter->getNom() == $ObjetAPlacer->getNom()) {
                $nouveauNom = $objetAPlacer->getNom()."(".$conteur.")";
                $ObjetAPlacer->setNom($nouveauNom);
                $conteur++;
                echo 'entre <br>';
            }
            $listeEnfantDossier->next();
        }
    }
    if(get_class($objetAPlacer) == get_class($testFichier = new Fichier("",0,"",""))) {
        //Variables
        $listeEnfantFichier= $nomDossierTrouver->getListeEnfantFichier();
        $conteur=1;
        $nouveauNom = "";
    
        //Pour changer le nom d'un dfichier
        while (TRUE) {
            if ($nomDossierTrouver->listeEnfantFichier[$conteur]->getNom() == $ObjetAPlacer->getNom()) {
                $nouveauNom = $objetAPlacer->getNom()."(".$conteur.")";
                $ObjetAPlacer->setNom($nouveauNom);
                $conteur++;
            }
            $listeEnfantFichier->next();
        }
    }
}


include_once "baseDeDonnéePhysique.php";
ChangementNomDossier($dossier4,$objetAPlacer);
echo 'fin';

?>