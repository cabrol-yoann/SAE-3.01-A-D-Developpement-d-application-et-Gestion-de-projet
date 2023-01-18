<?php
/**
 * @file dossierARestructurer.php
 * @author Cabrol Yoann
 * @details Fonction permettant de restructurer un dossier
 * @version 1.0
 */

/**
 * @brief Fonction permettant de rechercher un dossier à restructurer
 * @param int $somme Somme des tailles des fichiers
 * @param Dossier $dossierParent dans lequel on va restructurer
 * @param SplObjectStorage $listeFichierARestructurer Liste des fichiers à restructurer
 * @param bool $trouver pour savoir si on a trouver tout nos fichier
 * @param Fichier $objetAPlacer Objet à placer
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