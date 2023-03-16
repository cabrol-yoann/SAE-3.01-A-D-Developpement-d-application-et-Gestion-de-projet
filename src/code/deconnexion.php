<?php
//deconnexion 
session_start();

$_SESSION['utilisateur'] = null;

session_destroy();
header('Location: ../web/index.php');
?>