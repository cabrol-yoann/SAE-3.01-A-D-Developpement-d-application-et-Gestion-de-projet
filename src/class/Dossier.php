<?php

include_once "Archive.php";
include_once "../code/trierList.php";
include_once "Tag.php";

/**
 * @file Dossier.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Fichier
 * @details Classe représentant un dossier physique à partir de son type et de ses tags héritant de la classe Archive lui donnant un nom, une taille et un chemin
 * @version 2
 * @date 2021-03-31
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Classe représentant d'un dossier physique la forme d'une classe
 */
class Dossier extends Archive {
  
  // ATTRIBUTS
  /**
   * @property integer $nbFichier Représentation du nombre de Fichier que possède l'objet
   */
  public $nbFichier;
  
  /**
   * @property ObjectStorage $listeEnfantDossier Représentation de la liste de dossier enfant présent dans l'objet
   */
  public $listeEnfantDossier;
  
  /**
   * @property ObjectStorage $listEnfantFichier Représentation de la liste de fichier enfant présent dans l'objet
   */
  public $listEnfantFichier;
  
  /**
   * @property ObjectStorage $mesTags liste de tag associé à l'objet
   */
  public $mesTags;

  // CONSTRUCTEUR
  /**
   * @brief Constructeur de la classe
   *
   * @param string $nom        Représentation du nom que va posséder l'objet
   * @param string $chemin     Représentaton du chemin que va posséder l'objet
   */
  public function __construct($nom, $chemin)
  {
    $this->listeEnfantDossier = new \SplObjectStorage();
    $this->listEnfantFichier = new \SplObjectStorage();
    $this->mesTags = new \SplObjectStorage();
    parent::__construct($nom, 0, $chemin);        
  }

  // DESTRUCTEUR
  /**
   * @brief Destructeur de la classe
   */
  public function __destruct(){
    parent::__destruct(); 
  }

  // ENCASPULATION
  //public
  // MÉTHODE USUELLE
  /**
   * @brief retourne le nombre de Fichier du Dossier
   *
   * @return int nombre de Fichier
   */
  public function getNbFichier() {
    return $this->nbFichier;
  }

  /**
   * @brief Modifie l'attribut nbFichier de l'objet Dossier
   * 
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setNbFichier() {
    $this->nbFichier = $this->listeEnfantDossier->count() + $this->listEnfantFichier->count();
  }
  
  /**
   * @brief retourne la liste des enfants dossier de l'objet Dossier
   * 
   * @return SplObjectStorage liste d'enfant Dossier
   */
  public function getListeEnfantDossier() {
    return  $this->listeEnfantDossier;
  }
  
  /**
   * @brief retourne la liste des enfants fichier de l'objet Dossier
   * 
   * @return SplObjectStorage liste d'enfant Fichier
   */
  public function getListeEnfantFichier() {
    return $this->listEnfantFichier;
  }

  /**
   * @brief retourne la liste des tags de l'objet Dossier
   * 
   * @return SplObjectStorage liste de Tag
   */
  public function getMesTags() {
    return $this->mesTags;
  }


  /**
   * @brief Retourne la valeur de la taille de l'objet Dossier en mettant à jour sa taille
   * 
   * @return integer $taille Représentation de la taille que va avoir l'objet
   */
  public function getTaille() {
    $this->taille = 0;
    $enfant = $this->getListeEnfantDossier();
    $enfant->rewind();
    while ($enfant->valid()) {
      $this->taille += $enfant->current()->getTaille();
      $enfant->next();
    }
    $enfant = $this->getListeEnfantFichier();
    $enfant->rewind();
    while ($enfant->valid()) {
      $this->taille += $enfant->current()->getTaille();
      $enfant->next();
    }
    return $this->taille;
  }

