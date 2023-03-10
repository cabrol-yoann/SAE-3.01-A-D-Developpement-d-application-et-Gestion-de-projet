<?php

include_once "../DAO/Database.php";
include_once "../DAO/DossierDAO.php";
session_start();
$_SESSION['utilisateur'] = 'test';

$bd = Database::getInstance();

session_destroy();
?>