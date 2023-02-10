<?php
/**
 * @file index.php
 * @author Gouaud Romain
 * @details Page affichant les stockages et leurs arborésences avec un formulaire pour tester les ajouts
 * @version 4.0
 */
 

include_once "../code/baseDeDonneePhysique.php";
include_once "header_footer.php";

echo $header;

echo '<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Duolcloud</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css"/>
    </head>
    <body>';

    // Afficher les stockages et leurs arborésences -> Ici les stockages sont passé en paramètre depuis l'import d'un fichier
    $stockage->rewind();
    while($stockage->valid()) {
        echo '<h1>'.$stockage->current()->getNom().'</h1>';
        echo '<div class="pictos">
        <a class="picto-item" href="#" aria-label="navigation super cool"><img src="img/icon/infoBulle.png" alt="information supplémentaire"></a>
        </div>';
        echo '<p> Nom : '.$stockage->current()->getNom().' | '.
        'Taille : '.$stockage->current()->getTaille().' | '.
        ' Taille maximale : '.$stockage->current()->getTailleMax();
        echo '<br></p><hr>';
        echo '</p>';
        echo '<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
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

        echo  '<hr>';
        $stockage->next();
    } 
    
    // formulaire du fichier à ajouter (possibilité de choisir un fichier .txt)
    echo '<form action="nv" class="dropzone" id="dropzone-area" ></form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js”></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    </body>
    </html>';

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
    $espace ++;
    

    // Affichage des sous-dossiers -> récursif : rappel de la fonction pour chaque sous dossier
    $enfantsDoss = $racine->getListeEnfantDossier();
    $enfantsDoss->rewind();
    while($enfantsDoss->valid()){
        echo '<li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'" aria-expanded="false">
            <img src="img/icon/dossier.png" alt="icone fichier">'.$enfantsDoss->current()->getNom();
            
        if ($enfantsDoss->current()->getMesTags() != null) {
            echo ' | Tag : ';
            $DossTag = $enfantsDoss->current()->getMesTags();
            $DossTag->rewind();
            while($DossTag->valid()){
                echo '  '.$DossTag->current()->getTitre();
                $DossTag->next();
            }
        }
        echo '</button>
        <div class="collapse pl-'.$espace.'" id="'.str_replace(" ", "",$enfantsDoss->current()->getNom()).'" style="">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">';
        affichageContenu($enfantsDoss->current(), $espace);
        $enfantsDoss->next();
    }
    // Affichage des sous-fichiers  
    $enfantsFich = $racine->getListeEnfantFichier();
    $enfantsFich->rewind();
    while($enfantsFich->valid()){
        echo '<li><a class="link-dark d-inline-flex text-decoration-none rounded "><img src="img/icon/'.$enfantsFich->current()->getType().'.png" alt="icone fichier">'.$enfantsFich->current()->getNom().'.'.$enfantsFich->current()->getType().'</a></li>';
        $enfantsFich->next();
    }
    echo '
    </div>
    </li>
    </ul>';
}

  echo $footer
?>