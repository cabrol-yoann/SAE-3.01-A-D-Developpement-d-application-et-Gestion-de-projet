<?php

include_once "Archive.php";
include_once "Tag.php";

/**
 * @file Fichier.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Fichier
 * @details Classe représentant un fichier physique à partir de son type et de ses tags héritant de la classe Archive lui donnant un nom, une taille et un chemin
 * @version 2.0
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Classe représentant un fichier physique à partir de son type et de ses tags héritant de la classe Archive lui donnant un nom, une taille et un chemin
 */
class Fichier extends Archive {
 
  // ATTRIBUT
  /**
   * @property string $type Représentation du type du fichier
   */
  public $type;
  
  /**
   * @property ObjectStorage $mesTags liste de tag associé à l'objet 
   */
  public $mesTags;
 
  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe Fichier demandant en paramètre le type du fichier, le nom, la taille et le chemin de l'objet Fichier à créer
   * @param string $type    Représentation du type du fichier
   * @param string $nom     Représentation du nom que va posséder l'objet
   * @param integer $taille     Représentation de la taille que va avoir l'objet
   * @param string $chemin  Représentaton du chemin que va posséder l'objet
   */
  public function __construct($nom, $taille, $chemin, $type)
  {
    $this->mesTags = new \SplObjectStorage();
    $this->type = $type;
    parent::__construct($nom, $taille, $chemin);
  }
  
  // DESTRUCTEUR
  /**
   * @brief Destructeur de la classe
   */
  public function __destruct(){
    parent::__destruct();
  }
  
  // ENCASPULATION
  //public
  /**
   * @brief Retourne le type de l'objet Fichier
   *
   * @return string
   */
  public function getType(){return $this->type;}
  
  /**
   * @brief Modifie l'attribut type de l'objet Fichier
   * 
   * @param string $type Représentation du type du fichier
   */
  public function setType($type){$this->type = $type;}
  
  /**
   * @brief Retourne la liste des tags de l'objet Fichier
   * 
   * @return SplObjectStorage de tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }
  
  /**
   * @brief Ajoute un tag a la liste de tag de l'objet Fichier
   *
   * @param Tag $tag Lien avec la classe tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }
  
  /**
   * @brief Supprime un Tag de la liste des tags de l'objet Fichier
   *
   * @param Tag $tag Lien avec la classe tag
   */
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  // MÉTHODE SPÉCIFIQUE :

  public function afficher() {
    echo "Fichier : ".$this->getNom()." ".$this->getTaille()." ".$this->getChemin()." ".$this->getType()."\n";
    $this->mesTags->rewind();
    while ($this->mesTags->valid()) {
      $tagTraiter = $this->mesTags->current();
      echo "Tag : ".$tagTraiter->getNom()."\n";
      $this->mesTags->next();
    }
  }

  public function meRanger($listStockage) {
    $meilleurEmplacement = null;
    $trouver = false;
    $listeDesStokagesATraiter = $this->rechercheListeStockageATraiter($listStockage);
    $listeDesStokagesATraiter->rewind();
    while ($listeDesStokagesATraiter->valid()) {
      $listeDesStokagesATraiter->current()->rechercheMeilleurEmplacement($this, $meilleurEmplacement, $trouver);
      if ($trouver) {
        $espaceStockageTrouver = $listeDesStokagesATraiter->current();
        echo 'Espace de stockage trouvé : '.$espaceStockageTrouver->getNom();echo '<br>';
      }
      $listeDesStokagesATraiter->next();
    }
    //Regarde si l'on peut stocker le dossier dans l'espace de stockage
    $tailleCalculer = $espaceStockageTrouver->getTaille() + $this->getTaille();
    if ($espaceStockageTrouver->getTailleMax() > $tailleCalculer) {
      //Changement de nom si nécéssaire
      $this->meRenommer($meilleurEmplacement);
      //Ajout du dossier dans le dossier
      echo 'Ajout du fichier '.$this->getNom().' dans le dossier '.$meilleurEmplacement->getNom().' dans l\'espace '.$espaceStockageTrouver->getNom();echo '<br>';
      $meilleurEmplacement->ajouterEnfantFichier($this);
      return;
    }
  }

  public function rechercheListeStockageATraiter($listeStockage, $restructuration = false) {
    //initialisation
    /**
     * @var int $score Score du dossier analysé
     * @var string $nomDossierTrouver Nom du dossier que l'on a trouvé
     * @var SplObjectStorage $listStockage Liste des stockages dans lesquels on peut stocker le dossier
     * @var bool $trouver Pour savoir si on a trouvé un dossier
     * @var int $tailleCalculer Taille total calculé du dossier avec le fichier à ajouter
     */
    $listStockage = new \SplObjectStorage();
    $tailleCalculer = 0;
    //Recherche de taille
    $listeStockage->rewind(); // placement de l'itérateur au début de la structure
    
    while($listeStockage->valid()){
      $nomStockage = $listeStockage->current();
      $tailleCalculer = $nomStockage->getTaille() + $this->getTaille();
      //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
      if ($this->getTaille() < $nomStockage->getTailleMax()) {
        if ($tailleCalculer > $nomStockage->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
          if ($restructuration == false) {                                // Si on n'est pas en face de restructuration
            if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
            $listStockage->attach($nomStockage);
            }
          }
          elseif($restructuration == true && $nomStockage != $nomDossierTrouver) {    // Si on est en face de restructuration et que le stockage n'est pas celui du dossier à restructurer
            if ($nomStockage->getRestructurable() == true) {                        // Et restructurable (donc peut potentiellement être intégré)
              $listStockage->attach($nomStockage);
            }
          }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
          $listStockage->attach($nomStockage);
        }
      }
      $listeStockage->next();
    }

