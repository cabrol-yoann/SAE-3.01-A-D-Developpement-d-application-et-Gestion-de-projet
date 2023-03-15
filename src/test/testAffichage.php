<?php

include_once "../DAO/Database.php";
include_once "../DAO/StockageDAO.php";
include_once "../DAO/DossierDAO.php";
include_once "../DAO/TagDAO";

$bd = new TagDAO(Database::getInstance());
$listeTag=$bd->getListeTag();
var_dump($listeTag);

?>