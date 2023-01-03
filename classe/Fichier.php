<?php

include_once "Archive.php";
include_once "Tag.php";

/**
 * @file Fichier.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief Fichier contenant la classe Fichier
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
   * Représentation du type du fichier
   * @var string
   */
  public $type;
  
  /**
   * Lien avec la classe tag
   * @var ObjectStorage liste de tag
   */
  public $mesTags;
 
  // CONSTRUCTEUR
  /**
   * Constructeur de la classe Fichier demandant en paramètre le type du fichier, le nom, la taille et le chemin de l'objet Fichier à créer
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
   * Destructeur de la classe
   */
  public function __destuct(){
    echo 'Destroying: ', $this->type;
    echo 'Destroying: ', $this->mesTags;
  }
  
  // ENCASPULATION
  //public
  /**
   * Retourne le type de l'object Fichier
   *
   * @return string
   */
  public function getType(){return $this->type;}
  
  /**
   * Modifie l'attribut type de l'object Fichier
   *
   * @param string $type Représentation du type du fichier
   */
  public function setType($type){$this->type = $type;}
  
  /**
   * Retourne la liste des tags de l'object Fichier
   *
   * @return SplObjectStorage de tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }
  
  /**
   * Ajoute un tag a la liste de tag de l'object Fichier
   * 
   * @param Tag $tag Lien avec la classe tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }
  
  /**
   * Supprime un Tag de la liste des tags de l'object Fichier
   *
   * @param Tag $tag Lien avec la classe tag
   */
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  // MÉTHODE SPÉCIFIQUE : NON 
}
?>