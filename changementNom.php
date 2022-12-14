<?php

include_once "baseDeDonneePhysique.php";
include_once "Fichier.php";
include_once "Dossier.php";

function ChangementNomDossier($nomDossierTrouver, $ObjetAPlacer){

    if (get_class($ObjetAPlacer) == get_class($testDossier = new Dossier("",0,""))) {
        //Variables
        $compteur=1;
        $nouveauNom = "";
        $listeEnfantDossier = $nomDossierTrouver->getListeEnfantDossier();

        //Pour changer le nom d'un dossier
        while ($listeEnfantDossier->valid()) {
            $DossierTraiter= $listeEnfantDossier->current();
            if ($DossierTraiter->getNom() == $ObjetAPlacer->getNom()) {
                $nouveauNom = $ObjetAPlacer->getNom()."(".$compteur.")";
                $ObjetAPlacer->setNom($nouveauNom);
                $compteur++;
                $listeEnfantDossier->rewind();
            }
            $listeEnfantDossier->next();
        }
    }
    if(get_class($ObjetAPlacer) == get_class($testFichier = new Fichier("",0,"",""))) {
        //Variables
        $listeEnfantFichier= $nomDossierTrouver->getListeEnfantFichier();
        $compteur=1;
        $nouveauNom = "";
    
        //Pour changer le nom d'un fichier
        while ($listeEnfantFichier->valid()) {
            $FichierTraiter = $listeEnfantFichier->current();
            if ($FichierTraiter->getNom() == $ObjetAPlacer->getNom()) {
                $nouveauNom = $ObjetAPlacer->getNom()."(".$compteur.")";
                $ObjetAPlacer->setNom($nouveauNom);
                $compteur++;
                $listeEnfantFichier->rewind();
                print($nouveauNom);
            }
            $listeEnfantFichier->next();
        }
    }
}

ChangementNomDossier($dossier4,$objetAPlacer);
echo 'fin';

?>