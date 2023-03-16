<?php

include_once "Archive.php";

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
class Stockage {
 
  // Attributs
  
  public $id;

  /**
   * 
   */
  public $nom;

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
  public $maRacine;

  /**
   * @property int $idUtilisateur ID de l'utilisateur propriétaire du stockage
   */
  public $idUtilisateur;
  
  
  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe Stockage demandant en paramètre le nom, la tailleMax, le chemin et si le stockage est restructurable
   *
   * @param string $nom           Représentation du nom que va posséder l'objet
   * @param integer $tailleMax    Représentation de la tailleMax que va posséder l'objet
   * @param integer $taille       Représentation de la taille que va posséder l'objet
   * @param string $chemin        Représentation du chemin que va posséder l'objet
   * @param bool $restructurable  Représentation de la restructuration que va posséder l'objet
   * @param integer $id           Représentation de l'id de l'objet en base de données
   * @param integer $idUtilisateur ID de l'utilisateur propriétaire du stockage
   * @param Dossier $maRacine     Représentaion de la racine du stockage (equivalent / sous linux)
   */
  public function __construct($nom, $taille, $tailleMax, $restructurable, $chemin, $idUtilisateur, $maRacine, $id = null)
  {
    $this->id = $id;
    $this->nom = $nom;
    $this->taille = $taille;
    $this->tailleMax = $tailleMax;  
    $this->restructurable = $restructurable;
    $this->chemin = $chemin;
    $this->$idUtilisateur = $idUtilisateur;
    $this->$maRacine = $maRacine;
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
  public function setMaRacine($racine){
    $this->maRacine = $racine;}

  /**
   * @brief Modifie l'utilisateur
   * @param string $utilisateur
   */
  public function setUtilisateur($utilisateur){
    $this->utilisateur = $utilisateur;
  }

  /**
   * @brief Retourne l'utilisateur
   * @return string
   */
  public function getUtilisateur(){
    return $this->utilisateur;
  }

  
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
      //Recherche du meilleur emplacement pour le dossier courant à partir du tag
      $listTag = $objetAPlacer->getMesTags();
      $listTagEnfant = $listeEnfantDossier->current()->getMesTags();
      $listTagEnfant->rewind();
      while($listTagEnfant->valid()) {
        $listTag->rewind();
        while ($listTag->valid()) {
        if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
          $point++;
        }
        $listTag->next();
        }
          $listTagEnfant->next();
      }
      //Recherche du meilleur emplacement pour le dossier courant à partir du tag
      if ($listeEnfantDossier->current()->getNom() == $objetAPlacer->getNom()) {
        $point++;
      }
      $listeEnfantDossier->next();
    }

    // Enregsitrement du meilleur emplacement trouvé a partir du score
    if ($point > $score) {
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
    //Recherche de l'espace de stockage pour le fichier en cours de restructuration
    //DebutRecherche est une fonction récursive qui prend en paramètre l'espace de stockage, le fichier à restructurer, un booléen pour savoir si on a trouvé un espace de stockage et le nom de l'espace de stockage trouvé
    $listeFichierARestructurer->current()->meRanger($Stockage,$restructurationEnCours);
    $listeFichierARestructurer->next();
  }
}

public function afficher(){
  
}
}
?>