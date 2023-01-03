<?php
/**
 * @file Tag.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief Fichier contenant la classe Tag
 * @detail Classe représentant un tag que l'on donne a des object pour les spécifier
 * @version 2
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

 
/**
 * Classe représentant un tag que l'on donne a des object pour les spécifier
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
   * Retourne le titre de l'object Tag
   *
   * @return string
   */
  public function getTitre(){return  $this->titre;}
  
  /**
   * Modifie le titre de l'object Tag
   *
   * @param string $titre Représentation du titre(nom) que possède un tag
   */
  public function setTitre($titre){$this->titre = $titre;}
  
  // MÉTHODE USUELLE : NON
  
  // MÉTHODE SPÉCIFIQUE : NON
}
?>