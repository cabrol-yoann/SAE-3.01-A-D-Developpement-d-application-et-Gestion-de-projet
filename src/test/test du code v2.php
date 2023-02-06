<?php
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Archive.php";
include_once "../code/baseDeDonneePhysique.php";

$fichier = new Fichier("sapin", 5000, "C:\test", "png");
$dossier = new Dossier("sapin", "C:\test");


$dossier->ajouterEnfantFichier($fichier);
$dossier->ajouterTags($tag);
$fichier->ajouterTags($tag);

//$fichier->meRanger($stockage);
$dossier->meRanger($stockage);

//$fichier->ajouterElement($stockage);

?>