  /**
   * @brief Ajoute un Fochier à la liste de fichier de l'objet Dossier et met a jour sa taille
   * 
   * @param Fichier $fichier objet de la classe Fichier
   */
  public function ajouterEnfantFichier($fichier){
    $this->listEnfantFichier->attach($fichier);
    $this->taille = $this->taille + $fichier->getTaille();
    $fichier->setChemin($this->getChemin() . "/" . $this->getNom());
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Fichier de la liste des enfants fichier de l'objet Dossier et met a jour sa taille
   *   
   * @param Fichier $fichier objet de la classe Fichier
   */
  public function supprimerEnfantFichier($fichier) {
    $this->listEnfantFichier->detach($fichier);
    $this->taille = $this->taille - $fichier->getTaille();
    $fichier->setChemin("");
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Dossier à la liste des enfants dossier de l'objet Dossier et met a jour sa taille
   *
   * @param Dossier $dossier objet de la Dossier
   */
  public function ajouterEnfantDossier($dossier){
    $this->listeEnfantDossier->attach($dossier);
    $this->taille = $this->taille + $dossier->getTaille();
    $dossier->setChemin($this->chemin . "/" . $this->nom);
    $enfant = $dossier->getListeEnfantDossier();
    $enfant->rewind();
    while ($enfant->valid()) { 
      $dossier->ajouterEnfantDossier($enfant->current());
      $enfant->next();
    }
    $enfant = $dossier->getListeEnfantFichier();
    $enfant->rewind();
    while ($enfant->valid()) { 
      $dossier->ajouterEnfantFichier($enfant->current());
      $enfant->next();
    }
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Dossier de la liste des enfants dossier de l'objet Dossier et met a jour sa taille
   * 
   * @param Dossier $dossier objet de la classe Dossier
   */
  public function supprimerEnfantDossier($dossier) {
    $this->listeEnfantDossier->detach($dossier);
    $this->taille = $this->taille - $dossier->getTaille();
    $dossier->setChemin($dossier->getNom());
    $enfant = $dossier->getListeEnfantDossier();
    $enfant->rewind();
    while ($enfant->valid()) { 
      $enfant->current()->setChemin($dossier->getChemin(). "/" .$dossier->getNom());
      $enfant->next();
    }
    $enfant = $dossier->getListeEnfantFichier();
    $enfant->rewind();
    while ($enfant->valid()) { 
      $enfant->current()->setChemin($dossier->getChemin(). "/" .$enfant->current()->getNom());
      $enfant->next();
    }
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Tag à la liste des tags de l'objet Dossier
   *  
   * @param Tag $tag objet de la classe Tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }

  /**
   * @brief Supprime un Tag de la liste des tags de l'objet Dossier
   *
   * @param Tag $tag objet de la classe Tag
   */
  public function supprimerTags($tag){
    $this->mesTags->detach($tag);
  }

  // MÉTHODE SPÉCIFIQUE : 

  public function afficher() { 
    echo "Nom : " . $this->nom . "<br>";
    echo "Taille : " . $this->taille . "<br>";
    echo "Nombre de fichier : " . $this->nbFichier . "<br>";
    echo "Liste des enfants dossier : <br>";
    $this->listeEnfantDossier->rewind();
    while ($this->listeEnfantDossier->valid()) {
      echo "      ",$this->listeEnfantDossier->current()->getNom() . "<br>";
      $this->listeEnfantDossier->next();
    }
    echo "Liste des enfants fichier : <br>";
    $this->listEnfantFichier->rewind();
    while ($this->listEnfantFichier->valid()) {
      echo "      ",$this->listEnfantFichier->current()->getNom() . "<br>";
      $this->listEnfantFichier->next();
    }
    echo "Liste des tags : <br>";
    $this->mesTags->rewind();
    while ($this->mesTags->valid()) {
      echo "      ",$this->mesTags->current()->getTitre() . "<br>";
      $this->mesTags->next();
    }
  }

  /**
   * fonction qui range un dossier dans un espace de stockage de l'utilisateur
   *
   * @param ObjectStorage $listStockage liste de tous les espaces de stockage de l'utilisateur
   */
  public function meRanger($listeStockage, $restructurationEnCour = false) {
    /**
     * @var Stockage $espaceStockageTrouver Espace de stockage dans lequel le dossier peut être rangé
     * @var Dossier $meilleurEmplacement Dossier dans lequel le dossier peut être rangé
     * @var bool $trouver Indique si le dossier a été trouver ou non
     * @var ObjectStorage $listeDesStokagesATraiter Liste des espaces de stockage dans lesquels le dossier peut être rangé
     */
    $meilleurEmplacement = null;
    $trouver = false;
    // Recherche de l'espace de stockage le plus adapté
    $listeDesStokagesATraiter = $this->rechercheListeStockageATraiter($listeStockage,$restructurationEnCour);
    $listeDesStokagesATraiter->rewind();
    if (!$listeDesStokagesATraiter->valid()) {
      echo 'Aucun espace de stockage trouvé';echo '<br>';
      return;
    }
    while ($listeDesStokagesATraiter->valid()) {
      $listeDesStokagesATraiter->current()->rechercheMeilleurEmplacement($this, $meilleurEmplacement, $trouver);
      if ($trouver) {
        $espaceStockageTrouver = $listeDesStokagesATraiter->current();
        echo 'Espace de stockage trouvé : '.$espaceStockageTrouver->getNom();echo '<br>';
      }
      $listeDesStokagesATraiter->next();
    }
    //Regarde si l'on peut stocker le dossier dans l'espace de stockage
    $tailleCalculer = $espaceStockageTrouver->getTaille() + $this->getTaille();
    if ($espaceStockageTrouver->getTailleMax() > $tailleCalculer) {
      //Changement de nom si nécéssaire
      $this->meRenommer($meilleurEmplacement);
      //Ajout du dossier dans le dossier
      echo 'Ajout du fichier '.$this->getNom().' dans le dossier '.$meilleurEmplacement->getNom().' dans l\'espace '.$espaceStockageTrouver->getNom();echo '<br>';
      $meilleurEmplacement->ajouterEnfantFichier($this);
      return;
    }
    else if ($restructurationEnCour == false) {
      echo 'Restructuration de l\'espace de stockage '.$espaceStockageTrouver->getNom();echo '<br>';
      $espaceStockageTrouver->restructuration($this, $meilleurEmplacement, $listeStockage);
    }
    else {
      echo 'Le Dossier'.$this->getNom().'ne peut pas être stocker';echo '<br>';
    }
  }

  /**
   * fonction qui recherche les espaces de stockage dans lesquels le dossier peut être rangé
   *
   * @param ObjectStorage $listeStockage liste de tous les espaces de stockage de l'utilisateur
   * @param boolean $restructuration indique si on est en phase de restructuration ou non
   * @return $listeStockageTrouver liste des espaces de stockage dans lesquels le dossier peut être rangé
   */
  public function rechercheListeStockageATraiter($listeStockage, $restructuration = false) {
    //initialisation
    /**
     * @var int $score Score du dossier analysé
     * @var string $nomDossierTrouver Nom du dossier que l'on a trouvé
     * @var SplObjectStorage $listeStockageTrouver Liste des stockages dans lesquels on peut stocker le dossier
     * @var bool $trouver Pour savoir si on a trouvé un dossier
     * @var int $tailleCalculer Taille total calculé du dossier avec le fichier à ajouter
     */

    //Initialisation
    $listeStockageTrouver = new \SplObjectStorage();
    $tailleCalculer = 0;

    //Recherche de taille
    $listeStockage->rewind(); // placement de l'itérateur au début de la structure
    while($listeStockage->valid()){
      $StockageTraiter = $listeStockage->current();
      if ($this->getTaille() < $StockageTraiter->getTailleMax()) {
        //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
        $tailleCalculer = $StockageTraiter->getTaille() + $this->getTaille();
        if ($tailleCalculer > $StockageTraiter->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
          if ($restructuration == false) {                                // Si on n'est pas en face de restructuration
            if ($StockageTraiter->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
            $listeStockageTrouver->attach($StockageTraiter);
            }
          }
          elseif($restructuration == true && $StockageTraiter != $nomDossierTrouver) {    // Si on est en face de restructuration et que le stockage n'est pas celui du dossier à restructurer
            if ($StockageTraiter->getRestructurable() == true) {                        // Et restructurable (donc peut potentiellement être intégré)
              $listeStockageTrouver->attach($StockageTraiter);
            }
          }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
          $listeStockageTrouver->attach($StockageTraiter);
        }
      }
      $listeStockage->next();
    }

    //tri de la list
    trierList($listeStockageTrouver);

    return $listeStockageTrouver;
  }

  /**
   * fonction qui renomme le dossier si nécéssaire
   *
   * @param Dossier $meilleurEmplacement Dossier dans lequel on veut stocker le dossier
   */
  public function meRenommer($meilleurEmplacement){
    //Variables
    /**
     * @var int $compteur Compteur pour le changement de nom
     * @var string $nouveauNom Nouveau nom du dossier
     * @var SplObjectStorage $listeEnfantDossier Liste des enfants du dossier
     */
    $compteur=1;
    $nouveauNom = "";
    $listeEnfantDossier = $meilleurEmplacement->getListeEnfantDossier();

    //Pour changer le nom d'un dossier
    $listeEnfantDossier->rewind();
    while ($listeEnfantDossier->valid()) {
      $DossierTraiter= $listeEnfantDossier->current();
      if ($DossierTraiter->getNom() == $this->getNom()) {
        $nouveauNom = $this->getNom()."(".$compteur.")";
        $this->setNom($nouveauNom);
        $compteur++;
        $listeEnfantDossier->rewind();
      }
      $listeEnfantDossier->next();
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le dossier
   *
   * @param Dossier $meilleurEmplacement Dossier dans lequel on veut stocker le dossier
   * @param integer $score Score du dossier analysé
   * @param boolean $trouver Pour savoir si on a trouvé un dossier
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche le meilleur emplacement
   * @return void
   */

  public function rechercheMeilleurEmplacement($DossierTraiter, &$meilleurEmplacement = null,  &$trouver = false, &$score = 0) {
    //echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$DossierTraiter->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;
    
    //Recherche du meilleur emplacement pour les enfants qui sont des fichiers du dossier courant
    //Récupération de la liste des enfants Fichier.
    $listEnfantFichier = $DossierTraiter->getListeEnfantFichier();
    $listEnfantFichier->rewind();
    while ($listEnfantFichier->valid()) {
      echo 'recherche d\'un emplacement pour '.$this->getNom().' en le comparent avec le fichier '.$listEnfantFichier->current()->getNom();echo '<br>';
      //Recherche du meilleur emplacement pour les enfants du dossier courant à partir du tag
      $point += $this->rechercheTag($listEnfantFichier->current());
      //recherhe du meilleur emplacement pour les enfants du dossier courant à partir du nom
      $point += $this->rechercheNom($listEnfantFichier->current());
      $listEnfantFichier->next();
    }
    
    //Recherche du meilleur emplacement pour les enfants qui sont des dossiers du dossier courant
    // Récupération de la liste des enfants Dossier 
    $listEnfantDossier = $DossierTraiter->getListeEnfantDossier();
    while ($listEnfantDossier->valid()) { 
      echo 'recherche d\'un emplacement pour '.$this->getNom().' dans le dossier '.$listEnfantDossier->current()->getNom();echo '<br>';
      //Recherche à partir du tag
      $point += $this->rechercheTag($listEnfantDossier->current());
      // Recherche à partir du nom
      $point += $this->rechercheNom($listEnfantDossier->current());
      $listEnfantDossier->next();
    }
    
    //Recherche du meilleur emplacement à partir du dossier courant
    //Recherche à partir du tag
    $point += $this->rechercheTag($DossierTraiter);
    //Recherche à partir du nom
    $point += $this->rechercheNom($DossierTraiter);

    //Enregistrement de valeur trouver
    if ($point > $score) {
      echo 'Le dossier '.$DossierTraiter->getNom().' a été trouver avec un score de '.$point;echo '<br>';
      $score = $point;
      $meilleurEmplacement = $DossierTraiter;
      $trouver = true ;
    }
    
    //Regarde les enfants
    $listEnfantDossier->rewind();
    while ($listEnfantDossier->valid()) {
      //$this->rechercheMeilleurEmplacement($listEnfantDossier->current(), $meilleurEmplacement, $score, $trouver);
      $listEnfantDossier->next();
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le dossier à partir du nom
   *
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche le meilleur emplacement
   * @return 1
   */
  private function rechercheTag($DossierTraiter) {
    $listeTag = $this->getMesTags();
    $listeTagEnfant = $DossierTraiter->getMesTags();
    $listeTagEnfant->rewind();
    while($listeTagEnfant->valid()) {
      $listeTag->rewind();
      while ($listeTag->valid()) {
        if ($listeTag->current()->getTitre() == $listeTagEnfant->current()->getTitre()) {
          echo 'tag trouver';echo '<br>';
          return 1;
        }
        $listeTag->next();
      }
      $listeTagEnfant->next();
    }
  }

  /**
   * fonction qui recherche le meilleur emplacement pour le dossier à partir du tag
   *
   * @param Dossier $DossierTraiter Dossier dans lequel on cherche le meilleur emplacement
   * @return 1
   */
  private function rechercheNom($DossierTraiter) {
    if ($DossierTraiter->getNom() == $this->getNom()) {
      echo 'nom trouver';echo '<br>';
      return 1;
    }
  }
    
  public function rechercheDossierEtFichierARestructurer(&$somme,&$listeFichierARestructurer,&$trouver,$objetAPlacer ) {
    /**
     * @var SplObjectStorage $listeEnfantFichier Liste des enfants Fichier
     * @var SplObjectStorage $listeEnfantDossier Liste des enfants Dossier
     */
    $listeEnfantFichier = $this->getListeEnfantFichier();
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
        $this->supprimerEnfantFichier($listeEnfantFichier->current());
        //Test si on a trouver tout nos fichier
        if ($somme > $objetAPlacer->getTaille()) {
          $trouver = true;
          break;
        }
        $listeEnfantFichier->next();
      }
    }
    //Recherche avec les enfants
    $listeEnfantDossier = $this->getListeEnfantDossier();
    $listeEnfantDossier->rewind();
    while ($listeEnfantDossier->valid()) { 
      $listeEnfantDossier->current()->rechercheDossierEtFichierARestructurer($somme,$listeFichierARestructurer,$trouver,$objetAPlacer);
      $listeEnfantDossier->next();
    }
  }
}
?>