<?php

include_once "Archive.php";
include_once "Tag.php";

/**
 * @file Dossier.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Fichier
 * @details Classe représentant un dossier physique à partir de son type et de ses tags héritant de la classe Archive lui donnant un nom, une taille et un chemin
 * @version 2
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Classe représentant d'un dossier physique la forme d'une classe
 */
class Dossier extends Archive {
  
  // ATTRIBUTS
  /**
   * @property integer $nbFichier Représentation du nombre de Fichier que possède l'objet
   */
  public $nbFichier;
  
  /**
   * @property ObjectStorage $listeEnfantDossier Représentation de la liste de dossier enfant présent dans l'objet
   */
  public $listeEnfantDossier;
  
  /**
   * @property ObjectStorage $listEnfantFichier Représentation de la liste de fichier enfant présent dans l'objet
   */
  public $listEnfantFichier;
  
  /**
   * @property ObjectStorage $mesTags liste de tag associé à l'objet
   */
  public $mesTags;

  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe
   *
   * @param string $nom        Représentation du nom que va posséder l'objet
   * @param string $chemin     Représentaton du chemin que va posséder l'objet
   */
  public function __construct($nom, $chemin)
  {
    $this->listeEnfantDossier = new \SplObjectStorage();
    $this->listEnfantFichier = new \SplObjectStorage();
    $this->mesTags = new \SplObjectStorage();
    parent::__construct($nom, 0, $chemin);        
  }

  // DESTRUCTEUR
  /**
   * @brief Destructeur de la classe
   */
  public function __destruct(){
    echo 'Destroying: ', $this->nbFichier;
    echo 'Destroying: ', $this->listeEnfantDossier;
    echo 'Destroying: ', $this->listEnfantFichier;
  }

  // ENCASPULATION
  //public
  // MÉTHODE USUELLE
  /**
   * @brief retourne le nombre de Fichier du Dossier
   *
   * @return int
   */
  public function getNbFichier() {
    return $this->nbFichier;
  }
  
  /**
   * @brief Modifie l'attribut nbFichier de l'object Dossier
   * 
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setNbFichier() {
    $this->nbFichier = $this->listeEnfantDossier->count() + $this->listEnfantFichier->count();
  }
  
  /**
   * @brief retourne la liste des enfants dossier de l'object Dossier
   * 
   * @return SplObjectStorage liste d'enfant Dossier
   */
  public function getListeEnfantDossier() {
    return  $this->listeEnfantDossier;
  }
  
  /**
   * @brief retourne la liste des enfants fichier de l'object Dossier
   * 
   * @return SplObjectStorage liste d'enfant Fichier
   */
  public function getListeEnfantFichier() {
    return $this->listEnfantFichier;
  }

  /**
   * @brief retourne la liste des tags de l'object Dossier
   * 
   * @return SplObjectStorage liste de Tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }


  /**
   * @brief Retourne la valeur de la taille de l'objet Dossier en mettant à jour sa taille
   * 
   * @return integer $taille Représentation de la taille que va avoir l'objet
   */
  public function getTaille() {
    $this->taille = 0;
    $enfant = $this->getListeEnfantDossier();
    $enfant->rewind();
    while ($enfant->valid()) {
      $this->taille += $enfant->current()->getTaille();
      $enfant->next();
    }
    $enfant = $this->getListeEnfantFichier();
    $enfant->rewind();
    while ($enfant->valid()) {
      $this->taille += $enfant->current()->getTaille();
      $enfant->next();
    }
    return $this->taille;
  }

  /**
   * @brief Ajoute un Fochier à la liste de fichier de l'object Dossier et met a jour sa taille
   * 
   * @param Fichier $fichier object de la classe Fichier
   */
  public function ajouterEnfantFichier($fichier){
    $this->listEnfantFichier->attach($fichier);
    $this->taille = $this->taille + $fichier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Fichier de la liste des enfants fichier de l'object Dossier et met a jour sa taille
   *   
   * @param Fichier $fichier object de la classe Fichier
   */
  public function supprimerEnfantFichier($fichier) {
    $this->listEnfantFichier->detach($fichier);
    $this->taille = $this->taille - $fichier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Dossier à la liste des enfants dossier de l'object Dossier et met a jour sa taille
   *
   * @param Dossier $dossier object de la Dossier
   */
  public function ajouterEnfantDossier($dossier){
    $this->listeEnfantDossier->attach($dossier);
    $this->taille = $this->taille + $dossier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Dossier de la liste des enfants dossier de l'object Dossier et met a jour sa taille
   * 
   * @param Dossier $dossier object de la classe Dossier
   */
  public function supprimerEnfantDossier($dossier) {
    $this->listeEnfantDossier->detach($dossier);
    $this->taille = $this->taille - $dossier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Tag à la liste des tags de l'object Dossier
   *  
   * @param Tag $tag object de la classe Tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }

  /**
   * @brief Supprime un Tag de la liste des tags de l'object Dossier
   *
   * @param Tag $tag object de la classe Tag
   */
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  // MÉTHODE SPÉCIFIQUE : NON

}
?>