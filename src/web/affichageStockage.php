<?php
/**
 * @file index.php
 * @author Gouaud Romain
 * @details Page affichant les stockages et leurs arborésences avec un formulaire pour tester les ajouts
 * @version 4.0
 */
require_once "../api/vendor/autoload.php";
include_once "pop_up.php";
include_once "header_footer.php";
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Stockage.php";
include_once "../class/Archive.php";
include_once "../DAO/Database.php";
include_once "../DAO/StockageDAO.php";
include_once "../DAO/DossierDAO.php";

use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;

$_SESSION["appkey"] = "jaaxkhp8722sd6c";
$_SESSION["appSecret"] = "tm79cqrc8x8uakl";

if (isset($_SESSION['utilisateur'])) {
    
    if(isset($_SESSION['dropbox_access_token'])) {
        $app = new DropboxApp($_SESSION["appkey"], $_SESSION["appSecret"], $_SESSION['dropbox_access_token']);
        $dropbox = new Dropbox($app);
        parcourirDossier($dropbox, "/");
    }

    $listeStockage = new SplObjectStorage();
    $bd=new StockageDAO(Database::getInstance());
    $listeStockage->addAll($bd->getAllStockages($_SESSION['utilisateur']));
    $bd->__destruct();
    $bd=new DossierDAO(Database::getInstance());
    $listeStockage->rewind();
    if ($listeStockage->count() == 0) {
        echo $header;
        echo '<h1>Vous n\'avez pas de stockage</h1>';
        echo $footer;
        exit();
    }
    else {
        $listeStockage->rewind();
        while ($listeStockage->valid()) {
            $parent = $listeStockage->current()->getMaRacine();
            $bd->getAllEnfant($parent);
            $listeStockage->next();
        }
    }

    echo $header;
    // Afficher les stockages et leurs arborésences -> Ici les stockages sont passé en paramètre depuis l'import d'un fichier
    $stockage = new SplObjectStorage;
    $stockage->addAll($listeStockage);

    $stockage->rewind();
    while($stockage->valid()) {
        echo '<div class="pictos">
        <h1>'.$stockage->current()->getNom().'</h1>
        <a class="picto-item" href="#" aria-label=" Nom : '.$stockage->current()->getNom().' | '.
        'Taille : '.$stockage->current()->getTaille().' octet | '.
        ' Taille maximale : '.$stockage->current()->getTailleMax().' octet"><img src="img/icon/infoBulle.png" alt="information supplémentaire"></a>
        </div>';
        echo '<hr>';

        echo '<ul class="list-unstyled ps-0">
        <li class="mb-1">
        <button id="button" class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">'.$stockage->current()->getNom();
        // Affichage de la racine
        if ($stockage->current()->getMaRacine()->getMesTags() != null) {
            echo ' | Tag : ';
            $racineTag = $stockage->current()->getMaRacine()->getMesTags();
            while($racineTag->valid()){
                echo '  '.$racineTag->current()->getTitre();
                $racineTag->next();
            }
        }
        echo '</button>
        <div class="collapse show" id="home-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">';
        // affichage de l'arborésence
        affichageContenu($stockage->current()->getMaRacine());
        echo '</a></li>
        </ul>
        <hr>';
        $stockage->next();
    } 

    // formulaire du fichier à ajouter (possibilité de choisir un fichier .txt)
    echo '
    <form action="../code/upload.php" method="post" enctype="multipart/form-data" id="myDropzone">
        Sélectionnez le fichier à télécharger:<br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="text" name="tag" hint="Donner vos tags">
        <input type="submit" value="Télécharger le fichier" name="submit">
    </form>';
    echo $footer;

    if(isset($_GET['error'])) {
        if($_GET['error'] == "upload")
            echo $pop_up_upload;
        else if($_GET['error'] == "exist")
            echo $pop_up_exist;
        else if($_GET['error'] == "error")
            echo $pop_up_error;
        else if($_GET['error'] == "fichierTropGros")
            echo $pop_up_size;
        else if($_GET['error'] == "pasDeStockage")
            echo $pop_up_pasTrouver;
    }
}
else {
    echo $header;
    echo '<div class="alert alert-danger" role="alert">
    Vous devez être connecté pour avoir des stockages sur cette page
    </div>';
    echo $footer;
    exit();
}

