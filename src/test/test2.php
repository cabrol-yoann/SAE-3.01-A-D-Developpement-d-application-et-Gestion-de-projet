<?php

include_once "../DAO/DossierDAO.php";

$BD = new DossierDAO();
var_dump($BD->getDossierById(2));
var_dump($BD->getAllDossiers());
?>