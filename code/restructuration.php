<?php

include_once 'rechercheDossierARestructurer.php';

function Restructuration($nomEspaceStockageTrouver,$ObjetAPlacer,$nomDossierTrouver,$Stockage){
    //Test taille
    $tailleCalculer = $nomEspaceStockageTrouver->getTaille() + $ObjetAPlacer->getTaille();
    if ($nomEspaceStockageTrouver->getTailleMax() > $tailleCalculer) {
        //Ajout du dossier dans le dossier
        $nomDossierTrouver->ajFichier($ObjetAPlacer);
        //Ajout du dossier dans l'espace de stockage
        $nomEspaceStockageTrouver->ajFichier($ObjetAPlacer);
        //Suppression du dossier dans la liste
    }
    //Changement de nom si nécéssaire
    ChangementNomDossier($nomDossierTrouver, $ObjetAPlacer);

    //recherche fichier à restructurer
    $trouver = false;
    $somme = 0;
    $listeFichierARestructurer = new \SplObjectStorage();

    while($Stockage->valid()) {
        if ($Stockage->current()->getNom() != $nomEspaceStockageTrouver->getNom()) {
            RechercheDossierARestructurer($somme,$Stockage->current()->getMaRacine(),$listeFichierARestructurer,$trouver,$ObjetAPlacer);
        }
        $Stockage->next();
    }
    print_r($listeFichierARestructurer); echo '<br>';

    //Recherche nouvelle emplacement pour les fichiers
    while ($listeFichierARestructurer->valid()) { 
        //Initialisation de variable
        //$restructurationEnCour = true;
        echo 'Restructuration en cour de '.$listeFichierARestructurer->current()->getNom().' dans '.$nomEspaceStockageTrouver->getNom().' <br>';
        //Recherche de l'espace de stockage pour le fichier en cours de restructuration
        //DebutRecherche est une fonction récursive qui prend en paramètre l'espace de stockage, le fichier à restructurer, un booléen pour savoir si on a trouver un espace de stockage et le nom de l'espace de stockage trouver
        //DebutRecherche($Stockage,$listeFichierARestructurer->current(),$restructurationEnCour,$nomEspaceStockageTrouver);
        $listeFichierARestructurer->next();
    }
}

?>