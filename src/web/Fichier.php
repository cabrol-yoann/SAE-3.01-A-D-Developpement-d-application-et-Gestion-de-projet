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
        <link rel="stylesheet" href="">
    </head>
    <body>';

    // Afficher les stockages et leurs arborésences -> Ici les stockages sont passé en paramètre depuis l'import d'un fichier
    $stockage->rewind();
    while($stockage->valid()) {
        echo '<h1>'.$stockage->current()->getNom().'</h1>';
        echo '<h2>Caractéristiques</h2>';
        echo '<p> Nom : '.$stockage->current()->getNom().' | '.
        'Taille : '.$stockage->current()->getTaille().' | '.
        ' Taille maximale : '.$stockage->current()->getTailleMax().' | '.
        'Restructurable  : ';
        if ($stockage->current()->getRestructurable()){
            echo 'oui';
        }
        else{
            echo "non";
        }
        echo '<br></p><hr>';

        echo "<h2>Contenu</h2>";

        // Affichage de la racine
        echo "<p> <strong>".$stockage->current()->getMaRacine()->getNom().'</strong>';
        if ($stockage->current()->getMaRacine()->getMesTags() != null) {
            echo ' | Tag : ';
            $racineTag = $stockage->current()->getMaRacine()->getMesTags();
            while($racineTag->valid()){
                echo '  '.$racineTag->current()->getTitre();
                $racineTag->next();
            }
        }
        echo '</p>';

        // affichage de l'arborésence
        affichageContenu($stockage->current()->getMaRacine(), $ajout);

        echo '<hr>';
        $stockage->next();
    } 
    
    // formulaire du fichier à ajouter (possibilité de choisir un fichier .txt)
    echo '<form action="#" method="post" enctype="multipart/form-data">
        <label for="fichier">Fichier à ajouter :</label>
        <input type="file" name="fichier" id="fichier"> <br>
        <label for="tag">Tag :</label>
        <input type="text" name="tag" id="tag" placeholder="Tag">
        <input type="submit" value="Ajouter">
    </form>';
        
echo '</body>
    </html>';

/**
 * @brief Affichage de l'arborésence d'un stockage
 * @param Dossier $racine : dossier racine du stockage
 * @param Fichier $ajout : fichier ajouté (si il y en a un)
 * @param int $espace : espacement pour l'affichage de l'arborésence (0 par défaut, pas obligatoire)
 * @return void
 */
function affichageContenu($racine, $ajout, &$espace = 0) {
    // Gestion de l'espacement pour l'affichage de l'arborésence (décalage à droite des sous-dossiers / sous-fichiers)
    /**
     * @var int $i : compteur pour l'espacement
     * @var string $espacement : espacement à afficher
     * @var int $espace : nombre d'$espacement à ajouter
     */
    $espace += 1;
    $espacement = "";
    for ($i = 0; $i < $espace; $i++) {
        $espacement = $espacement . "--";
    }

    // Affichage des sous-dossiers -> récursif : rappel de la fonction pour chaque sous dossier
    $enfantsDoss = $racine->getListeEnfantDossier();
    $enfantsDoss->rewind();
    while($enfantsDoss->valid()){
        echo "<p>".$espacement." <strong>".$enfantsDoss->current()->getNom().'</strong>';
    if ($enfantsDoss->current()->getMesTags() != null) {
        echo ' | Tag : ';
        $DossTag = $enfantsDoss->current()->getMesTags();
        $DossTag->rewind();
        while($DossTag->valid()){
            echo '  '.$DossTag->current()->getTitre();
            $DossTag->next();
        }
    }
        affichageContenu($enfantsDoss->current(), $ajout, $espace);
        $enfantsDoss->next();
    }

    // Affichage des sous-fichiers  
    $enfantsFich = $racine->getListeEnfantFichier();
    $enfantsFich->rewind();
    while($enfantsFich->valid()){
        if($enfantsFich->current() == $ajout){
            echo "<p style='color: red;'>
                <img src='img/icon/".$enfantsFich->current()->getType().".png' alt='icone fichier'>
                ".$espacement."- ".$enfantsFich->current()->getNom().".".$enfantsFich->current()->getType();
            $enfantTag=$enfantsFich->current()->getMesTags();
            if ($enfantTag->valid()) {
                echo ' | Tag : ';
                $FichTag = $enfantsFich->current()->getMesTags();
                $FichTag->rewind();
                while($FichTag->valid()){
                    echo '  '.$FichTag->current()->getTitre();
                    $FichTag->next();
                }
            }
        }
        else{
            echo "<p><img src='img/icon/".$enfantsFich->current()->getType().".png' alt='icone fichier'>".$espacement."- ".$enfantsFich->current()->getNom().".".$enfantsFich->current()->getType()."<p>";
        }
        $enfantsFich->next();
    }
}

echo '<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
<a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
  <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
  <span class="fs-5 fw-semibold">Collapsible</span>
</a>
<ul class="list-unstyled ps-0">
  <li class="mb-1">
    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
      Home
    </button>
    <div class="collapse show" id="home-collapse" style="">
      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Updates</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Reports</a></li>
      </ul>
    </div>
  </li>
  <li class="mb-1">
    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
      Dashboard
    </button>
    <div class="collapse" id="dashboard-collapse">
      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
      </ul>
    </div>
  </li>
  <li class="mb-1">
    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
      Orders
    </button>
    <div class="collapse" id="orders-collapse">
      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Processed</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li>
        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li>
      </ul>
    </div>
  </li>
</ul>
</div>';


  echo $footer
?>