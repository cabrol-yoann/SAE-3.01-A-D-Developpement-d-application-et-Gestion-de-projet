<?php
include_once "header_footer.php";

echo $header;

?>

<?php
function generateInvitationLink() {
    $invitationCode = bin2hex(random_bytes(16));
    $invitationLink = "https://duolcloud5.alwaysdata.net/src/web/page_Partage.php?invitationCode=" . $invitationCode;
    return $invitationLink;
}
$invitationLink = generateInvitationLink();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="modal modal-sheet position-static d-block py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-5">Partage</h1>
            </div>
            <div class="modal-body py-0">
                <p>Le partage de fichiers peut être dangereux pour la sécurité de vos données personnelles.
                    Évitez de partager des informations sensibles.
                    Soyez prudent lorsque vous partagez des fichiers.</p>
            </div>
            <div class="modal-footer flex-column border-top-0">
                <button id="open-popup" class="btn btn-lg btn-primary w-100 mx-0 mb-2">Accepter</button>
            </div>
        </div>
    </div>
</div>

<div id="popup-container" class="modal" style="background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div id="popup" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partage</h5>
                <div class="confirmation-square position-absolute top-25 start-50 translate-middle bg-secondary px-3 py-2 mt-3 rounded-bottom text-light" id="confirmationSquare" hidden>
                    Lien copié !
                </div>
                <button id="close-popup" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici votre lien d'invitation :</p>
                <input type="text" id="copy-input" class="form-control" style="margin-bottom: 10px;"
                    placeholder="Lien à copier" value="<?php echo $invitationLink ?>">
            </div>
            <div class="modal-footer">
                <button id="copy-btn" class="btn btn-primary">Copier</button>
            </div>
        </div>
    </div>
</div>

<script>
const btnOpenPopup = document.getElementById('open-popup');
const popupContainer = document.getElementById('popup-container');
const popup = document.getElementById('popup');
const btnClosePopup = document.getElementById('close-popup');
const copyInput = document.getElementById('copy-input');
const copyBtn = document.getElementById('copy-btn');

btnOpenPopup.addEventListener('click', () => {
    popupContainer.style.display = 'block';
});

btnClosePopup.addEventListener('click', () => {
    popupContainer.style.display = 'none';
});

popupContainer.addEventListener('click', (e) => {
    if (e.target === popupContainer) {
        popupContainer.style.display = 'none';
    }
});

copyBtn.addEventListener('click', () => {
    copyInput.select();
    copyInput.setSelectionRange(0, 99999); /* Pour les navigateurs mobiles */
    document.execCommand("copy");
    showConfirmationMessage();
});

function showConfirmationMessage() {
    // Afficher le carré
    document.getElementById("confirmationSquare").hidden = false;
    // Masquer le carré après 2 secondes
    setTimeout(function() {
        document.getElementById("confirmationSquare").hidden = true;
    }, 2000);
}
</script>
<?php
include_once "header_footer.php";

echo $footer;

?>