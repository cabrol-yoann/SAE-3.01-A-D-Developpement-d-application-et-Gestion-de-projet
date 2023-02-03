<?php
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Archive.php";
include_once "../code/baseDeDonneePhysique.php";

$fichier = new Fichier("test", 10, "C:\test", "txt");
$dossier = new Dossier("sapin", "C:\test");

//echo $drive->getTaille();

$drive->Restructuration($fichier,$dossier6,$drive);

//$fichier->meRanger($stockage,);

$dossier->ajouterEnfantFichier($fichier);
$dossier->ajouterTags($tag4);

//$fichier->meRanger($stockage);
$dossier->meRanger($fichier);

//$fichier->ajouterElement($stockage);

?>