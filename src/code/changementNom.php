<?php
/**
 * @file debutRecherche.php
 * @author Cabrol Yoann, Ferreira Alexandre
 * @details Fonction permettant de restructurer un dossier
 * @version 1.0
 */

include_once "baseDeDonneePhysique.php";
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";


/**
 * @brief Fonction permettant de changer le fichier ajouter de nom en cas de doublon
 * @param Dossier $nomDossierTrouver Dossier dans lequel on va restructurer
 * @param Fichier $ObjetAPlacer Objet à placer
 * @return void
 */
function ChangementNomDossier($nomDossierTrouver, $ObjetAPlacer){

    if (get_class($ObjetAPlacer) == get_class($testDossier = new Dossier("",0,""))) {
        //Variables
        /**
         * @var int $compteur Compteur pour le changement de nom
         * @var string $nouveauNom Nouveau nom du dossier
         * @var SplObjectStorage $listeEnfantDossier Liste des enfants du dossier
         */
        $compteur=1;
        $nouveauNom = "";
        $listeEnfantDossier = $nomDossierTrouver->getListeEnfantDossier();

        //Pour changer le nom d'un dossier
        $listeEnfantDossier->rewind();
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
        $listeEnfantFichier->rewind();
        while ($listeEnfantFichier->valid()) {
            $FichierTraiter = $listeEnfantFichier->current();
            if ($FichierTraiter->getNom() == $ObjetAPlacer->getNom()) {
                $nouveauNom = $ObjetAPlacer->getNom()."(".$compteur.")";
                $ObjetAPlacer->setNom($nouveauNom);
                $compteur++;
                $listeEnfantFichier->rewind();
            }
            $listeEnfantFichier->next();
        }
    }
}

?>