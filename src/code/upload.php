<?php

include_once "../class/Fichier.php";
include_once "../class/Tag.php";
include_once "../DAO/Database.php";
include_once "../DAO/StockageDAO.php";
include_once "../DAO/DossierDAO.php";
include_once "../DAO/FichierDAO.php";
include_once "../DAO/TagDAO.php";
session_start();

if(isset($_POST['submit'])) {
    $target_dir = "../../uploads/"; // répertoire où les fichiers seront enregistrés
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifiez si le fichier existe déjà
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Vérifiez si le fichier a été correctement téléchargé
    if ($uploadOk == 0) {
        header("Location: ../web/affichageStockage.php?error=error");
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileSize = filesize("../../uploads/$file_name");
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
            $listeStockage->addAll($bd->getAllStockages(1));
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
                header("Location: ../web/affichageStockage.php?error=upload");
            }
        } else {
            header("Location: ../web/affichageStockage.php?error=exist");
        }
    }
}
?>