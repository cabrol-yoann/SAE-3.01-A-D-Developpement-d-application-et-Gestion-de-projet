<?php

include_once "../DAO/DossierDAO.php";
$BD = new DossierDAO();

//var_dump($BD->getDossierById(2));
//Test de l'obtention de tous les dossiers
    $all = $BD->getAllDossiers();
    foreach($all as $object){
        echo 'Id : '. $object->id. '<br>';
        echo 'Nom : '. $object->nom. '<br>';
        echo 'Chemin : '. $object->chemin. '<br>' . '<br>';
    }

//Test de la supression d'un dossier
    //$BD->deleteDossier($all[4]); (Fonctionnel)

//Test de l'ajout d'un dossier
$dossierTest = new Dossier('AAAAAA', 'TAAAAAAAAD/');
    //$BD->addDossier($dossierTest); //(Fonctionnel)

//Test de l'update (Fonctionnel)
$dossierTest->setNom('Edouardounet');
$dossierTest->setChemin('/Eduardo');
$dossierTest->setId($BD->getConnection()->lastInsertId());
echo $BD->getConnection()->lastInsertId();
//$BD->updateDossier($dossierTest);
?>