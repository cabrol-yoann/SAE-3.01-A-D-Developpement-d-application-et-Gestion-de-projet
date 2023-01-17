<?php
/**
 * @file Stockage.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Tag
 * @detais Classe représentent un espace de stockage physique à partir d'un nom, d'une taille, d'une tailleMax, d'un chemin et d'une restructuration
 * @version 2
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Classe représentent un espace de stockage physique à partir d'un nom, d'une taille, d'une tailleMax, d'un chemin et d'une restructuration
 */
class Stockage{
 
  // Attributs
  /**
   * Représentation du nom que va posséder l'objet
   *
   * @var string
   */
  public $nom;
  
  /**
   * Représentation de la taille que va posséder l'objet
   *
   * @var integer
   */
  public $taille;
  
  /**
   * Représentation de la tailleMax que va posséder l'objet
   *
   * @var integer
   */
  public $tailleMax;
  
  /**
   * Représentation du chemin que va posséder l'objet
   *
   * @var string
   */
  public $chemin;
  
  /**
   * Représentation de la restructuration que va posséder l'objet
   *
   * @var bool
   */
  public $restructurable;
  
  /**
   * Représentaion de l'enfant de l'objet
   *
   * @var Dossier
   */
  protected $maRacine;
  
  
  // CONSTRUCTEUR
  /**
   * Constructeur de la classe Stockage demandant en paramètre le nom, la tailleMax, le chemin et si le stockage est restructurable
   *
   * @param string $nom           Représentation du nom que va posséder l'objet
   * @param integer $tailleMax    Représentation de la tailleMax que va posséder l'objet
   * @param string $chemin        Représentation du chemin que va posséder l'objet
   * @param bool $restructurable  Représentation de la restructuration que va posséder l'objet
   */
  public function __construct($nom, $chemin, $tailleMax ,$restructurable)
  {
    $this->restructurable = $restructurable;
    $this->nom = $nom;
    $this->taille = 0;
    $this->chemin = $chemin;
    $this->tailleMax = $tailleMax;    
  }
  
  /**
   * Fonction de clonage de l'objet Stockage
   *
   * @param Stockage $Stockage objet à cloner
   */
  public function Clone($Stockage)
  {
    $this->restructurable = $Stockage->restructurable;
    $this->nom = $Stockage->nom;
    $this->taille = $Stockage->taille;
    $this->chemin = $Stockage->chemin;
    $this->tailleMax = $Stockage->tailleMax;
  }

  // DESTRUCTEUR
  /**
   * Destructeur de la classe
   */
  public function __destuct(){
   echo 'Destroying: ', $this->restructurable;
   echo 'Destroying: ', $this->nom;
   echo 'Destroying: ', $this->taille;
   echo 'Destroying: ', $this->chemin;
   echo 'Destroying: ', $this->tailleMax;
  }
  
  // ENCAPSULATION
  //public
  /**
   * Retourne le nom de l'object Stockage
   *
   * @return string
   */
  public function getNom(){return $this->nom;}
  
  /**
   * Retourne la taille de l'object Stockage
   *
   * @return integer
   */
  public function getTaille(){
    $this->taille = $this->maRacine->taille;
    return $this->taille;}
  
  /**
   * Retourne la tailleMax de l'object Stockage
   *
   * @return integer
   */
  public function getTailleMax(){return $this->tailleMax;}
  
  /**
   * Retourne le chemin de l'object Stockage
   *
   * @return string
   */
  public function getChemin(){return $this->chemin;}
 
  /**
   * Retourne true si l'object Sctockage est restructuration
   * false sinon
   *
   * @return bool
   */
  public function getRestructurable(){return $this->restructurable;}
  
  /**
   * Retourne la racine de l'object Stockage
   *
   * @return Dossier
   */
  public function getMaRacine(){return $this->maRacine;}
 
  /**
   * Modifie le nom de l'object Stockage
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  
  /**
   * Modifie la taille de l'object Stockage
   *
   * @param integer $taille Représentation de la taille que va posséder l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  
  /**
   * Modifie la tailleMax de l'object Stockage
   *
   * @param integer $tailleMax Représentation de la tailleMax que va posséder l'objet
   */
  public function setTailleMax($tailleMax){$this->tailleMax = $tailleMax;}
  
  /**
   * Modifie le chemin de l'object Stockage
   *
   * @param string $chemin Représentation du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  
  /**
   * Modifie l'attribue restructurable de l'object Stockage
   *
   * @param bool $restructurable Représentation de la restructuration que va posséder l'objet
   */
  public function setRestructurable($restructurable){$this->restructurable = $restructurable;}
  
  /**
   * Modifie la racine de l'object Stockage
   *
   * @param Dossier $racine Représentaion de l'enfant de l'objet
   */
  public function setMaRacine($racine){$this->maRacine = $racine;}
  
  // MÉTHODE USUELLES

  // MÉTHODE SPÉCIFIQUE : NON
}
?>