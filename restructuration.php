<?php

function Restructuration($nomEspaceStockageTrouver,$dossierAPlacer){
    //Test taille
    $tailleCalculer = $nomEspaceStockageTrouver->getTaille() + $dossierAPlacer->getTaille();
    if ($nomEspaceStockageTrouver->getTailleMax() > $tailleCalculer) {
        //fonction de modification (pour plus tard)
        majFichier();
    }
    //Changement de nom si nécéssaire
    ChangementNomDossier($nomDossierTrouver,$ObjetAPlacer);
    ChangementNomFichier($nomDossierTrouver,$ObjetAPlacer);

    //Recherche nouvelle emplacement pour les fichiers
    for ($j=0; $j < $listeObject->size()-1; $j++) { 
        //Initialisation de variable
        $restructurationEnCour = true;
        $espacePlein = $nomEspaceStockageTrouver;
        $fichierAPlacer = $listeObject->first() + $j;

        meilleurEmplacement($stockage,$fichierAPlacer,$restructurationEnCour,$espacePlein);
    }
}

?>