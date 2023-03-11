<?php
include_once "../DAO/Database.php";
include_once "../DAO/UtilisateurDAO.php";

$utilisateur = new UtilisateurDAO(Database::getInstance());

$ok = $utilisateur->getUtilisateurById(1);

var_dump($ok);

?>