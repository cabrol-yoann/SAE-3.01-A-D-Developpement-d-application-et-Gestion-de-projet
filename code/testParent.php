<?php
include_once "baseDeDonneePhysique.php";

$dossier1->setParent($drive);
$dossier1->updateParentPoids();
echo $drive->getTaille();
?>