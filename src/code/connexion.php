<?php
include_once "../DAO/Database.php";
include_once "../DAO/UtilisateurDAO.php";

session_start();

$mail = htmlentities($_POST['email']);
$psw = htmlentities($_POST['password']);

$bd = new UtilisateurDAO(Database::getInstance());
$utilisateur = $bd->getUtilisateurForConnexion($mail, $psw);
if($utilisateur == false)
    header('Location: ../web/page_connexion.php?error=Errorconnexion');
else {
    $_SESSION['utilisateur']=$utilisateur->getId();
    header('Location: ../web/index.php?error=connexionValide');
}
?>