<?php
include_once "../DAO/database.php";
include_once "../DAO/UtilisateurDAO.php";

$utilisateur = new UtilisateurDAO();

$utilisateur->getAllUtilisateur();

var_dump($utilisateur);

?>