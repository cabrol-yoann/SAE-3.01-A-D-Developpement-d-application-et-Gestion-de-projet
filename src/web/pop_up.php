<?php
$pop_up_errorConnexion = '
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="popup-container" class="modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div id="popup" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="align-self: center;" class="modal-title">Connexion échoué</h5>
            </div>
            <div class="modal-body">
                <p>La connexion a échoué vérifier votre adress mail ou votre mot de passe</p>
                <button id="close-popup" type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" data-bs-dismiss="modal"
                    aria-label="Close">fermer</button>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
const popupContainer = document.getElementById("popup-container");
const popup = document.getElementById("popup");
const btnClosePopup = document.getElementById("close-popup");

window.addEventListener("load", () => {
    popupContainer.style.display = "block";
});

btnClosePopup.addEventListener("click", () => {
    popupContainer.style.display = "none";
});
</script>';

$pop_up_connexion = '
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="popup-container" class="modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div id="popup" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="align-self: center;" class="modal-title">Bienvenue</h5>
            </div>
            <div class="modal-body">
                <p>La connexion a bien été réalisé</p>
                <button id="close-popup" type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" data-bs-dismiss="modal"
                    aria-label="Close">fermer</button>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
const popupContainer = document.getElementById("popup-container");
const popup = document.getElementById("popup");
const btnClosePopup = document.getElementById("close-popup");

window.addEventListener("load", () => {
    popupContainer.style.display = "block";
});

btnClosePopup.addEventListener("click", () => {
    popupContainer.style.display = "none";
});
</script>';

$pop_up_validationMdp = '
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="popup-container" class="modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div id="popup" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="align-self: center;" class="modal-title">Echec inscription</h5>
            </div>
            <div class="modal-body">
                <p>Les deux mot de passe ne sont pas valide</p>
                <button id="close-popup" type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" data-bs-dismiss="modal"
                    aria-label="Close">fermer</button>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
const popupContainer = document.getElementById("popup-container");
const popup = document.getElementById("popup");
const btnClosePopup = document.getElementById("close-popup");

window.addEventListener("load", () => {
    popupContainer.style.display = "block";
});

btnClosePopup.addEventListener("click", () => {
    popupContainer.style.display = "none";
});
</script>';

$pop_up_inscription = '
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div id="popup-container" class="modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div id="popup" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="align-self: center;" class="modal-title">Beivenue</h5>
            </div>
            <div class="modal-body">
                <p>L\'inscription c bien passer bienvenue sur Duolcloud</p>
                <button id="close-popup" type="button" class="btn btn-lg btn-primary w-100 mx-0 mb-2" data-bs-dismiss="modal"
                    aria-label="Close">fermer</button>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
const popupContainer = document.getElementById("popup-container");
const popup = document.getElementById("popup");
const btnClosePopup = document.getElementById("close-popup");

window.addEventListener("load", () => {
    popupContainer.style.display = "block";
});

btnClosePopup.addEventListener("click", () => {
    popupContainer.style.display = "none";
});
</script>';
?>