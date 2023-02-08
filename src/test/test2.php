<?php
include_once "../DAO/DossierDAO.php";
$BD = new DossierDAO();

//Test de l'obtention de tous les dossiers
$all = $BD->getAllDossiers();
foreach($all as $object){
    echo 'Id : '. $object->id. '<br>';
    echo 'Nom : '. $object->nom. '<br>';
    echo 'Chemin : '. $object->chemin. '<br>' . '<br>';
}

//Test de la supression d'un dossier
//$BD->deleteDossier($all[0]);

//Test de l'ajout d'un dossier
$dossierTest = new Dossier('SAE', 'SAE/');

//Test de la création d'un dossier
//$BD->addDossier($dossierTest);

//Test de l'update
$dossierTest->setNom('Eduardo');
echo $dossierTest->getNom();
$dossierTest->setChemin('/Eduardo');

$BD->updateDossier($dossierTest);
?>