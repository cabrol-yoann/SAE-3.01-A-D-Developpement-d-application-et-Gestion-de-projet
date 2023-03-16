<?php
// inclure la librairie Dropbox
require_once "vendor/autoload.php";
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Stockage.php";
include_once "../class/Archive.php";
include_once "../DAO/StockageDAO.php";

use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;

function parcourirDossier($dropbox, $cheminDossier) {
    $stockage = new Stockage('dropbox', 0, 2000000000, true, '', 1, NULL);
    $listFolderContents = $dropbox->listFolder($cheminDossier);
    foreach ($listFolderContents->getItems() as $key => $value) {
        $stockage->setMaRacine($dossier = new Dossier(0, '/', '', 0));
        if ($value->getTag() == "folder") {
            $stockage->getMaRacine()->ajouterEnfantDossier($dossier = new Dossier($value->getID(), $value->getName(), $value->getPathLower(), 0));
            //on ajoute les enfants au dossier
            $enfantDossier=$stockage->getMaRacine()->getListeEnfantDossier();
            $enfantDossier->rewind();
            while($enfantDossier->valid()){
                getAllEnfant($dropbox, $enfantDossier->current());
                $enfantDossier->next();
            }
        } else {
            $typeFichierExplode = explode(".", $value->getName());
            $extension = array_pop($typeFichierExplode);
            $stockage->getMaRacine()->ajouterEnfantFichier($fichier = new Fichier($value->getID(), $value->getName(), $value->getSize(), $value->getPathLower(), $extension));
        }
    }
}


function getAllEnfant($dropbox, $parent) {
    $listFolderContents = $dropbox->listFolder($parent->getChemin());
    foreach ($listFolderContents->getItems() as $key => $value) {
        if ($value->getTag() == "folder") {
            $parent->ajouterEnfantDossier($dossier = new Dossier($value->getID(), $value->getName(), $value->getPathLower(), 0));
            //on regarde les enfants du dossier
            $dossierEnfant=$parent->getListeEnfantDossier();
            $dossierEnfant->rewind();
            while($dossier->valid()){
                getAllEnfant($dossierEnfant->current());
                $dossier->next();
            }
        } else {
            $typeFichierExplode = explode(".", $value->getName());
            $extension = array_pop($typeFichierExplode);
            $parent->ajouterEnfantFichier($fichier = new Fichier($value->getID(), $value->getName(), $value->getSize(), $value->getPathLower(), $extension));
        }
    }
}


// initialiser les clés d'API et les jetons d'accès
$token = "sl.BarAQNmuAURxNhUdtF640hX4Io9IBWvM_8mAV89un9pnumsDy6-oOuWgDzHmVglKUJelbWPJKPS3JhACv-U-R8xAUG__64pnte-z6UW4hQ-MasTmlggNTpOCAWKEkgWGqx8xFEo";
$appKey = "jaaxkhp8722sd6c";
$appSecret = "tm79cqrc8x8uakl";

// initialiser le client Dropbox
$app = new DropboxApp($appKey, $appSecret, $token);
$dropbox = new Dropbox($app);

// récupérer la liste de tous les fichiers et dossiers
parcourirDossier($dropbox, "/");


//regarder les enfants de la liste des folder avec while et qui fait appel a la fonction get fichier a créer au debut avec pour zttribut le chemin avec commme valeur par defaut "/"
?>