<?php
include_once "../code/baseDeDonneePhysique.php";
include_once "../class/Dossier.php";
include_once "../class/Fichier.php";
include_once "../code/trierList.php";
include_once "../code/changementNom.php";
include_once "../code/recherche.php";
include_once "../code/restructuration.php";
include_once "../code/debutRecherche.php";

/*
// test de la fonction debutRecherche
echo 'test de la fonction debutRecherche';echo '<br>';echo '<br>';
$restructuration=false;
debutRecherche($stockage, $objetAPlacer,$nomEspaceStockageTrouver,$nomDossierTrouver,$restructuration);
echo $nomDossierTrouver;echo ' nom du dossier trouver';echo '<br>';
echo $nomEspaceStockageTrouver->getNom();echo ' nom de l espace de stockage trouver';echo '<br>';
// fin du test de la fonction debutRecherche
echo 'fin du test de la fonction debutRecherche';echo '<br>';echo '<br>';
*/

echo 'test du code complet';echo '<br>';echo '<br>';
// test du code complet
$restructuration=false;

debutRecherche($stockage, $objetAPlacer,$nomEspaceStockageTrouver,$nomDossierTrouver,$restructuration);
echo 'fin du test de la fonction debutRecherche';echo '<br>';echo '<br>';


// fin du test du code complet
echo '<br>';echo '<br>';echo 'fin du test du code complet';echo '<br>';echo '<br>';

// test de la fonction recherche
echo 'test de la fonction recherche';echo '<br>';echo '<br>';
$score=0;
$trouver=false;
$nomDossierTrouver="";
Recherche($score,$trouver,$nomDossierTrouver,$dossier8,$objetAPlacer,$restructuration);
print($nomDossierTrouver->getNom());echo ' nom du dossier trouver';echo '<br>';   
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
$test1 = new Stockage("test1","","",true);
$test2 = new Stockage("test2","","",false);
$test3 = new Stockage("test3","","",false);
$test4 = new Stockage("test4","","",true);
$test1->setMaRacine($dossier1);
$test2->setMaRacine($dossier2);
$test3->setMaRacine($dossier3);
$test4->setMaRacine($dossier4);

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
print('test de la fonction restructuration');echo '<br>';echo '<br>';
$nomEspaceStockageTrouver = $cloud;
$ObjetAPlacer = $objetAPlacer;
$nomDossierTrouver = $dossier6;
Restructuration($nomEspaceStockageTrouver,$ObjetAPlacer,$nomDossierTrouver,$stockage);
echo '<br> fin du test restructuration';

echo '<br><br><br><br><br><br>';

//test de la fonction rechercheDossierARestructurer

//Test du dynamisme des poids

$stockageTest = new Stockage("SAE",0,"/",500000000,false);

$dossTest1 = new Dossier("DossRacine", 0, "");
$dossTest2 = new Dossier("Doss2", 0, "");
$dossTest3 = new Dossier("Doss3", 0, "");
$stockageTest->setMaRacine($dossTest1);

$fichierTest1 = new Fichier("Fich1", 10, "", ".text");
$fichierTest2 = new Fichier("Fich2", 15, "", ".odt");
$fichierTest3 = new Fichier("Fich3", 27, "", ".odt");
$fichierTest4 = new Fichier("",4568,"","");

echo '<br>'.'<br>'.'<strong>Test du dynamisme des TAILLES</strong> : ';
echo '<br>'.'<br>'.'Taille des fichiers : '.'<br>';
echo $fichierTest1->getNom().' : '.$fichierTest1->getTaille().'<br>';
echo $fichierTest2->getNom().' : '.$fichierTest2->getTaille().'<br>';
echo $fichierTest3->getNom().' : '.$fichierTest3->getTaille().'<br>';
echo $fichierTest4->getNom().' : '.$fichierTest4->getTaille().'<br>';


// ajout des fichiers aux des dossiers
$dossTest1->ajouterEnfantDossier($dossTest3);

$dossTest1->ajouterEnfantDossier($dossTest2);

$dossTest2->ajouterEnfantFichier($fichierTest1);
$dossTest2->ajouterEnfantFichier($fichierTest2);

$dossTest3->ajouterEnfantFichier($fichierTest3);
$dossTest1->ajouterEnfantFichier($fichierTest4);


echo '<br>'.'Taille des dossiers : '.'<br>';
echo $dossTest1->getNom().' : '.$dossTest1->getTaille().'<br>';
echo $dossTest2->getNom().' : '.$dossTest2->getTaille().'<br>';
echo $dossTest3->getNom().' : '.$dossTest3->getTaille().'<br>';

echo '<br>'.'Taille du stockage : '.'<br>';
echo $stockageTest->getNom().' : '.$stockageTest->getTaille().'<br>';


?>