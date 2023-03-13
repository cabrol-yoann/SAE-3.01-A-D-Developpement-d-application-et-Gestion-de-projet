<?php
session_start();

include_once "../DAO/Database.php";
include_once "../DAO/UtilisateurDAO.php";

$mail = htmlentities($_POST['email']);
$psw = htmlentities($_POST['password']);

$bd = new UtilisateurDAO(Database::getInstance());
$id = $bd->getUtilisateurForConnexion($mail, $psw);
if($id == false)
    header('Location: ../web/page_connexion.php?error=Errorconnexion');
else {
    $_SESSION['utilisateur']=$id;
    header('Location: ../web/accueil.php?error=connexionValide');
}
?>