<?php
include_once "header_footer.php";

echo $header;

?>

<section class="">
  <div class="bg-white border rounded-5">
    
    <section class="p-5 w-100" style="background-color: #eee;">
      <div class="row">
        <div class="col-12">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mt-4">S'inscrire</p>

                  <form action="../code/inscription.php" method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-floating flex-fill mb-0">
                        <input type="text" id="floatingName" class="form-control" name="nom" required="required" placeholder="name">
                        <label class="form-label" for="floatingName" style="margin-left: 0px;">Nom</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 71.2px;"></div><div class="form-notch-trailing"></div></div></div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-floating flex-fill mb-0">
                        <input type="email" id="floatingEmail" class="form-control" name="email" required="required" placeholder="name@example.com">
                        <label class="form-label" for="floatingEmail" style="margin-left: 0px;">Adresse e-mail</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 69.6px;"></div><div class="form-notch-trailing"></div></div></div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-floating flex-fill mb-0">
                        <input type="password" id="floatingPassword" class="form-control" name="password" required="required" placeholder="Password">
                        <label class="form-label" for="floatingPassword" style="margin-left: 0px;">Mot de passe</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 64px;"></div><div class="form-notch-trailing"></div></div></div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-floating flex-fill mb-0">
                        <input type="password" id="floatingRepeatPassword" class="form-control" name="passwordRepeat" required="required" placeholder="Password">
                        <label class="form-label" for="floatingRepeatPassword" style="margin-left: 0px;">Répétez votre mot de passe</label>
                      <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 136px;"></div><div class="form-notch-trailing"></div></div></div>
                    </div>

                    <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" required ="required" id="floatingTerms">
                      <label class="form-check-label" for="floatingTerms">
                        En vous inscrivant, vous acceptez les <a href="conditionUtilisation.php">Conditions d'utilisation</a>.
                      </label>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg me-3">S'inscrire</button>
                      <a class="btn-lg btn btn-outline-primary" href="page_Connexion.php" role="button">Se connecter</a>
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="img/versDuolCloud.png" class="img-fluid" alt="Sample image">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>    
  </div>
</section>

<?php
include_once "header_footer.php";

echo $footer;

?>