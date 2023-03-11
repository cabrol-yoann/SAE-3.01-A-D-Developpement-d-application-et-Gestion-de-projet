<?php
session_start();

include_once "../DAO/Database.php";
include_once "../DAO/UtilisateurDAO.php";

$nom = htmlentities($_POST['nom']);
$mail = htmlentities($_POST['email']);
$psw = htmlentities($_POST['pasword']);
$psw2 = htmlentities($_POST['passwordRepeat']);
if($psw != $psw2)
    header('Location: ../web/pageInscription.php?error="validationMdp"');
else {
    $bd = new UtilisateurDAO(Database::getInstance());
    $resultat = $bd->getUtilisateurForInscription($nom,$mail, $psw);
    if($resultat == false)
        header('Location: ../web/pageInscription.php?error="ErrorInscription"');
    else {
        //$_SESSION['utilisateur']=$utilisateur;
        header('Location: ../web/accueil.php?error="InscriptionValide"');
    }
}
?>