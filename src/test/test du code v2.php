<?php
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Archive.php";
include_once "../code/baseDeDonneePhysique.php";

$fichier = new Fichier("cour", 499999999, "C:\test", "word");
$dossier = new Dossier("sapin", "C:\test");


$dossier->ajouterEnfantFichier($fichier);
$dossier->ajouterTags($tag3);
$fichier->ajouterTags($tag3);


$fichier->afficher();echo "<br>";echo "<br>";
$dossier->afficher();echo "<br>";echo "<br>";
//$fichier->meRanger($stockage);
$fichier->meRanger($stockage);

//$fichier->ajouterElement($stockage);

?>