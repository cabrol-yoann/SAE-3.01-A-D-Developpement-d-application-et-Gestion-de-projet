<?php
include_once "../classe/Fichier.php";
include_once "../classe/Dossier.php";
include_once "baseDeDonneePhysique.php";

function Recherche(&$score, &$trouver,  &$nomDossierTrouver, $dossierParent, $objetAPlacer, $restructuration){
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du conteur
    $point = 0;
    $conteur = 0;

    // Recherche et attribution des points
    // Récupération de la liste des enfants Fichier.
    $listEnfantFichier = $dossierParent->getListeEnfantFichier();
    // Recherche pour les fichiers
    //Vérification si la liste des enfants n'est pas vide
    if (isset($listEnfantFichier)) {
        $nbEnfant = $dossierParent->getListeEnfantFichier()->count();
        while ($listEnfantFichier->valid()) {
            echo 'recherche de '.$objetAPlacer->getNom().' dans '.$listEnfantFichier->current()->getNom();echo '<br>';
            // Recherche à partir du Tag
            if($objetAPlacer->getMesTags()->valid() && $listEnfantFichier->current()->getMesTags()->valid()) {
                $listTag = $objetAPlacer->getMesTags();
                $listTagEnfant = $listEnfantFichier->current()->getMesTags();
                while ($listTag->valid()) {
                    if ($listTag->current() == $listTagEnfant->current()) {
                        $point++;
                        echo "Tag trouvé";echo '<br>';
                    }
                    $listTag->next();
                    $listTagEnfant->next();
                }
            }
            // Recherche à partir du type
            if ($listEnfantFichier->current()->getType() == $objetAPlacer->getType()) {
                $conteur++;
            }
            if ($conteur == $nbEnfant) {
                $point++;
                echo "Type trouvé";echo '<br>';
            }
            // Recherche à partir du nom
            if ($listEnfantFichier->current()->getNom() == $objetAPlacer->getNom()) {
                $point++;
                echo "Nom trouvé";echo '<br>';
            }
            $listEnfantFichier->next();
        }
    }
    // Récupération de la liste des enfants Dossier 
    $listEnfantDossier = $dossierParent->getListeEnfantDossier();
    //Recherche pour les dossiers
    if (isset($listEnfantDossier)) {
        $nbEnfant = $listEnfantDossier->count();
        while ($listEnfantDossier->valid()) { 
            //Recherche du tag
            if($objetAPlacer->getMesTags()->valid() && $listEnfantDossier->current()->getMesTags()->valid()) {
                $listTag = $objetAPlacer->getMesTags();
                $listTagEnfant = $listEnfantDossier->current()->getMesTags();
                while ($listTag->valid()) {
                    if ($listTag->current() == $listTagEnfant->current()) {
                        $point++;
                        echo "Tag trouvé";echo '<br>';

                    }
                    $listTag->next();
                    $listTagEnfant->next();
                }
            }
            if ($listEnfantDossier->current()->getNom() == $objetAPlacer->getNom()) {
                $point++;
                echo "Nom trouvé";echo '<br>';
            }
            $listEnfantDossier->next();
        }
    }

    //Enregistrement des points si le score est égale à 0 ou si aucun fichier ou dossier n'a était trouver
    if ($score == 0) {
        $score = $point;
    }

    //Enregistrement de valeur trouver
    if ($point >= $score) {
        $score = $point;
        $nomDossierTrouver = $dossierParent;
        $trouver = true ;
    }

    //Regarde les enfants
    $listEnfantDossier->rewind();
    if (isset($listEnfantDossier)) {
        while ($listEnfantDossier->valid()) {
            $dossierParent = $listEnfantDossier->current();
            Recherche($score, $trouver,  $nomDossierTrouver, $dossierParent, $objetAPlacer, $restructuration);
            $listEnfantDossier->next();
        }
    }
}
?>