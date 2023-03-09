<?php

include_once "../class/Fichier.php";
include_once "../class/Tag.php";
include_once "baseDeDonneePhysique.php";

if(isset($_POST['submit'])) {
    $target_dir = "../../uploads/"; // répertoire où les fichiers seront enregistrés
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifiez si le fichier existe déjà
    if (file_exists($target_file)) {
        echo "Le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Vérifiez si le fichier a été correctement téléchargé
    if ($uploadOk == 0) {
        header("Location: ../web/Fichier.php?error=error");
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileSize = filesize("../../uploads/$file_name");
            echo '<script>alert("ranger")</script>';
            for($i=strlen($file_name)-1;$i>0;$i--) {
                if($file_name[$i] != ".") {
                    $file_name = substr($file_name,0,-1);
                }
                else {
                    $file_name = substr($file_name,0,-1);
                    break;
                }
            }
            $nouveauFichier = new Fichier($file_name,$fileSize,"",$fileType);
            if (isset($_POST['tag'])) {
                for($i=0;$i<strlen($_POST['tag']);$i++) {
                    if($_POST['tag'][$i] != " ")
                        $tag = $_POST['tag'][$i];
                    else {
                        $tag = new Tag($tag);
                        $nouveauFichier->ajouterTags($tag);
                        $tag = "";
                        $tag->_destruct();
                    }
                }
            }
            $nouveauFichier->meRanger($stockage);
            echo '<script>alert("fin_ranger")</script>';
            header("Location: ../web/Fichier.php?error=upload");
        } else {
            header("Location: ../web/Fichier.php?error=exist");
        }
    }
}
?>