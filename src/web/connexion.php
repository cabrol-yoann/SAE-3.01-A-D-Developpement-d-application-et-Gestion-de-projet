<?php
include_once "header_footer.php";

echo $header;

?>

  <form class="form-signin w-25 m-auto text-center  py-5 my-5">
    <img class="mb-4" src="../../logo_DuolCloud.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Connectez Vous</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">adresse e-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Mot de passe</label>
    </div>

    <div class="checkbox my-3">
      <label>
        <input type="checkbox" value="remember-me"> Se souvenir de moi
      </label>
    </div>
    <button class="w-50 btn btn-lg btn-primary mb-5" type="submit">Connexion</button>
  </form>

<?php
include_once "header_footer.php";

echo $footer;

?>