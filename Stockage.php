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
 * Classe représentent un espace de stockage physique à partir d'un nom, d'une taille, d'une tailleMax, d'un chemin et d'une restructuration
 */
class Stockage{
 
 // Attributs
 /**
  * Représentation du nom que va posséder l'objet
  *
  * @var string
  */
 public String $nom;
 /**
  * Représentation de la taille que va posséder l'objet
  *
  * @var int
  */
  public int $taille;
 /**
  * Représentation de la tailleMax que va posséder l'objet
  *
  * @var int
  */
 public int $tailleMax;
 /**
  * Représentation du chemin que va posséder l'objet
  *
  * @var string
  */
  public String $chemin;
 /**
  * Représentation de la restructuration que va posséder l'objet
  *
  * @var bool
  */
  public bool $restructurable;
 /**
  * Représentaion de l'enfant de l'objet
  *
  * @var Dossier
  */
  public $maRacine;
  
  
 // CONSTRUCTEUR
 /**
  * Constructeur de la classe
  *
  * @param string $nom    Représentation du nom que va posséder l'objet
  * @param int $taille       Représentation de la taille que va posséder l'objet
  * @param int $tailleMax      Représentation de la tailleMax que va posséder l'objet
  * @param string $chemin    Représentation du chemin que va posséder l'objet
  * @param bool $restructurable      Représentation de la restructuration que va posséder l'objet
  */
 public function __construct($nom, $taille, $chemin, $tailleMax ,$restructurable)
 {
   $this->restructurable = $restructurable;
   $this->nom = $nom;
   $this->taille = $taille;
   $this->chemin = $chemin;
   $this->tailleMax = $tailleMax;    
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
  * Fonction de récupération de l'attribut nom
  *
  * @return string
  */
  public function getNom(){return $this->nom;}
  /**
  * Fonction de récupération de l'attribut taille
  *
  * @return int
  */
  public function getTaille(){return $this->taille;}
  /**
  * Fonction de récupération de l'attribut tailleMax
  *
  * @return int
  */
  public function getTailleMax(){return $this->tailleMax;}
  /**
  * Fonction de récupération de l'attribut chemin
  *
  * @return string
  */
  public function getChemin(){return $this->chemin;}
  /**
  * Fonction de récupération de l'attribut restructuration
  *
  * @return bool
  */
  public function getRestructurable(){return $this->restructurable;}
  /**
   * Fonction de récupération de l'attribut maRacine
   *
   * @return Dossier
   */
  public function getMaRacine(){return $this->maRacine;}
 
  /**
   * Fonction de modification de l'attribut nom
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  /**
   * Fonction de modification de l'attribut taille
   *
   * @param int $taille Représentation de la taille que va posséder l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  /**
   * Fonction de modification de l'attribut tailleMax
   *
   * @param int $tailleMax Représentation de la tailleMax que va posséder l'objet
   */
  public function setTailleMax($tailleMax){$this->tailleMax = $tailleMax;}
  /**
   * Fonction de modification de l'attribut chemin
   *
   * @param string $chemin Représentation du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  /**
   * Fonction de modification de l'attribut restructurable
   *
   * @param bool $restructurable Représentation de la restructuration que va posséder l'objet
   */
  public function setRestructurable($restructurable){$this->restructurable = $restructurable;}
  /**
   * Fonction de modification de l'attribut maRacine
   *
   * @param Dossier $racine Représentaion de l'enfant de l'objet
   */
  public function setMaRacine($racine){$this->maRacine = $racine;}
  
 // MÉTHODE USUELLES
  public function __toString()
  {
    $enfant = $this->getMaRacine();
    $msg = "je suis l'espace ".$this->getNom()." et je possède l'enfant ".$enfant." qui possaide les enfant ".$enfant->__toString()."";
    return $msg;
  }
 // MÉTHODE SPÉCIFIQUE : NON
  
  
 }
  
 ?>