<?php
include_once "header_footer.php";

echo $header;

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
<div class="container py-5 rounded" style="margin-top:20px; color: #1a202c; text-align: left; background-color: #e2e8f0;">

    <!-- /Breadcrumb -->

    <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="card"
                style="box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 0 solid rgba(0,0,0,.125); border-radius: .25rem;">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-settings mr-2">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg>Compte
                        </a>
                        <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shield mr-2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>Sécurité
                        </a>
                        <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-bell mr-2">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>Notification
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom mb-3 d-flex d-md-none">
                    <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                        <li class="nav-item">
                            <a href="#account" data-toggle="tab" class="nav-link has-icon active"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path
                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path>
                                </svg></a>
                        </li>
                        <li class="nav-item">
                            <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-shield">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg></a>
                        </li>
                        <li class="nav-item">
                            <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="account">
                        <h6>Compte</h6>
                        <hr>
                        <form>
                            <div class="form-group">
                                <label for="username">Nom</label>
                                <input type="text" class="form-control" id="username" aria-describedby="usernameHelp"
                                    placeholder="Enter your username" value="kennethvaldez">
                                  <small id="usernameHelp" class="form-text text-muted">Après avoir changé votre nom d'utilisateur, votre l'ancien nom d'utilisateur devient disponible pour toute autre personne.</small>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="d-block text-danger">Supprimer le compte</label>
                                <p class="text-muted font-size-sm">Une fois que vous avez supprimé votre compte, il n'y a plus de retour en arrière.
                                    Soyez certain.</p>
                            </div>
                            <button class="btn btn-danger" type="button">Supprimer le compte</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="security">
                        <h6>Sécurité</h6>
                        <hr>
                        <form>
                            <div class="form-group">
                                <label class="d-block">Changer le mot de passe</label>
                                <input type="text" class="form-control" placeholder="Enter your old password">
                                <input type="text" class="form-control mt-1" placeholder="New password">
                                <input type="text" class="form-control mt-1" placeholder="Confirm new password">
                            </div>
                        </form>
                        <hr>
                        <form>
                            <div class="form-group">
                                <label class="d-block">Authentification à deux facteurs</label>
                                <button class="btn btn-info" type="button">Activer l'authentification à deux facteurs</button>
                                <p class="small text-muted mt-2">L'authentification à deux facteurs ajoute une couche supplémentaire de
                                    la sécurité de votre compte en exigeant plus qu'un simple mot de passe pour vous connecter.</p>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="tab-pane" id="notification">
                        <h6>Notification</h6>
                        <hr>
                        <form>
                            <div class="form-group">
                                <label class="d-block mb-0">Alertes de sécurité</label>
                                <div class="small text-muted mb-3">Recevoir des notifications d'alerte de sécurité par e-mail</div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                    <label class="custom-control-label" for="customCheck1">Envoyez un e-mail à chaque fois qu'un
                                        la vulnérabilité se trouve</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
                                    <label class="custom-control-label" for="customCheck2">Envoyer par e-mail un résumé de vulnérabilité</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include_once "header_footer.php";

echo $footer;

?>