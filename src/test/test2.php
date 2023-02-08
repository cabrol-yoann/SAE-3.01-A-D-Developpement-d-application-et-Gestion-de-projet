<?php

include_once "../DAO/DossierDAO.php";

$BD = new DossierDAO();
var_dump($BD->getDossierById(2));
$all = $BD->getAllDossiers();

var_dump($all);
?>