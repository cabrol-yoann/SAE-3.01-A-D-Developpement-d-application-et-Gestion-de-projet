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

  /**
   * @property integer $id Identifiant de l'objet dans la base de donnée
   */
  public $id;
 
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
      echo "Tag : ".$tagTraiter->getTitre()."\n";
      $this->mesTags->next();
    }
  }

  /**
   * fonction qui range un fichier dans un espace de stockage de l'utilisateur
   *
   * @param ObjectStorage $listeStockage liste de tous les espaces de stockage de l'utilisateur
   */
  public function meRanger($listeStockage, $restructurationEnCour = false) {
    /**
     * @var Stockage $espaceStockageTrouver Espace de stockage dans lequel le dossier peut être rangé
     * @var Dossier $meilleurEmplacement Dossier dans lequel le dossier peut être rangé
     * @var bool $trouver Indique si le dossier a été trouver ou non
     * @var ObjectStorage $listeDesStokagesATraiter Liste des espaces de stockage dans lesquels le dossier peut être rangé
     */
    $meilleurEmplacement = null;
    $trouver = false;
    // Recherche de l'espace de stockage le plus adapté
    $listeDesStokagesATraiter = $this->rechercheListeStockageATraiter($listeStockage,$restructurationEnCour);
    $listeDesStokagesATraiter->rewind();
    if (!$listeDesStokagesATraiter->valid()) {
      echo 'Aucun espace de stockage trouvé';echo '<br>';
      return;
    }
    while ($listeDesStokagesATraiter->valid()) {
      $trouver = false;
      $listeDesStokagesATraiter->current()->rechercheMeilleurEmplacement($this, $meilleurEmplacement, $trouver);
      if ($trouver) {
        $espaceStockageTrouver = $listeDesStokagesATraiter->current();
        echo 'Espace de stockage trouvé : '.$espaceStockageTrouver->getNom();echo '<br>';
      }
      $listeDesStokagesATraiter->next();
    }
    if (!isset($espaceStockageTrouver)) {
      echo 'Aucun espace de stockage trouvé';echo '<br>';
      return;
    }
    else {
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
      else if ($restructurationEnCour == true) {
        echo 'on ne peut pas stocker le fichier'.$this->getNom();echo '<br>';
        return;
      }
      else {
        echo 'Espace de stockage '.$espaceStockageTrouver->getNom().' plein';echo '<br>';
        echo 'Restructuration en cours';echo '<br>';
        $espaceStockageTrouver->restructuration($this, $meilleurEmplacement, $listeStockage);
        return;
      }
    }
  }

  /**
   * fonction qui recherche les espaces de stockage dans lesquels le dossier peut être rangé
   *
   * @param objectStorage $listeStockage liste de tous les espaces de stockage de l'utilisateur
   * @param boolean $restructuration Indique si on est en restructuration ou non
   * @return void
   */
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

  /**
   * fonction qui renomme le fichier si nécéssaire.
   *
   * @param Dossier $meilleurEmplacement Dossier dans lequel on veut placer le fichier
   * @return void
   */
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

  /**
   * fonction qui recherche le meilleur emplacement pour le fichier
   *
   * @param Dossier $meilleurEmplacement Dossier dans lequel on veut placer le fichier
   * @param integer $score Score du dossier analysé
   * @param boolean $trouver Indique si on a trouvé un dossier idéal
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche à placer le fichier
   * @return void
   */
  public function rechercheMeilleurEmplacement(&$meilleurEmplacement = null, &$score = 0, &$trouver = false, $DossierTraiter) {
    echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$DossierTraiter->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;
    

    //Recherche du meilleur emplacement pour les enfants qui sont des fichiers du dossier courant
    //Récupération de la liste des enfants Fichier.
    $listeEnfantFichier = $DossierTraiter->getListeEnfantFichier();
    $listeEnfantFichier->rewind();
    $compteur = 0;
    while ($listeEnfantFichier->valid()) {
      echo 'recherche d\'un emplacement pour '.$this->getNom().' en le comparent avec le fichier '.$listeEnfantFichier->current()->getNom();echo '<br>';
      //Recherche du meilleur emplacement pour les enfants du dossier courant à partir du tag
      $point += $this->rechercheTag($listeEnfantFichier->current());
      //recherhe du meilleur emplacement pour les enfants du dossier courant à partir du nom
      $point += $this->rechercheNom($listeEnfantFichier->current());
      // Recherche à partir du type
      $point += $this->rechercheType($listeEnfantFichier, $compteur);
      // fichier suivant
      $listeEnfantFichier->next();
    }

    //Recherche du meilleur emplacement pour les enfants qui sont des dossiers du dossier courant
    // Récupération de la liste des enfants Dossier 
    $compteur = 0;
    $listeEnfantDossier = $DossierTraiter->getListeEnfantDossier();
    while ($listeEnfantDossier->valid()) { 
      echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$listeEnfantDossier->current()->getNom();echo '<br>';
      //Recherche à partir du tag
      $point += $this->rechercheTag($listeEnfantDossier->current());
      // Recherche à partir du nom
      $point += $this->rechercheNom($listeEnfantDossier->current());
      // dossier suivant
      $listeEnfantDossier->next();
    }

    //Recherche du meilleur emplacement à partir du dossier courant
    //Recherche à partir du tag
    $point += $this->rechercheTag($DossierTraiter);
    //Recherche à partir du nom
    $point += $this->rechercheNom($DossierTraiter);

    //Enregistrement de valeur trouver
    if ($point > $score) {
      echo 'Le dossier '.$DossierTraiter->getNom().' a été trouver avec un score de '.$point;echo '<br>';
      $score = $point;
      $meilleurEmplacement = $DossierTraiter;
      $trouver = true ;
    }
    
    //Regarde les enfants
    $listeEnfantDossier->rewind();
    while ($listeEnfantDossier->valid()) {
      //$this->rechercheMeilleurEmplacement($listEnfantDossier->current(), $meilleurEmplacement, $score, $trouver);
      $listeEnfantDossier->next();
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le fichier à partir du nom
   *
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche à placer le fichier
   * @return 1
   */
  private function rechercheTag($DossierTraiter) {
    $listeTag = $this->getMesTags();
    $listeTagEnfant = $DossierTraiter->getMesTags();
    $listeTagEnfant->rewind();
    while($listeTagEnfant->valid()) {
      $listeTag->rewind();
      while ($listeTag->valid()) {
        if ($listeTag->current()->getTitre() == $listeTagEnfant->current()->getTitre()) {
          echo 'tag trouver';echo '<br>';
          return 1;
        }
        $listeTag->next();
      }
      $listeTagEnfant->next();
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le fichier à partir du type
   *
   * @param ObjectStorage $listeEnfantDossier Liste des enfants Fichier du dossier courant 
   * @param integer $compteur Nombre de fichier que l'on a trouvé avec le type dans le dossier
   * @return 1
   */
  private function rechercheType($listeEnfantDossier, &$compteur) {
    if ($listeEnfantDossier->current()->getType() == $this->getType()) {
      $compteur++;
      if ($compteur == $listeEnfantDossier->count()) {
        echo 'type trouver';echo '<br>';
        return 1;
      } 
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le fichier à partir du nom
   *
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche à placer le fichier
   * @return 1
   */
  private function rechercheNom($DossierTraiter) {
    if ($DossierTraiter->getNom() == $this->getNom()) {
      echo 'nom trouver';echo '<br>';
      return 1;
    }
  }
}
?>