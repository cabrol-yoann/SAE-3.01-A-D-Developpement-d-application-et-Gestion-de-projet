<?php
include_once "baseDeDonneePhysique.php";
include_once "changementNom.php";

function Restructuration($nomEspaceStockageTrouver,$objetAPlacer,$dossierTrouver){
    //Test taille
    $tailleCalculer = $nomEspaceStockageTrouver->getTaille() + $objetAPlacer->getTaille();
    if ($nomEspaceStockageTrouver->getTailleMax() > $tailleCalculer) {
        //fonction de modification (pour plus tard)
        majFichier($dossierTrouver, $objetAPlacer);
    }
    //Changement de nom si nécéssaire
    $objetAPlacer->setChemin($dossierTrouver->getNom+= '/'. $objetAPlacer->getNom());
    $dossierTrouver->ajouterEnfantFichier($objetAPlacer);
    //ChangementNomFichier($nomDossierTrouver,$ObjetAPlacer);

    //Recherche nouvelle emplacement pour les fichiers
    while ($dossierAPlacer->getListeEnfantFichier()->valid()){ 
        //Initialisation de variable
        $restructurationEnCour = true;
        $espacePlein = $nomEspaceStockageTrouver;

        //stockage vien de debut recherhce la liste des espace de stockage qui sont compatible avec l'object a placer
        debutRecherche($stockage,$dossierAPlacer->getListeEnfantFichier()->current(),$restructurationEnCour,$espacePlein);

        $dossierAPlacer->getListeEnfantFichier()->next();
    }
}

?>