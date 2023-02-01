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
   * @brief Retourne le type de l'object Fichier
   *
   * @return string
   */
  public function getType(){return $this->type;}
  
  /**
   * @brief Modifie l'attribut type de l'object Fichier
   * 
   * @param string $type Représentation du type du fichier
   */
  public function setType($type){$this->type = $type;}
  
  /**
   * @brief Retourne la liste des tags de l'object Fichier
   * 
   * @return SplObjectStorage de tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }
  
  /**
   * @brief Ajoute un tag a la liste de tag de l'object Fichier
   *
   * @param Tag $tag Lien avec la classe tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }
  
  /**
   * @brief Supprime un Tag de la liste des tags de l'object Fichier
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

  public function meRanger($listeStockage, $restructuration = false) {
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
      $listStockage->next();
    }
    if (!$listStockage->valid()) {
      echo 'le fichier ne peut pas être stocké dans aucun espace de stockage';
      exit();
    }

    //tri de la list
    trierList($listStockage);
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
}
?>