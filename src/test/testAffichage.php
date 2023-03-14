<?php

include_once "../DAO/Database.php";
include_once "../DAO/StockageDAO.php";
include_once "../DAO/DossierDAO.php";

$listeStockage = new SplObjectStorage();
$bd=new StockageDAO(Database::getInstance());
$listeStockage->addAll($bd->getAllStockages(1));
$bd->__destruct();
$bd=new DossierDAO(Database::getInstance());
$listeStockage->rewind();
while ($listeStockage->valid()) {
    $parent = $listeStockage->current()->getMaRacine();
    $bd->getAllEnfant($parent);
    $listeStockage->next();
}
$_SESSION['listeStockage'] = $listeStockage;

?>