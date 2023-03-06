<?php


$nom_dossier = '../web/img/icon';
$dossier = opendir($nom_dossier);

while($fichier = readdir($dossier))
{
if($fichier != '.' && $fichier != '..')
{
    $nvNom = '';
    $path_parts = pathinfo($fichier);
    $nom = $path_parts ['filename'];
    $cpt = strlen($nom)-1;
    while ($cpt != 0){
        if ($nom[$cpt] == '-'){
            break;
        }
        $nvNom = $nom[$cpt].$nvNom;
        $cpt--;
    }
    rename("../web/img/icon/".$nom.".png", $nvNom.".png");
    echo $nvNom; echo '<br>';
}
}
closedir($dossier);
?>