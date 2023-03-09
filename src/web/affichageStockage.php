<?php
/**
 * @file index.php
 * @author Gouaud Romain
 * @details Page affichant les stockages et leurs arborésences avec un formulaire pour tester les ajouts
 * @version 4.0
 */
 

include_once "../code/baseDeDonneePhysique.php";
include_once "pop_up.php";
include_once "header_footer.php";

echo $header;

    // Afficher les stockages et leurs arborésences -> Ici les stockages sont passé en paramètre depuis l'import d'un fichier
    $stockage->rewind();
    while($stockage->valid()) {
        echo '<div class="pictos">
        <h1>'.$stockage->current()->getNom().'</h1>
        <a class="picto-item" href="#" aria-label=" Nom : '.$stockage->current()->getNom().' | '.
        'Taille : '.$stockage->current()->getTaille().' | '.
        ' Taille maximale : '.$stockage->current()->getTailleMax(). '"><img src="img/icon/infoBulle.png" alt="information supplémentaire"></a>
        </div>';
        echo '<hr>';
        echo '<div class="flex-shrink-0 p-3 bg-white">
        <a class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
            <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-5 fw-semibold">'.$stockage->current()->getNom();
        // Affichage de la racine
        if ($stockage->current()->getMaRacine()->getMesTags() != null) {
            echo ' | Tag : ';
            $racineTag = $stockage->current()->getMaRacine()->getMesTags();
            while($racineTag->valid()){
                echo '  '.$racineTag->current()->getTitre();
                $racineTag->next();
            }
        }
        echo '</span>
        </a>
        <ul class="list-unstyled ps-0">';
        // affichage de l'arborésence
        affichageContenu($stockage->current()->getMaRacine());

        echo '<hr>';
        $stockage->next();
    } 

    // formulaire du fichier à ajouter (possibilité de choisir un fichier .txt)
    echo '<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <form action="../code/upload.php" method="post" enctype="multipart/form-data" class="dropzone" id="myDropzone">
        Sélectionnez le fichier à télécharger:<br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="text" name="tag" hint="Donner vos tags">
        <input type="submit" value="Télécharger le fichier" name="submit">
    </form>';
   echo $footer;

    var_dump($drive);

    if(isset($_GET['error'])) {
        if($_GET['error'] == "upload")
            echo $pop_up_upload;
        else if($_GET['error'] == "exist")
            echo $pop_up_exist;
        else if($_GET['error'] == "error")
            echo $pop_up_error;
        else if($_GET['error'] == "fichierTropGros")
            echo $pop_up_size;
        else if($_GET['error'] == "pasDeStockage")
            echo $pop_up_pasTrouver;
    }

/**
 * @brief Affichage de l'arborésence d'un stockage
 * @param Dossier $racine : dossier racine du stockage
 * @param Fichier $ajout : fichier ajouté (si il y en a un)
 * @param int $espace : espacement pour l'affichage de l'arborésence (0 par défaut, pas obligatoire)
 * @return void
 */
function affichageContenu($racine, $espace = 0) {
    // Gestion de l'espacement pour l'affichage de l'arborésence (décalage à droite des sous-dossiers / sous-fichiers)
    /**
     * @var int $i : compteur pour l'espacement
     * @var string $espacement : espacement à afficher
     * @var int $espace : nombre d'$espacement à ajouter
     */
    

    // Affichage des sous-dossiers -> récursif : rappel de la fonction pour chaque sous dossier
    $enfantsDoss = $racine->getListeEnfantDossier();
    $enfantsDoss->rewind();
    while($enfantsDoss->valid()){
        echo '<li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'" aria-expanded="false">';
            for($i=$espace; $i >= 0; $i--){echo'<a style="margin-right: '.strval(16.5).'px;">||</a>';}echo'<img src="img/icon/dossier.png" alt="icone fichier">'.$enfantsDoss->current()->getNom();
            
        if ($enfantsDoss->current()->getMesTags() != null) {
            $DossTag = $enfantsDoss->current()->getMesTags();
            $DossTag->rewind();
            echo '<a>'.' | Tag : ';
            while($DossTag->valid()){
                echo $DossTag->current()->getTitre().' ';
                $DossTag->next();
            }
            echo '</a>';
        }
        echo '</button>
        <div class="collapse pl-'.$espace.'" id="'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">';
        $espace++;
        affichageContenu($enfantsDoss->current(), $espace);
        $enfantsDoss->next();
    }
    // Affichage des sous-fichiers  
    $enfantsFich = $racine->getListeEnfantFichier();
    $enfantsFich->rewind();
    while($enfantsFich->valid()){
        echo '<li><a class="link-dark d-inline-flex text-decoration-none rounded ">';
        for($i=$espace; $i >= 0; $i--){echo'<a style="margin-right: '.strval(5).'px; margin-left: 13.5px;">||</a>';}echo'<img src="img/icon/'.$enfantsFich->current()->getType().'.png" alt="icone fichier">'.$enfantsFich->current()->getNom().'.'.$enfantsFich->current()->getType().'</a></li>';
        $enfantsFich->next();
    }
    echo '
    </ul>
    </div>
    </li>';
}
?>