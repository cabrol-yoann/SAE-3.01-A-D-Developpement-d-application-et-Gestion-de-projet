<?php
include_once "header_footer.php";

echo $header;

?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">S'inscrire</h1>
        <p class="col-lg-10 fs-4">Vous utilisez plusieurs services de stockage en ligne pour sauvegarder vos fichiers et vous en avez assez de devoir passer d'un service à l'autre pour trouver ce que vous cherchez ? Avec DuolCloud, vous pouvez maintenant accéder à tous vos fichiers en un seul endroit !</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">adresse e-mail</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Mot de passe</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Se souvenir de moi
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary mb-2" type="submit">S'inscrire</button>
          <small class="text-muted">En vous inscrivant, vous acceptez les conditions d'utilisation.</small>
          <hr class="my-4">
          <a class="w-100 btn-lg btn btn-primary" href="connexion.php" role="button">Connexion</a>
        </form>
      </div>
    </div>
  </div>

<?php
include_once "header_footer.php";

echo $footer;

?>