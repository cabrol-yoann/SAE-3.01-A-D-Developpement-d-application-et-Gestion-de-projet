<?php
/**
 * @file restructuration.php
 * @author Cabrol Yoann
 * @details Fonction permettant de restructurer un dossier
 * @version 2.0
 */

include_once 'rechercheDossierARestructurer.php';

/**
 * @brief Fonction permettant de restructurer un dossier
 * @param Stockage $nomEspaceStockageTrouver Espace de stockage dans lequel on va restructurer
 * @param Fichier $ObjetAPlacer Objet à placer
 * @param Dossier $nomDossierTrouver Dossier dans lequel on va restructurer
 * @param SplObjectStorage $Stockage liste des Stockage dans lequel on va restructurer 
 * @param bool $restructuration Booléen pour savoir si on est en cour de restructuration
 * @return void
 */
function Restructuration($nomEspaceStockageTrouver,$ObjetAPlacer,$nomDossierTrouver,$Stockage,$restructuration){
    /**
     * @var int $tailleCalculer Taille du dossier calculé apres ajout de l'$ObjetAPlacer
     * @var bool $trouver Booléen pour savoir si on a trouvé un dossier à restructurer
     * @var int $somme Somme des tailles des fichiers
     * @var SplObjectStorage $listeFichierARestructurer Liste des fichiers à restructurer 
     */
    //Test taille
    $tailleCalculer = $nomEspaceStockageTrouver->getTaille() + $ObjetAPlacer->getTaille();
    echo $tailleCalculer ;echo ' taille calculer';echo '<br>';
    echo $nomEspaceStockageTrouver->getTailleMax() ;echo ' taille max';echo '<br>';
    if ($nomEspaceStockageTrouver->getTailleMax() > $tailleCalculer) {
        //Ajout du dossier dans le dossier
        echo 'Ajout du dossier '.$ObjetAPlacer->getNom().' dans le dossier '.$nomDossierTrouver->getNom().' dans l\'espace '.$nomEspaceStockageTrouver->getNom();echo '<br>';
        $nomDossierTrouver->ajouterEnfantFichier($ObjetAPlacer);
        return;
    }
    if ($restructuration == true) {
        echo 'Restructuration impossible';echo '<br>';
        exit();
    }
    //Changement de nom si nécéssaire
    ChangementNomDossier($nomDossierTrouver, $ObjetAPlacer);
    //recherche fichier à restructurer
    $trouver = false;
    $somme = 0;
    $listeFichierARestructurer = new \SplObjectStorage();

    $Stockage->rewind();
    while($Stockage->valid()) {
        if ($Stockage->current()->getNom() != $nomEspaceStockageTrouver->getNom()) {
            RechercheDossierARestructurer($somme,$Stockage->current()->getMaRacine(),$listeFichierARestructurer,$trouver,$ObjetAPlacer);
        }
        $Stockage->next();
    }

    //Recherche nouvelle emplacement pour les fichiers
    while ($listeFichierARestructurer->valid()) { 
        //Initialisation de variable
        $restructurationEnCour = true;
        echo 'Restructuration en cour de '.$listeFichierARestructurer->current()->getNom().' dans '.$nomEspaceStockageTrouver->getNom().' <br>';
        //Recherche de l'espace de stockage pour le fichier en cour de restructuration
        //DebutRecherche est une fonction récursive qui prend en paramètre l'espace de stockage, le fichier à restructurer, un booléen pour savoir si on a trouver un espace de stockage et le nom de l'espace de stockage trouver
        DebutRecherche($Stockage,$listeFichierARestructurer->current(),$nomEspaceStockageTrouver,$nomDossierTrouver,$restructurationEnCour);
        $listeFichierARestructurer->next();
    }
}

?>