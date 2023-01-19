<?php
/**
 * @file recherche.php
 * @author Cabrol Yoann
 * @details Fonction permettant de restructurer un dossier
 * @version 2.0
 */
include_once "../classe/Fichier.php";
include_once "../classe/Dossier.php";
include_once "baseDeDonneePhysique.php";


/**
 * @brief Fonction permettant de rechercher le meilleur emplacement du fichier à ajouter dans des dossier passés en paramètres
 * @param int $somme Somme des tailles des fichiers
 * @param Dossier $dossierParent dans lequel on va restructurer
 * @param SplObjectStorage $listeFichierARestructure Liste des fichiers à restructurer
 * @param bool $trouver pour savoir si on a trouver tout nos fichier
 * @param Fichier $objetAPlacer Objet à placer
 * @return void
 */

function Recherche(&$score, &$trouver,  &$nomDossierTrouver, $dossierParent, $objetAPlacer, $restructuration){
    echo 'recherche d\'un emplacement '.$objetAPlacer->getNom().' dans le dossier '.$dossierParent->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;
    $compteur = 0;

    // Recherche et attribution des points
    // Récupération de la liste des enfants Fichier.
    $listEnfantFichier = $dossierParent->getListeEnfantFichier();
    // Recherche pour les fichiers
    //Vérification si la liste des enfants n'est pas vide
    if (isset($listEnfantFichier)) {
        $nbEnfant = $dossierParent->getListeEnfantFichier()->count();
        $listEnfantFichier->rewind();
        while ($listEnfantFichier->valid()) {
            echo 'recherche d\'un emplacement '.$objetAPlacer->getNom().' en le comparent avec le fichier '.$listEnfantFichier->current()->getNom();echo '<br>';
            // Recherche à partir du Tag
            if($objetAPlacer->getMesTags()->valid() && $listEnfantFichier->current()->getMesTags()->valid()) {
                $listTag = $objetAPlacer->getMesTags();
                $listTagEnfant = $listEnfantFichier->current()->getMesTags();
                while ($listTag->valid()) {
                    if ($listTag->current() == $listTagEnfant->current()) {
                        $point++;
                        echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
                    }
                    $listTag->next();
                    $listTagEnfant->next();
                }
            }
            // Recherche à partir du type
            if ($listEnfantFichier->current()->getType() == $objetAPlacer->getType()) {
                $compteur++;
            }
            if ($compteur == $nbEnfant) {
                $point++;
                echo "Type trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
            }
            // Recherche à partir du nom
            if ($listEnfantFichier->current()->getNom() == $objetAPlacer->getNom()) {
                $point++;
                echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
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
            echo 'recherche d\'un emplacement '.$objetAPlacer->getNom().' dans le dossier '.$listEnfantFichier->current()->getNom();echo '<br>';
            //Recherche du tag
            if($objetAPlacer->getMesTags()->valid() && $listEnfantDossier->current()->getMesTags()->valid()) {
                $listTag = $objetAPlacer->getMesTags();
                $listTagEnfant = $listEnfantDossier->current()->getMesTags();
                while ($listTag->valid()) {
                    if ($listTag->current() == $listTagEnfant->current()) {
                        $point++;
                        echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';

                    }
                    $listTag->next();
                    $listTagEnfant->next();
                }
            }
            if ($listEnfantDossier->current()->getNom() == $objetAPlacer->getNom()) {
                $point++;
                echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
            }
            $listEnfantDossier->next();
        }
    }

    //Enregistrement des points si le score est égale à 0 ou si aucun fichier ou dossier n'a était trouver
    if ($point > 0) {
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