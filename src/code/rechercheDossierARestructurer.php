<?php
/**
 * @file dossierARestructurer.php
 * @author Cabrol Yoann
 * @details Fonction permettant de restructurer un dossier
 * @version 1.0
 */

/**
 * @brief Fonction permettant de restructurer un dossier
 * @param $somme (entier) Somme des tailles des fichiers
 * @param $dossierParent (objet de type Dossier) dans lequel on va restructurer
 * @param $listeFichierARestructurer (objet de type splObjectStorage)Liste des fichiers à restructurer
 * @param $trouver (booléen) pour savoir si on a trouver tout nos fichier
 * @param $objetAPlacer (objet de type Fichier) Objet à placer
 * @return void
*/
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