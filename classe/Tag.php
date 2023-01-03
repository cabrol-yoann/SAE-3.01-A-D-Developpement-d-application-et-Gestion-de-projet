<?php
/**
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @version 0.1
 * 
 * 
 * @copyright Copyright (c) 2022
 * 
 */

 
/**
 * Représentation d'un tag grâce à son titre
 */
class Tag{ 
  // ATTRIBUTS
  /**
   * Représentation du titre(nom) que possède un tag
   *
   * @var string
   */
  public $titre;
  
  // CONSTRUCTEUR
  /**
   * Constructeur de la classe
   *
   * @param string $titre Représentation du titre(nom) que possède un tag
   */
  public function __construct($titre)
  {
    $this->titre = $titre;      
  }
  
  // DESTRUCTEUR
  /**
   * Destructeur de la classe
   */
  public function __destuct(){
      echo 'Destroying: ', $this->titre;
  }
  
  // ENCAPSULATION
  //public
  /**
   * Fonction de récupération de l'attribut titre
   *
   * @return string
   */
  public function getTitre(){return  $this->titre;}
  /**
   * Fonction de modification de l'attribut titre
   *
   * @param string $titre Représentation du titre(nom) que possède un tag
   */
  public function setTitre($titre){$this->titre = $titre;}
  
  // MÉTHODE USUELLE : NON
  
  // MÉTHODE SPÉCIFIQUE : NON
}
?>