<?php
/**
 * @file Stockage.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Tag
 * @details Classe représentent un espace de stockage physique à partir d'un nom, d'une taille, d'une tailleMax, d'un chemin et d'une restructuration
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
   * @property string $nom Représentation du nom que va posséder l'objet
   */
  public $nom; 
  
  /**
   * @property integer $taille Représentation de la taille que va posséder l'objet
   */
  public $taille;
  
  /**
   * @property integer $tailleMax Représentation de la tailleMax que va posséder l'objet
   */
  public $tailleMax;
  
  /**
   * @property string $chemin Représentation du chemin que va posséder l'objet
   */
  public $chemin;
  
  /**
   * @property bool $restructurable Représentation de la restructuration que va posséder l'objet
   */
  public $restructurable;
  
  /**
   * @property Dossier $maRacine Représentaion de l'enfant de l'objet
   */
  protected $maRacine;
  
  
  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe Stockage demandant en paramètre le nom, la tailleMax, le chemin et si le stockage est restructurable
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
   * @brief Fonction de clonage de l'objet Stockage
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
    $this->maRacine = $Stockage->maRacine;
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
   * @brief Retourne le nom de l'objet Stockage
   *
   * @return string
   */
  public function getNom(){return $this->nom;}
  
  /**
   * @brief Retourne la taille de l'objet Stockage
   *
   * @return integer
   */
  public function getTaille(){
    $this->taille = $this->maRacine->getTaille();
    return $this->taille;}
  
  /**
   * @brief Retourne la tailleMax de l'objet Stockage
   *
   * @return integer
   */
  public function getTailleMax(){return $this->tailleMax;}
  
  /**
   * @brief Retourne le chemin de l'objet Stockage
   *
   * @return string
   */
  public function getChemin(){return $this->chemin;}
 
  /**
   * @brief Retourne true si l'objet Sctockage est restructuration false sinon
   *
   * @return bool
   */
  public function getRestructurable(){return $this->restructurable;}
  
  /**
   * @brief Retourne la racine de l'objet Stockage
   *
   * @return Dossier
   */
  public function getMaRacine(){return $this->maRacine;}
 
  /**
   * @brief Modifie le nom de l'objet Stockage
   *
   * @param string $nom Représentation du nom que va posséder l'objet
   */
  public function setNom($nom){$this->nom = $nom;}
  
  /**
   * @brief Modifie la taille de l'objet Stockage
   *  
   * @param integer $taille Représentation de la taille que va posséder l'objet
   */
  public function setTaille($taille){$this->taille = $taille;}
  
  /**
   * @brief Modifie la tailleMax de l'objet Stockage
   * 
   * @param integer $tailleMax Représentation de la tailleMax que va posséder l'objet
   */
  public function setTailleMax($tailleMax){$this->tailleMax = $tailleMax;}
  
  /**
   * @brief Modifie le chemin de l'objet Stockage
   * 
   * @param string $chemin Représentation du chemin que va posséder l'objet
   */
  public function setChemin($chemin){$this->chemin = $chemin;}
  
  /**
   * @brief Modifie l'attribue restructurable de l'objet Stockage
   *
   * @param bool $restructurable Représentation de la restructuration que va posséder l'objet
   */
  public function setRestructurable($restructurable){$this->restructurable = $restructurable;}
  
  /**
   * @brief Modifie la racine de l'objet Stockage
   *
   * @param Dossier $racine Représentaion de l'enfant de l'objet
   */
  public function setMaRacine($racine){$this->maRacine = $racine;}
  
  // MÉTHODE USUELLES

  // MÉTHODE SPÉCIFIQUE : 
  
  /**
   * fonction qui permet de rechercher un emplacement pour un objet
   *
   * @param Dossier/Fichier $objetAPlacer objet à placer
   * @param Dossier $meilleurEmplacement emplacement le plus favorable
   * @param boolean $trouver si l'on a trouvé un emplacement
   * @param integer $score score de l'emplacement
   * @return void
   */
  public function rechercheMeilleurEmplacement($objetAPlacer, &$meilleurEmplacement = null,  &$trouver = false, &$score = 0) {
    echo 'recherche d\'un emplacement pour '.$objetAPlacer->getNom().' dans le stockage '.$this->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;

    // Récupération de la liste des enfants Dossier 
    $listeEnfantDossier = $this->getMaRacine()->getListeEnfantDossier();
    //Recherche du meilleur emplacement pour les enfants du dossier courant
    while ($listeEnfantDossier->valid()) { 
      echo 'recherche d\'un emplacement pour '.$objetAPlacer->getNom().' dans le dossier '.$listeEnfantDossier->current()->getNom();echo '<br>';
      //Recherche du meilleur emplacement pour le dossier courant à partir du tag
      $listTag = $objetAPlacer->getMesTags();
      $listTagEnfant = $listeEnfantDossier->current()->getMesTags();
      $listTagEnfant->rewind();
      while($listTagEnfant->valid()) {
        $listTag->rewind();
        while ($listTag->valid()) {
        if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
          $point++;
          echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
        }
        $listTag->next();
        }
          $listTagEnfant->next();
      }
      //Recherche du meilleur emplacement pour le dossier courant à partir du tag
      if ($listeEnfantDossier->current()->getNom() == $objetAPlacer->getNom()) {
        $point++;
        echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
      }
      $listeEnfantDossier->next();
    }

    // Enregsitrement du meilleur emplacement trouvé a partir du score
    if ($point > $score) {
        echo 'Le dossier '.$this->getNom().' a été trouver avec un score de '.$point;echo '<br>';
        $score = $point;
        $meilleurEmplacement = $this;
        $trouver = true ;
    }

    //Regarde les enfants
    $listeEnfantDossier->rewind();
    if (isset($listeEnfantDossier)) {
      while ($listeEnfantDossier->valid()) {
        $objetAPlacer->rechercheMeilleurEmplacement($meilleurEmplacement, $score, $trouver, $listeEnfantDossier->current());
        $listeEnfantDossier->next();
      }
    }
  }
}
?>