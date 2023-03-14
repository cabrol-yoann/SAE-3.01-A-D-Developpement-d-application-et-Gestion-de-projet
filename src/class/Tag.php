<?php
/**
 * @file Tag.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Tag
 * @details Classe représentant un tag que l'on donne a des objet pour les spécifier
 * @version 2
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

 
/**
 * Classe représentant un tag que l'on donne a des objet pour les spécifier
 */
class Tag{ 
  // ATTRIBUTS
  /**
   * @property string $titre Représentation du titre(nom) que possède un tag
   */
  public $titre;

  /**
   * @property int $id Représentation de l'id d'un tag en base de donées
   */
  public $id;
  
  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe
   *
   * @param string $titre Représentation du titre(nom) que possède un tag
   * @param int $id Représentation de l'id d'un tag en base de donées
   */
  public function __construct($titre, $id =  null)
  {
    $this->titre = $titre;
    $this->id = $id;       
  }
  
  // DESTRUCTEUR
  /**
   * @brief Destructeur de la classe
   */
  public function __destruct(){
  }
  
  // ENCAPSULATION
  //public
  /**
   * @brief Retourne le titre de l'objet Tag
   *
   * @return string
   */
  public function getTitre(){return  $this->titre;}
  
  /**
   * @brief Modifie le titre de l'objet Tag
   *
   * @param string $titre Représentation du titre(nom) que possède un tag
   */
  public function setTitre($titre){$this->titre = $titre;}

  /**
   * @brief Retourne l'id de l'objet Tag
   *
   * @return int
   */
  public function getId()
  {
    return  $this->id;
  }

  /**
   * @brief Modifie l'id de l'objet Tag
   *
   * @param int $id Représentation de l'id d'un tag en base de donées
   */

  public function setId($id)
  {
    $this->id = $id;
  }

  
  // MÉTHODE USUELLE : NON
  
  // MÉTHODE SPÉCIFIQUE : NON
}
?>