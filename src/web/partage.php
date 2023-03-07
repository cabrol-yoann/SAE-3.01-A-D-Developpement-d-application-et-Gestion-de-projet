<?php
include_once "header_footer.php";

echo $header;

?>

<?php
function generateInvitationLink() {
    $invitationCode = bin2hex(random_bytes(16));
    $invitationLink = "http://lakartxela.iutbayonne.univ-pau.fr/~edsilva007/SAE/src/web/partage.php?invitationCode=" . $invitationCode;
    return $invitationLink;
}
$invitationLink = generateInvitationLink();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<div class="modal modal-sheet position-static d-block py-5" tabindex="-1" role="dialog" id="modalSheet">
  <div class="modal-dialog" role="document" >
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-bottom-0">
        <h1 class="modal-title fs-5">Partage</h1>
      </div>
      <div class="modal-body py-0">
        <p>En cliquant sur le bouton "Accepter", vous consentez à ce que vos fichiers soient partagés avec d'autres utilisateurs. 
          Avant de donner votre accord, veuillez bien lire les conditions d'utilisation et la politique de confidentialité.</p>
      </div>
      <div class="modal-footer flex-column border-top-0">
        <button id="open-popup" class="btn btn-lg btn-primary w-100 mx-0 mb-2" >Accepter</button>
        </div>
    </div>
  </div>
</div>


<div id="popup-container" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: none;">
  <div id="popup" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px;">
    <p>Voici votre lien d'invitation :</p>
    <input type="text" id="copy-input" style="margin-bottom: 10px;" value="<?php echo $invitationLink ?>" id="invitationLink" readonly><br>
    <button id="copy-btn" style="background-color: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Copier</button>
    <button id="close-popup" style="background-color: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Fermer</button>
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
});
</script>

<?php
include_once "header_footer.php";

echo $footer;

?>