    //tri de la list
    trierList($listStockage);

    return $listStockage;
  }

  public function meRenommer($meilleurEmplacement) {
    
    //Variables pour le renommage du fichier
    $listeEnfantFichier= $meilleurEmplacement->getListeEnfantFichier();
    $compteur=1;
    // On parcours la liste des enfants du dossier pour trouver un nom de fichier qui existe déjà et on renomme le fichier à placer
    $listeEnfantFichier->rewind();
    while ($listeEnfantFichier->valid()) {
      $FichierTraiter = $listeEnfantFichier->current();
      if ($FichierTraiter->getNom() == $this->getNom()) {
        // Si le nom du fichier à placer est le même que celui d'un fichier déjà présent dans le dossier, on ajoute la valeur du compteur à la fin du nom du fichier à placer
        $this->setNom($this->getNom()."(".$compteur.")");
        $compteur++;
        $listeEnfantFichier->rewind();
      }
      $listeEnfantFichier->next();
    }
  }

  public function rechercheMeilleurEmplacement($DossierTraiter, &$meilleurEmplacement = null, &$score = 0, &$trouver = false) {
    echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$DossierTraiter->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;
    $compteur = 0;

    //Recherche du meilleur emplacement pour les enfants qui sont des fichiers du dossier courant
    //Récupération de la liste des enfants Fichier.
    $listEnfantFichier = $DossierTraiter->getListeEnfantFichier();
    $listEnfantFichier->rewind();
    while ($listEnfantFichier->valid()) {
      echo 'recherche d\'un emplacement pour '.$this->getNom().' en le comparent avec le fichier '.$listEnfantFichier->current()->getNom();echo '<br>';
      //Recherche du meilleur emplacement pour les enfants du dossier courant à partir du tag
      $listTag = $this->getMesTags();
      $listTagEnfant = $listEnfantFichier->current()->getMesTags();
      $listTagEnfant->rewind();
      while($listTagEnfant->valid()) {
        $listTag->rewind();
        while ($listTag->valid()) {
        if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
          $point++;
          echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
        }
          $listTag->next();
        }
        $listTagEnfant->next();
      }
      //recherhe du meilleur emplacement pour les enfants du dossier courant à partir du nom
      if ($DossierTraiter->getNom() == $listEnfantFichier->current()->getNom()) {
        $point++;
        echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
      }
        // Recherche à partir du type
      if ($listEnfantFichier->current()->getType() == $this->getType()) {
        $compteur++;
        if ($compteur == $listEnfantFichier->count()) {
          $point++;
          echo "Type trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
        } 
      }
      $listEnfantFichier->next();
    }

    //Recherche du meilleur emplacement pour les enfants qui sont des dossiers du dossier courant
    // Récupération de la liste des enfants Dossier 
    $listEnfantDossier = $DossierTraiter->getListeEnfantDossier();
    while ($listEnfantDossier->valid()) { 
      echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$listEnfantDossier->current()->getNom();echo '<br>';
      //Recherche à partir du tag
      $listTag = $this->getMesTags();
      $listTagEnfant = $listEnfantDossier->current()->getMesTags();
      $listTagEnfant->rewind();
      while($listTagEnfant->valid()) {
        $listTag->rewind();
        while ($listTag->valid()) {
          if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
            $point++;
            echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
          }
          $listTag->next();
        }
        $listTagEnfant->next();
      }
      // Recherche à partir du nom
      if ($listEnfantDossier->current()->getNom() == $this->getNom()) {
        $point++;
        echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
      }
      $listEnfantDossier->next();
    }

    //Recherche du meilleur emplacement à partir du dossier courant
    //Recherche à partir du tag
    $listTag = $this->getMesTags();
    $listTagEnfant = $DossierTraiter->getMesTags();
    $listTagEnfant->rewind();
    while($listTagEnfant->valid()) {
      $listTag->rewind();
      while ($listTag->valid()) {
        if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
          $point++;
          echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
        }
        $listTag->next();
      }
      $listTagEnfant->next();
    }
    //Recherche à partir du nom
    if ($DossierTraiter->getNom() == $this->getNom()) {
      $point++;
      echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
    }

    //Enregistrement de valeur trouver
    if ($point > $score) {
      echo 'Le dossier '.$DossierTraiter->getNom().' a été trouver avec un score de '.$point;echo '<br>';
      $score = $point;
      $meilleurEmplacement = $DossierTraiter;
      $trouver = true ;
    }
    
    //Regarde les enfants
    $listEnfantDossier->rewind();
    while ($listEnfantDossier->valid()) {
      //$this->rechercheMeilleurEmplacement($listEnfantDossier->current(), $meilleurEmplacement, $score, $trouver);
      $listEnfantDossier->next();
    }
  }
}
?>