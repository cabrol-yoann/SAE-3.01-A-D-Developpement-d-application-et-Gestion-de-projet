<?php

include_once('Archive.php');
include_once("Tag.php");

/**
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @version 0.1
 * 
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * répresentation d'un dossier physique la forme d'une classe
 */
class Dossier extends Archive {
  // ATTRIBUTS
  /**
   * Représentation du nombre de Fichier que possède l'objet
   *
   * @var int
   */
  public int $nbFichier;
  /**
   * Représentation de la liste de dossier enfant présent dans l'objet
   *
   * @var liste de Dossier
   */
  public $listeEnfantDossier;
  /**
   * Représentation de la liste de fichier enfant présent dans l'objet
   *
   * @var liste de Fichier
   */
  public $listEnfantFichier;

  public $mesTags;

  // CONSTRUCTEUR
  /**
   * Constructeur de la classe
   *
   * @param string $nom        Représentation du nom que va posséder l'objet
   * @param int $taille           Représentation de la taille que va avoir l'objet
   * @param string $chemin        Représentaton du chemin que va posséder l'objet
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
   * Fonction de récupération de l'attribut nbFichier
   *
   * @return int
   */
  public function getNbFichier() {
    return $this->nbFichier;
  }
  /**
   * Fonction de modification de l'attribut nbFichier
   *
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setNbFichier() {
    $this->nbFichier = $this->listeEnfantDossier->count() + $this->listEnfantFichier->count();
  }
  /**
   * Fonction de récupération de l'attribut listeEnfantDossier
   *
   * @return liste
   */
  public function getListeEnfantDossier() {
    return  $this->listeEnfantDossier;
  }
  /**
   * Fonction de récupération de l'attribut listeEnfnatFichier
   *
   * @return Ficheir
   */
  public function getListeEnfantFichier() {
    return $this->listEnfantFichier;
  }

  public function getMesTags() {
    return $this->mesTags;
  }

  public function ajouterEnfantFichier($fichier){
    $this->listEnfantFichier->attach($fichier);
    $this->setNbFichier();
  }
  public function supprimerEnfantFichier($fichier) {
    $this->listEnfantFichier->detach($fichier);
    $this->setNbFichier();
  }
  public function ajouterEnfantDossier($dossier){
    $this->listeEnfantDossier->attach($dossier);
    $this->setNbFichier();
  }

  public function supprimerEnfantDossier($dossier) {
    $this->listeEnfantDossier->detach($dossier);
    $this->setNbFichier();
  }

  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  public function __toString()
  {
    $enfantFic = $this->getListeEnfantFichier();
    $enfantFic->rewind();
    $msg = "Je suis le dossier ".$this->getNom()." et je possède les enfant (";
    if($enfantFic->valid()) {
      $var = $enfantFic->current();
      $msg += $var ->__toString();
      $enfantFic->next();
    }
    $enfantDos = $this->getListeEnfantDossier();
    $enfantDos->rewind();
    if ($enfantDos->valid()) {
      $test = $enfantDos->curent();
      $msg += $test->__toString();
      $enfantDos->next();
    }
    $msg += ")";
    return $msg;
  }


  // MÉTHODE SPÉCIFIQUE : NON

}
?>