<?php

include_once "../DAO/Database.php";
include_once "../DAO/DossierDAO.php";
session_start();
$_SESSION['utilisateur'] = 'test';

$BD = new DossierDAO();

session_destroy();
?>