/**
 * @brief Affichage de l'arborésence d'un stockage
 * @param Dossier $racine : dossier racine du stockage
 * @param Fichier $ajout : fichier ajouté (si il y en a un)
 * @param int $espace : espacement pour l'affichage de l'arborésence (0 par défaut, pas obligatoire)
 * @return void
 */
function affichageContenu($racine, $espace = 0) {
    // Gestion de l'espacement pour l'affichage de l'arborésence (décalage à droite des sous-dossiers / sous-fichiers)
    /**
     * @var int $i : compteur pour l'espacement
     * @var string $espacement : espacement à afficher
     * @var int $espace : nombre d'$espacement à ajouter
     */
    

    // Affichage des sous-dossiers -> récursif : rappel de la fonction pour chaque sous dossier
    $enfantsDoss = $racine->getListeEnfantDossier();
    $enfantsDoss->rewind();
    while($enfantsDoss->valid()){
        echo '<li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'" aria-expanded="false">';
        for($i=$espace; $i >= 0; $i--) {
            echo'<a style="margin-right: '.strval(16.5).'px;">||</a>';
        }
        echo'<img src="img/icon/dossier.png" alt="icone fichier">'.$enfantsDoss->current()->getNom();
            
        if ($enfantsDoss->current()->getMesTags() != null) {
            $DossTag = $enfantsDoss->current()->getMesTags();
            $DossTag->rewind();
            echo '<a>'.' | Tag : ';
            while($DossTag->valid()){
                echo $DossTag->current()->getTitre().' ';
                $DossTag->next();
            }
            echo '</a>';
        }
        echo '</button>
        <div class="collapse" id="'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">';
        $espace++;
        affichageContenu($enfantsDoss->current(), $espace);
        echo '</a></li>';
        $enfantsDoss->next();
    }
    // Affichage des sous-fichiers  
    $enfantsFich = $racine->getListeEnfantFichier();
    $enfantsFich->rewind();
    while($enfantsFich->valid()){
        echo '<li><a class="link-dark d-inline-flex text-decoration-none rounded ">';
        for($i=$espace; $i >= 0; $i--){echo'<a style="margin-right: '.strval(5).'px; margin-left: 13.5px;">||</a>';}echo'<img src="img/icon/'.$enfantsFich->current()->getType().'.png" alt="icone fichier">'.$enfantsFich->current()->getNom().'.'.$enfantsFich->current()->getType().'</a></li>';
        $enfantsFich->next();
    }
    echo '
    </ul>
    </div>
    </li>';
}

function parcourirDossier($dropbox, $cheminDossier) {
    $stockage = new Stockage('dropbox', 0, 2000000000, true, '', 1, NULL);
    $listFolderContents = $dropbox->listFolder($cheminDossier);
    foreach ($listFolderContents->getItems() as $key => $value) {
        $stockage->setMaRacine(new Dossier(0, '/', '', 0));
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
    $bd = new StockageDAO(Database::getInstance());
    $bd->addStockage($stockage);
    $bd->__destruct();
    $bd = new DossierDAO(Database::getInstance());
    $bd->addDossierRacine($stockage->getMaRacine());
    $bd->__destruct();
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
                $bd = new DossierDAO(Database::getInstance());
                $bd->addDossier($dossier->current());
                $bd->__destruct();
                $dossier->next();
            }
        } else {
            $typeFichierExplode = explode(".", $value->getName());
            $extension = array_pop($typeFichierExplode);
            $parent->ajouterEnfantFichier(new Fichier($value->getID(), $value->getName(), $value->getSize(), $value->getPathLower(), $extension));
            $bd = new FichierDAO(Database::getInstance());
            $bd->insertFichier($parent->getListeEnfantFichier()->current());
            $bd->__destruct();
        }
    }
}

?>