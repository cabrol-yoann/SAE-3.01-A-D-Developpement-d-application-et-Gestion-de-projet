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

echo $invitationLink;

?>

<?php
include_once "header_footer.php";

echo $footer;

?>