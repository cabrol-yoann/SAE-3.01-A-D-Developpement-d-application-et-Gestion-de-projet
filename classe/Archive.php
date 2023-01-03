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
   * @var int
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
   * constructeur de la classe objet
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   * @param int $taille    Représentation de la taille que va avoir l'objet
   * @param string $chemin Représentaton du chemin que va posséder l'objet
   * @return void
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
   *
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
   * Fonction de récupération du Nom de l'object
   *
   * @return string
   */
  public function getNom(){return $this->nom;}
  /**
   * Fonction de récupération de la Taille de l'objet
   *
   * @return string
   */
  public function getTaille(){return $this->taille;}
  /**
   * Fonction de récupération du Chemin de l'objet
   *
   * @return string
   */
  public function getChemin(){return $this->chemin;}
  /**
   * Fonction de modification de l'attribut Nom
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  /**
   * Fonction de modification de l'attribut Taille
   *
   * @param int $taille Représentation de la taille que va avoir l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  /**
   * Fonction de modification de l'attribut chemin
   *
   * @param string $chemin Représentaton du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  // MÉTHODE SPÉCIFIQUE : NON
   
 
  }
 
 
 
?>