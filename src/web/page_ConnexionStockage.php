<?php
include_once "header_footer.php";

echo $header;

?>

<div class="container mt-5">
    <h1>Connexion aux services de stockage en ligne</h1>
    <p>Cliquez sur l'icône d'un service pour vous connecter :</p>
    <div class="row">
        <div class="col-md-3">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#google-drive-modal">
                <img src="https://img.icons8.com/color/96/000000/google-drive--v2.png" />
            </a>
            <div class="modal fade" id="google-drive-modal" tabindex="-1" role="dialog"
                aria-labelledby="google-drive-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="google-drive-modal-label">Connexion à Google Drive</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire de connexion à Google Drive -->
                            <form>
                                <div class="form-group">
                                    <label for="google-drive-email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="google-drive-email"
                                        placeholder="Entrez votre adresse e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="google-drive-password">Mot de passe</label>
                                    <input type="password" class="form-control" id="google-drive-password"
                                        placeholder="Entrez votre mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#dropbox-modal">
                <img src="https://img.icons8.com/color/96/000000/dropbox--v1.png" />
            </a>
            <div class="modal fade" id="dropbox-modal" tabindex="-1" role="dialog" aria-labelledby="dropbox-modal-label"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dropbox-modal-label">Connexion à Dropbox</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire de connexion à Dropbox -->
                            <form>
                                <div class="form-group">
                                    <label for="dropbox-email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="dropbox-email"
                                        placeholder="Entrez votre adresse e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="dropbox-password">Mot de passe</label>
                                    <input type="password" class="form-control" id="dropbox-password"
                                        placeholder="Entrez votre mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#icloud-modal">
                <img src="https://img.icons8.com/color/96/000000/icloud.png" />
            </a>
            <div class="modal fade" id="icloud-modal" tabindex="-1" role="dialog" aria-labelledby="icloud-modal-label"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="icloud-modal-label">Connexion à iCloud Drive</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire de connexion à iCloud Drive -->
                            <form>
                                <div class="form-group">
                                    <label for="icloud-email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="icloud-email"
                                        placeholder="Entrez votre adresse e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="icloud-password">Mot de passe</label>
                                    <input type="password" class="form-control" id="icloud-password"
                                        placeholder="Entrez votre mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#onedrive-modal">
                <img src="https://img.icons8.com/color/96/000000/microsoft-onedrive-2019" />
            </a>
            <div class="modal fade" id="onedrive-modal" tabindex="-1" role="dialog"
                aria-labelledby="onedrive-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="onedrive-modal-label">Connexion à OneDrive</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire de connexion à OneDrive -->
                            <form>
                                <div class="form-group">
                                    <label for="onedrive-email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="onedrive-email"
                                        placeholder="Entrez votre adresse e-mail">
                                </div>
                                <div class="form-group">
                                    <label for="onedrive-password">Mot de passe</label>
                                    <input type="password" class="form-control" id="onedrive-password"
                                        placeholder="Entrez votre mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                        </div>
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