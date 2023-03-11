<?php
include_once "header_footer.php";
echo $header;

?>

  <form action="../code/connexion.php" method="post" class="form-signin w-25 m-auto text-center  py-5 my-5">
    <img class="mb-4" src="img/logo_DuolCloud.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Connectez Vous</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">adresse e-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Mot de passe</label>
    </div>

    <div class="checkbox my-3">
      <label>
        <input type="checkbox" value="remember-me"> Se souvenir de moi
      </label>
    </div>
    <button class="w-50 btn btn-lg btn-primary" type="submit">Connexion</button>
    <hr class="m-4">
    <a class="w-50 btn-lg btn btn-outline-primary" href="inscription.php" role="button">Créer un compte</a>
  </form>

<?php
include_once "header_footer.php";
include_once "pop_up.php";
if(isset($_GET['error'])) {
  if ($_GET['error']=="InscriptionValide") {
    echo $pop_up_inscription;
  }
  if($_GET['error']=="connexionValide") {
    echo $pop_up_errorConnexion;
  }
}
echo $footer;

?>