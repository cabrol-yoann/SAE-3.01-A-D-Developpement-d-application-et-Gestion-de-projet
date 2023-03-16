<?php
include_once "../DAO/Database.php";
include_once "../DAO/UtilisateurDAO.php";

session_start();

$nom = htmlentities($_POST['nom']);
$mail = htmlentities($_POST['email']);
$psw = htmlentities($_POST['password']);
$psw2 = htmlentities($_POST['passwordRepeat']);
if($psw != $psw2)
    header('Location: ../web/pageInscription.php?error="validationMdp"');
else {
    $bd = new UtilisateurDAO(Database::getInstance());
    $utilisateur = $bd->getUtilisateurForInscription($nom,$mail, $psw);
    if($utilisateur == false)
        header('Location: ../web/pageInscription.php?error=ErrorInscription');
    else {
        $_SESSION['utilisateur']=$utilisateur->getId();
        header('Location: ../web/index.php?error=InscriptionValide');
    }
}
?>