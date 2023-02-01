<?php
include_once "../class/Fichier.php";
include_once "../class/Archive.php";
include_once "../code/baseDeDonneePhysique.php";

$fichier = new Fichier("test", 10, "C:\test", "txt");

$fichier->meRanger($stockage);

//$fichier->ajouterElement($stockage);

?>