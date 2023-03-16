<?php
include_once "header_footer.php";
include_once "../DAO/UtilisateurDAO.php";
include_once "../DAO/Database.php";

echo $header;

?>

<div class="container mt-5">
    <h1>Connexion aux services de stockage en ligne</h1>
    <p>Cliquez sur l"icône d"un service pour vous connecter :</p>
    <div class="row text-center">
        <div class="col-md-2">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#google-drive-modal">
                <img src="https://img.icons8.com/color/96/000000/google-drive--v2.png" />
            </a>
        </div>
        <?php
            // Configurer les informations d'authentification OAuth pour Dropbox
            $dropbox_app_key = 'jaaxkhp8722sd6c';
            $dropbox_app_secret = 'tm79cqrc8x8uakl';
            $dropbox_redirect_uri = 'https://duolcloud5.alwaysdata.net/src/web/index.php';

            // Si l'utilisateur a cliqué sur le logo Dropbox
            if (isset($_GET['code'])) {
                // Obtenir le code d'autorisation depuis la requête
                $auth_code = $_GET['code'];

                // Construire l'URL pour demander le jeton d'accès
                $auth_url = 'https://api.dropbox.com/oauth2/token';
                $auth_params = array(
                    'code' => $auth_code,
                    'grant_type' => 'authorization_code',
                    'client_id' => $dropbox_app_key,
                    'client_secret' => $dropbox_app_secret,
                    'redirect_uri' => $dropbox_redirect_uri
                );

                // Envoyer une requête POST pour obtenir le jeton d'accès
                $auth_response = file_get_contents($auth_url, false, stream_context_create(array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => http_build_query($auth_params)
                    )
                )));

                // Analyser la réponse de la demande pour obtenir le jeton d'accès
                $auth_data = json_decode($auth_response, true);
                $access_token = $auth_data['access_token'];

                // Enregistrer le jeton d'accès pour une utilisation ultérieure
                // par exemple dans une base de données ou dans une session
                $bd = new UtilisateurDAO(Database::getInstance());
                $bd->setToken($_SESSION['id'], $access_token);
                $bd->__destruct();
                $_SESSION['dropbox_access_token'] = $access_token;
            }
        ?>
        <div class="col-md-2">
            <a href="https://www.dropbox.com/oauth2/authorize?response_type=code&client_id=<?php echo $dropbox_app_key; ?>&redirect_uri=<?php echo $dropbox_redirect_uri; ?>"
                class="drive-icon" data-toggle="modal" data-target="#dropbox-modal">
                <img src="https://img.icons8.com/color/96/000000/dropbox--v1.png" />
            </a>
        </div>
        <div class="col-md-2">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#icloud-modal">
                <img src="https://img.icons8.com/color/96/000000/icloud.png" />
            </a>
        </div>
        <div class="col-md-2">
            <a href="#" class="drive-icon" data-toggle="modal" data-target="#onedrive-modal">
                <img src="https://img.icons8.com/color/96/000000/microsoft-onedrive-2019" />
            </a>
        </div>
    </div>
</div>

<?php
include_once "header_footer.php";

echo $footer;

?>
