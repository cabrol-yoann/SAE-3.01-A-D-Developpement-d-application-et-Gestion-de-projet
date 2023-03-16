<?php

include_once "../class/Fichier.php";
include_once "../class/Tag.php";
include_once "../DAO/Database.php";
include_once "../DAO/StockageDAO.php";
include_once "../DAO/DossierDAO.php";
include_once "../DAO/FichierDAO.php";
include_once "../DAO/TagDAO.php";
include_once "../DAO/UtilisateurDAO.php";
session_start();

if(isset($_POST['submit'])) {
    $fileSize = $_FILES["fileToUpload"]["size"];
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $typeFichierExplode = explode(".", $file_name);
    $fileType = array_pop($typeFichierExplode);

    // Vérifiez si le fichier a été correctement téléchargé

    for($i=strlen($file_name)-1;$i>0;$i--) {
        if($file_name[$i] != ".") {
            $file_name = substr($file_name,0,-1);
        }
         else {
            $file_name = substr($file_name,0,-1);
            break;
        }
    }
    $nouveauFichier = new Fichier(0,$file_name,$fileSize,"",$fileType);
    if (isset($_POST['tag'])) {
        for($i=0;$i<strlen($_POST['tag']);$i++) {
            if($_POST['tag'][$i] != " ")
                $tag = $_POST['tag'][$i];
            else {
                $trouver=false;
                $listeTag->rewind();
                while($listeTag->valid())
                {
                    if($listeTag->current()->getTitre() == $tag) {
                        $trouver=true;
                        break;
                    }
                    $listeTag->next();
                }
                if($trouver==false) {
                    $tags = new Tag($tag);
                    $nouveauFichier->ajouterTags($tags);
                    $tag = "";
                    $tags->__destruct();
                }
                else {
                    $nouveauFichier->ajouterTags($listeTag->current());
                }
            }
        }
    }

    $listeStockage = new SplObjectStorage();
    $bd=new StockageDAO(Database::getInstance());
    $bdUtilisateur = new UtilisateurDAO(Database::getInstance());
    $utilisateur = $bdUtilisateur->getUtilisateurById($_SESSION['utilisateur']);
    $listeStockage->addAll($bd->getAllStockages($utilisateur->getId()));
    $bd->__destruct();
    $bdTag = new TagDAO(Database::getInstance());
    $listeTag=$bdTag->getListeTag();
    $bdDossier=new DossierDAO(Database::getInstance());
    $listeStockage->rewind();
    while ($listeStockage->valid()) {
        $parent = $listeStockage->current()->getMaRacine();
        $bdDossier->getAllEnfant($parent);
        $listeStockage->next();
    }
            
    $bdDossier->__destruct();
    $bdTag->__destruct();
    $resultat = $nouveauFichier->meRanger($listeStockage);
    if ($resultat == "fichierTropGros") {
        header ('location: ../web/affichageStockage.php?erreur=fichierTropGros');
    }
    else if($resultat == "pasDeStockage") {
        header ('location: ../web/affichageStockage.php?erreur=pasDeStockage');
    }
    else {
        $bd=new FichierDAO(Database::getInstance());
        $bd->insertFichier($nouveauFichier);
        $bd->__destruct();
        header("Location: ../web/affichageStockage.php?error=upload");
    }
} 
else {
    header("Location: ../web/affichageStockage.php?error=exist");
}
?>