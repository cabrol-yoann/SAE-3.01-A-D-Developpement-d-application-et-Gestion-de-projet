<?php


include_once "Dossier.php";
include_once "trierList.php";

// test de la fonction trierList
echo 'test de la fonction trierList';echo '<br>';echo '<br>';
$test1 = new Dossier("test1",1,"");
$test2 = new Dossier("test2",2,"");
$test3 = new Dossier("test3",3,"");
$test4 = new Dossier("test4",4,"");

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
?> 