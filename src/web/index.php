<?php
include_once "header_footer.php";

echo $header;

?>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" width="100%" height="700px" src="img/drives.png" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></img>
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Connecter plusieurs Stockage</h1>
            <p>Avec DuolCloud vous pouvez connecter plusieurs espace de stockage afin d'avoir un seul stockage</p>
            <p><a class="btn btn-lg btn-primary" href="page_Inscription.php">Inscrivez-vous</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="700px" src="img/twoServers.png" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></img>
        <div class="container">
          <div class="carousel-caption text-secondary">
            <h1>Connecter vous à vos serveurs local</h1>
            <p>Vous pouvez aussi vous connecter à vos serveurs locaux </p>
            <p><a class="btn btn-lg btn-primary" href="page_ConnexionStockage.php">Connexion</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="700px" src="img/partage.png" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></img>
        <div class="container">
          <div class="carousel-caption text-secondary text-end">
            <h1>Partager vos fichiers</h1>
            <p>Vous pouvez partager des fichiers, des dossiers et des stockages</p>
            <p><a class="btn btn-lg btn-primary" href="page_Partage.php">Partage</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Connectez jusqu'à 10 comptes de stockage en ligne avec DuolCloud !</h2>
        <p class="lead">Avec la version gratuite de DuolCloud, vous pouvez connecter jusqu'à 3 comptes de stockage en ligne. Mais pour une expérience encore plus complète, upgradez vers la version payante et connectez jusqu'à 10 comptes en même temps ! Fini les allers-retours entre différents services de stockage, accédez à tous vos fichiers importants en un seul endroit.</p> 
      </div>
      <div class="col-md-5">
        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="img/versDuolCloud.png" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#eee"></rect></img>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Rangez facilement vos nouveaux fichiers avec DuolCloud</h2>
        <p class="lead">Ajoutez régulièrement de nouveaux fichiers à vos comptes de stockage en ligne ? DuolCloud vous permet de ranger facilement ces fichiers en un seul endroit. Vous pouvez choisir où ranger ces nouveaux fichiers parmi vos comptes connectés, ou même créer de nouveaux dossiers pour mieux les organiser. Avec DuolCloud, vous n'aurez plus à vous soucier de trouver vos fichiers parmi de nombreux services de stockage en ligne.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="img/files.png" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#eee"></rect></img>
      </div>
    </div>

    <div class="container px-4 py-5">
    <h2 class="pb-2 border-bottom">Avantages</h2>

    <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
      <div class="col d-flex flex-column align-items-start gap-2">
        <h3 class="fw-bold">Simplifiez votre vie numérique avec notre plateforme de connexion de drives</h3>
        <p class="text-muted">Inscrivez-vous maintenant pour découvrir la simplicité de la gestion de vos drives en ligne.</p>
        <a href="page_Inscription.php" class="btn btn-primary btn-lg">S'inscrire</a>
      </div>

      <div class="col">
        <div class="row row-cols-1 row-cols-sm-2 g-4">
          <div class="col d-flex flex-column gap-2">
            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
              <svg class="bi" width="1em" height="1em">
                <use xlink:href="#collection"></use>
              </svg>
            </div>
            <h4 class="fw-semibold mb-0">Rapide</h4>
            <p class="text-muted">Connexion rapide et facile de tous vos drives</p>
          </div>

          <div class="col d-flex flex-column gap-2">
            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
              <svg class="bi" width="1em" height="1em">
                <use xlink:href="#gear-fill"></use>
              </svg>
            </div>
            <h4 class="fw-semibold mb-0">Centralisé</h4>
            <p class="text-muted">Accès centralisé à toutes vos données importantes</p>
          </div>

          <div class="col d-flex flex-column gap-2">
            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
              <svg class="bi" width="1em" height="1em">
                <use xlink:href="#speedometer"></use>
              </svg>
            </div>
            <h4 class="fw-semibold mb-0">Sécurité</h4>
            <p class="text-muted">Sécurité maximale pour vos fichiers en ligne</p>
          </div>

          <div class="col d-flex flex-column gap-2">
            <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
              <svg class="bi" width="1em" height="1em">
                <use xlink:href="#table"></use>
              </svg>
            </div>
            <h4 class="fw-semibold mb-0">Accès</h4>
            <p class="text-muted">Accès depuis n'importe où, sur n'importe quel appareil</p>
          </div>
        </div>
      </div>
    </div>
  </div>  

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

<?php
include_once "header_footer.php";

echo $footer;

?>