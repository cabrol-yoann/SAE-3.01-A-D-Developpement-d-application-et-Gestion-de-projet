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
   * @property int $nom Représentation de l'identifiant que va posséder l'objet
   */
  public $id;

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
  public function __construct($nom, $chemin, $tailleMax ,$restructurable, $id = null)
  {
    $this->id = $id;
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
    $this->id = $Stockage->id;
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

   * @brief Récupération de l'identifiant de l'objet
   * 
   * @return integer
   */
  public function getId(){return $this->id;}


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
 * @brief Modifiue l'attribut id de l'objet
 * 
 * @param integer $id représente l'identifiant que va posséder l'objet
 */
  public function setId($id){$this->id = $id;}
 
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
        $objetAPlacer->rechercheMeilleurEmplacement($listeEnfantDossier->current(), $meilleurEmplacement, $trouver, $score);
        $listeEnfantDossier->next();
      }
    }
  }
  
    public function rechercheDossierEtFichierARestructurer(&$somme,&$trouver,$objetAPlacer ) {
    /**
       * @var SplObjectStorage $listeEnfantFichier Liste des enfants Fichier
       * @var SplObjectStorage $listeEnfantDossier Liste des enfants Dossier
       */
      $listeFichierARestructurer = new SplObjectStorage();
      $listeEnfantFichier = $this->getMaRacine()->getListeEnfantFichier();
      $listeEnfantFichier->rewind();
      if ($trouver == true) {
          //Fin procedure
          return;
      }
      elseif ($listeEnfantFichier->valid()) {
          //Debut de la recherche
          $listeEnfantFichier->rewind();
          while ($listeEnfantFichier->valid()) {
              $somme = $somme + $listeEnfantFichier->current()->getTaille();
              $listeFichierARestructurer->attach($listeEnfantFichier->current());
              $this->getMaracine()->supprimerEnfantFichier($listeEnfantFichier->current());
              //Test si on a trouver tout nos fichier
              if ($somme > $objetAPlacer->getTaille()) {
                  $trouver = true;
                  break;
              }
              $listeEnfantFichier->next();
          }
      }
      //Recherche avec les enfants
      $listeEnfantDossier = $this->getMaRacine()->getListeEnfantDossier();
      $listeEnfantDossier->rewind();
      while ($listeEnfantDossier->valid()) { 
          $listeEnfantDossier->current()->rechercheDossierEtFichierARestructurer($somme,$listeFichierARestructurer,$trouver,$objetAPlacer);
          $listeEnfantDossier->next();
      }
      return $listeFichierARestructurer;
  }
  

/**
 * @brief Fonction permettant de restructurer un dossier

 * @param Fichier $ObjetAPlacer Objet à placer
 * @param Dossier $nomDossierTrouver Dossier dans lequel on va restructurer
 * @param SplObjectStorage $Stockage liste des Stockage dans lequel on va restructurer 
 * @param bool $restructuration Booléen pour savoir si on est en cours de restructuration
 * @return void
 */
public function Restructuration($ObjetAPlacer,$nomDossierTrouver,$Stockage){
  /**
   * @var int $tailleCalculer Taille du dossier calculé apres ajout de l'$ObjetAPlacer
   * @var bool $trouver Booléen pour savoir si on a trouvé un dossier à restructurer
   * @var int $somme Somme des tailles des fichiers
   * @var SplObjectStorage $listeFichierARestructurer Liste des fichiers à restructurer 
   */

  //recherche fichier à restructurer
  $trouver = false;
  $somme = 0;
  $listeFichierARestructurer = new \SplObjectStorage();

  //Recherche des fichiers à restructurer
  $listeFichierARestructurer = $this->rechercheDossierEtFichierARestructurer($somme,$trouver,$ObjetAPlacer);

  //Recherche nouvel emplacement pour les fichiers
  $listeFichierARestructurer->rewind();
  while ($listeFichierARestructurer->valid()) { 
    //Initialisation de variable
    $restructurationEnCours = true;
    echo 'Restructuration en cours de '.$listeFichierARestructurer->current()->getNom().' dans '.$this->getNom().' <br>';
    //Recherche de l'espace de stockage pour le fichier en cours de restructuration
    //DebutRecherche est une fonction récursive qui prend en paramètre l'espace de stockage, le fichier à restructurer, un booléen pour savoir si on a trouvé un espace de stockage et le nom de l'espace de stockage trouvé
    $listeFichierARestructurer->current()->meRanger($Stockage,$restructurationEnCours);
    $listeFichierARestructurer->next();
  }
}
}
?>