<?php

include_once "Archive.php";
include_once "Tag.php";

/**
 * @file Dossier.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Fichier
 * @detais Classe représentant un dossier physique à partir de son type et de ses tags héritant de la classe Archive lui donnant un nom, une taille et un chemin
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
   * Représentation le père du dossier
   *
   * @var Stockage
   */
  private $parent;

  /**
   * Représentation du nombre de Fichier que possède l'objet
   *
   * @var integer
   */
  public $nbFichier;
  
  /**
   * Représentation de la liste de dossier enfant présent dans l'objet
   *
   * @var ObjectStorage liste d'enfant Dossier
   */
  public $listeEnfantDossier;
  
  /**
   * Représentation de la liste de fichier enfant présent dans l'objet
   *
   * @var ObjectStorage liste d'enfant Fichier
   */
  public $listEnfantFichier;
  
  /**
   * Lien avec la classe tag
   *
   * @var ObjectStorage liste de tag
   */
  public $mesTags;

  // CONSTRUCTEUR
  /**
   * Constructeur de la classe
   *
   * @param string $nom        Représentation du nom que va posséder l'objet
   * @param integer $taille    Représentation de la taille que va avoir l'objet
   * @param string $chemin     Représentaton du chemin que va posséder l'objet
   */
  public function __construct($nom, $taille, $chemin)
  {
    $this->listeEnfantDossier = new \SplObjectStorage();
    $this->listEnfantFichier = new \SplObjectStorage();
    $this->mesTags = new \SplObjectStorage();
    parent::__construct($nom, $taille, $chemin);        
  }

  // DESTRUCTEUR
  /**
   * Destructeur de la classe
   */
  public function __destuct(){
    echo 'Destroying: ', $this->nbFichier;
    echo 'Destroying: ', $this->listeEnfantDossier;
    echo 'Destroying: ', $this->listEnfantFichier;
  }

  // ENCASPULATION
  //public
  // MÉTHODE USUELLE

  /**
   * retourne le nombre de Fichier du Dossier
   *
   * @return int
   */
  public function getParent() {
    return $this->parent->getNom();
  }
  

  /**
   * retourne le nombre de Fichier du Dossier
   *
   * @return int
   */
  public function getNbFichier() {
    return $this->nbFichier;
  }
  
  /**
   * Modifie l'attribut nbFichier de l'object Dossier
   *
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setNbFichier() {
    $this->nbFichier = $this->listeEnfantDossier->count() + $this->listEnfantFichier->count();
  }

    /**
   * Modifie l'attribut nbFichier de l'object Dossier
   *
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setParent($parent) {
    $this->parent = $parent;
  }
  
  /**
   * retourne la liste des enfants dossier de l'object Dossier
   *
   * @return SplObjectStorage liste d'enfant Dossier
   */
  public function getListeEnfantDossier() {
    return  $this->listeEnfantDossier;
  }
  
  /**
   * retourne la liste des enfants fichier de l'object Dossier
   *
   * @return SplObjectStorage liste d'enfant Fichier
   */
  public function getListeEnfantFichier() {
    return $this->listEnfantFichier;
  }

  /**
   * retourne la liste des tags de l'object Dossier
   *
   * @return SplObjectStorage liste de Tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }

  /**
   * Ajoute un Fochier à la liste de fichier de l'object Dossier
   *
   * @param Fichier $fichier object de la classe Fichier
   */
  public function ajouterEnfantFichier($fichier){
    $this->listEnfantFichier->attach($fichier);
    $this->taille += $fichier->taille;
    $this->setNbFichier();
  }

  /**
   * Supprime un Fichier de la liste des enfants fichier de l'object Dossier
   *
   * @param Fichier $fichier object de la classe Fichier
   */
  public function supprimerEnfantFichier($fichier) {
    $this->listEnfantFichier->detach($fichier);
    $this->setNbFichier();
  }

  /**
   * Ajoute un Dossier à la liste des enfants dossier de l'object Dossier
   *
   * @param Dossier $dossier object de la Dossier
   */
  public function ajouterEnfantDossier($dossier){
    $this->listeEnfantDossier->attach($dossier);
    $this->setNbFichier();
  }

  /**
   * Supprime un Dossier de la liste des enfants dossier de l'object Dossier
   *
   * @param Dossier $dossier object de la classe Dossier
   */
  public function supprimerEnfantDossier($dossier) {
    $this->listeEnfantDossier->detach($dossier);
    $this->setNbFichier();
  }

  /**
   * Ajoute un Tag à la liste des tags de l'object Dossier
   *
   * @param Tag $tag object de la classe Tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }

  /**
   * Supprime un Tag de la liste des tags de l'object Dossier
   *
   * @param Tag $tag object de la classe Tag
   */
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  // MÉTHODE SPÉCIFIQUE : 

  public function updateParentPoids() {
    if ($this->parent) {
        $this->parent->setTaille($this->taille);
    }
}

}
?>