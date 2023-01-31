<?php
/**
 * @file Archive.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Archive
 * @details Super classe de l'archivage qui vas gérer le nom, la taille, et le chemin de la classe dossier et fichier
 * @version 2
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Super classe de l'archivage qui vas gérer le nom, la taille, et le chemin de la classe dossier et fichier
 */
class Archive {
  // ATTRIBUTS
  /**
   * @property string $nom 
   * Représentation du nom que va posséder l'objet
   */
  public $nom;

  /**
   * @property integer $taille 
   * Représentation de la taille que va posséder l'objet
   */
  public $taille;

  /**
   * @property string $chemin 
   * Représentaton du chemin que va posséder l'objet
   */
  public $chemin;
 
  // CONSTRUCTEUR
  /**
   * constructeur de la classe Archive demandant en paramètre le nom, la taille et le type de l'object Fichier ou dossier à créer
   *
   * @param string  $nom      Représentation du nom que va posséder l'objet
   * @param integer $taille   Représentation de la taille que va avoir l'objet
   * @param string  $chemin   Représentaton du chemin que va posséder l'objet
   */
  public function __construct($nom, $taille, $chemin)
  {
    $this->nom = $nom;        
    $this->taille = $taille;  
    $this->chemin = $chemin;
  }

  //  DESTRUCTEUR
  /**
   * @brief Destructeur de la classe
   */
  public function __destruct(){

  }

  // ENCASPULATION
  //public
  // MÉTHODE USUELLE
  /**
   * @brief Récupération du Nom de l'object
   * 
   * @return string
   */
  public function getNom(){return $this->nom;}
  
  /**
   * @brief Récupération de la Taille de l'objet
   * 
   * @return integer
   */
  public function getTaille(){return $this->taille;}
  
  /**
   * @brief Récupération du Chemin de l'objet
   *
   * @return string
   */
  public function getChemin(){return $this->chemin;}
  
  /**
   * @brief Modifie l'attribut Nom de l'object
   *  
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  
  /**
   * @brief Modifie l'attribut Taille de l'object
   * 
   * @param integer $taille Représentation de la taille que va avoir l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  
  /**
   * @brief Modifie l'attribut chemin de l'object
   * 
   * @param string $chemin Représentaton du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  
  // MÉTHODE SPÉCIFIQUE : NON
   
 
  }
 
 
 
?>