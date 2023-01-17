<?php

include_once "../classe/Dossier.php";
include_once "../classe/Fichier.php";
include_once "trierList.php";
include_once "changementNom.php";
include_once "recherche.php";
<<<<<<< HEAD
include_once "restructuration.php";
=======
include_once "debutRecherche.php";

debutRecherche($stockage, $objetAPlacer);
>>>>>>> parent of c2d4151... vide

// test de la fonction recherche
echo 'test de la fonction recherche';echo '<br>';echo '<br>';
$score=0;
$trouver=false;
$nomDossierTrouver="";
<<<<<<< HEAD
Recherche($score,$trouver,$nomDossierTrouver,$drive,$objetAPlacer);
=======
Recherche($score,$trouver,$nomDossierTrouver,$dossier8,$objetAPlacer);
>>>>>>> parent of c2d4151... vide
print($nomDossierTrouver);echo ' nom du dossier trouver';echo '<br>';   
print($score);echo ' score';echo '<br>';
echo '<br> fin du test recherche';

echo '<br><br><br><br><br><br>';

// test de la fonction changementNom
print('test de la fonction changementNom');echo '<br>';echo '<br>';
print($objetAPlacer->getNom());echo ' ancient nom';echo '<br>';

ChangementNomDossier($dossier4,$objetAPlacer);
print($objetAPlacer->getNom());echo ' nouveau nom';echo '<br>';
echo '<br> fin du test changementNom';

echo '<br><br><br><br><br><br>';

// test de la fonction trierList
echo 'test de la fonction trierList';echo '<br>';echo '<br>';
$test1 = new Stockage("test1",1,"","",true);
$test2 = new Stockage("test2",2,"","",false);
$test3 = new Stockage("test3",3,"","",false);
$test4 = new Stockage("test4",4,"","",true);

$listTest = new \SplObjectStorage();
$listTest->attach($test4);
$listTest->attach($test2);
$listTest->attach($test3);
$listTest->attach($test1);

$listTest->rewind();
while ($listTest->valid()) {
    print($listTest->current()->getNom());echo '    ';
    print($listTest->current()->getTaille());
    $listTest->next();
    echo '<br>';
}

trierList($listTest);
// affichage de la liste triée
echo 'affichage de la liste triée';
echo '<br>';
$listTest->rewind();
while ($listTest->valid()) {
    print($listTest->current()->getNom());echo '    ';
    print($listTest->current()->getTaille());
    $listTest->next();
    echo '<br>';
}
echo '<br> fin du test trierList';

echo '<br><br><br><br><br><br>';

// test de la fonction restructuration
print('test de la fonction changementNom');echo '<br>';echo '<br>';
$nomEspaceStockageTrouver = $cloud;
$ObjetAPlacer = $objetAPlacer;
$nomDossierTrouver = $dossier6;
Restructuration($nomEspaceStockageTrouver,$ObjetAPlacer,$nomDossierTrouver,$Stockage);
echo '<br> fin du test restructuration';

echo '<br><br><br><br><br><br>';

//test de la fonction rechercheDossierARestructurer


?>