<?php
/**
 * @file Archive.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief Fichier contenant la classe Archive
 * @detais Super classe de l'archivage qui vas gérer le nom, la taille, et le chemin de la classe dossier et fichier
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
   * Représentation du nom que va posséder l'objet
   *
   * @var string
   */
  public $nom;
  /**
   * Représentation de la taille que va avoir l'objet
   *
   * @var integer
   */
  public $taille;
  /**
   * Représentaton du chemin que va posséder l'objet
   *
   * @var string
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
   * Destructeur de la classe
   */
  public function __destuct(){
  echo 'Destroying: ', $this->nom;
  echo 'Destroying: ', $this->taille;
  echo 'Destroying: ', $this->chemin;
  }

  // ENCASPULATION
  //public
  // MÉTHODE USUELLE
  /**
   * Récupération du Nom de l'object
   *
   * @return string
   */
  public function getNom(){return $this->nom;}
  
  /**
   * Récupération de la Taille de l'objet
   *
   * @return integer
   */
  public function getTaille(){return $this->taille;}
  
  /**
   * Récupération du Chemin de l'objet
   *
   * @return string
   */
  public function getChemin(){return $this->chemin;}
  
  /**
   * Modifie l'attribut Nom de l'object
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  
  /**
   * Modifie l'attribut Taille de l'object
   *
   * @param integer $taille Représentation de la taille que va avoir l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  
  /**
   * Modifie l'attribut chemin de l'object
   *
   * @param string $chemin Représentaton du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  
  // MÉTHODE SPÉCIFIQUE : NON
   
 
  }
 
 
 
?>