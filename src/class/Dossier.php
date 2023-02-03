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
   * @return int
   */
  public function getNbFichier() {
    return $this->nbFichier;
  }
  
  /**
   * @brief Modifie l'attribut nbFichier de l'object Dossier
   * 
   * @param int $nbFic Représentation du nombre de Fichier que possède l'objet
  */
  public function setNbFichier() {
    $this->nbFichier = $this->listeEnfantDossier->count() + $this->listEnfantFichier->count();
  }
  
  /**
   * @brief retourne la liste des enfants dossier de l'object Dossier
   * 
   * @return SplObjectStorage liste d'enfant Dossier
   */
  public function getListeEnfantDossier() {
    return  $this->listeEnfantDossier;
  }
  
  /**
   * @brief retourne la liste des enfants fichier de l'object Dossier
   * 
   * @return SplObjectStorage liste d'enfant Fichier
   */
  public function getListeEnfantFichier() {
    return $this->listEnfantFichier;
  }

  /**
   * @brief retourne la liste des tags de l'object Dossier
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
   * @brief Ajoute un Fochier à la liste de fichier de l'object Dossier et met a jour sa taille
   * 
   * @param Fichier $fichier object de la classe Fichier
   */
  public function ajouterEnfantFichier($fichier){
    $this->listEnfantFichier->attach($fichier);
    $this->taille = $this->taille + $fichier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Fichier de la liste des enfants fichier de l'object Dossier et met a jour sa taille
   *   
   * @param Fichier $fichier object de la classe Fichier
   */
  public function supprimerEnfantFichier($fichier) {
    $this->listEnfantFichier->detach($fichier);
    $this->taille = $this->taille - $fichier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Dossier à la liste des enfants dossier de l'object Dossier et met a jour sa taille
   *
   * @param Dossier $dossier object de la Dossier
   */
  public function ajouterEnfantDossier($dossier){
    $this->listeEnfantDossier->attach($dossier);
    $this->taille = $this->taille + $dossier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Supprime un Dossier de la liste des enfants dossier de l'object Dossier et met a jour sa taille
   * 
   * @param Dossier $dossier object de la classe Dossier
   */
  public function supprimerEnfantDossier($dossier) {
    $this->listeEnfantDossier->detach($dossier);
    $this->taille = $this->taille - $dossier->getTaille();
    $this->setNbFichier();
  }

  /**
   * @brief Ajoute un Tag à la liste des tags de l'object Dossier
   *  
   * @param Tag $tag object de la classe Tag
   */
  public function ajouterTags($tag){
    $this->mesTags->attach($tag);
  }

  /**
   * @brief Supprime un Tag de la liste des tags de l'object Dossier
   *
   * @param Tag $tag object de la classe Tag
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
      echo $this->listeEnfantDossier->current()->getNom() . "<br>";
      $this->listeEnfantDossier->next();
    }
    echo "Liste des enfants fichier : <br>";
    $this->listEnfantFichier->rewind();
    while ($this->listEnfantFichier->valid()) {
      echo $this->listEnfantFichier->current()->getNom() . "<br>";
      $this->listEnfantFichier->next();
    }
    echo "Liste des tags : <br>";
    $this->mesTags->rewind();
    while ($this->mesTags->valid()) {
      echo $this->mesTags->current()->getNom() . "<br>";
      $this->mesTags->next();
    }
  }

  public function meRanger($listStockage) {
    $meilleurEmplacement = null;
    $trouver = false;
    $listeDesStokagesATraiter = $this->rechercheListeStockageATraiter($listStockage);
    $listeDesStokagesATraiter->rewind();
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
  }

  public function rechercheListeStockageATraiter($listeStockage, $restructuration = false) {
    //initialisation
    /**
     * @var int $score Score du dossier analysé
     * @var string $nomDossierTrouver Nom du dossier que l'on a trouvé
     * @var SplObjectStorage $listStockage Liste des stockages dans lesquels on peut stocker le dossier
     * @var bool $trouver Pour savoir si on a trouvé un dossier
     * @var int $tailleCalculer Taille total calculé du dossier avec le fichier à ajouter
     */
    $listStockage = new \SplObjectStorage();
    $tailleCalculer = 0;
    //Recherche de taille
    $listeStockage->rewind(); // placement de l'itérateur au début de la structure
    
    while($listeStockage->valid()){
      $nomStockage = $listeStockage->current();
      $tailleCalculer = $nomStockage->getTaille() + $this->getTaille();
      //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
      if ($this->getTaille() < $nomStockage->getTailleMax()) {
        if ($tailleCalculer > $nomStockage->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
          if ($restructuration == false) {                                // Si on n'est pas en face de restructuration
            if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
            $listStockage->attach($nomStockage);
            }
          }
          elseif($restructuration == true && $nomStockage != $nomDossierTrouver) {    // Si on est en face de restructuration et que le stockage n'est pas celui du dossier à restructurer
            if ($nomStockage->getRestructurable() == true) {                        // Et restructurable (donc peut potentiellement être intégré)
              $listStockage->attach($nomStockage);
            }
          }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
          $listStockage->attach($nomStockage);
        }
      }
      $listeStockage->next();
    }

    //tri de la list
    trierList($listStockage);

    return $listStockage;
  }

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

  public function rechercheMeilleurEmplacement($objectAPlacer, &$meilleurEmplacement = null, &$score = 0, &$trouver = false) {
    echo 'recherche d\'un emplacement pour '.$objectAPlacer->getNom().' dans le dossier '.$this->getNom();echo'<br>';
    // Recherche de l'emplacement le plus favorable à partir d'un parcour
    // Initialisation des points et du compteur

    /**
     * @var int $point Nombre de point
     * @var int $compteur Nombre de fois que l'on a trouvé le type
     */
    $point = 0;
    $score = 0;

    //Recherche du meilleur emplacement pour les enfants qui sont des fichiers du dossier courant
    //Récupération de la liste des enfants Fichier.
    $listEnfantFichier = $this->getListeEnfantFichier();
    $listEnfantFichier->rewind();
    while ($listEnfantFichier->valid()) {
      echo 'recherche d\'un emplacement pour '.$objectAPlacer->getNom().' en le comparent avec le fichier '.$listEnfantFichier->current()->getNom();echo '<br>';
      //Recherche du meilleur emplacement pour les enfants du dossier courant à partir du tag
      $listTag = $objectAPlacer->getMesTags();
      $listTagEnfant = $listEnfantFichier->current()->getMesTags();
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
      //recherhe du meilleur emplacement pour les enfants du dossier courant à partir du nom
      if ($this->getNom() == $listEnfantFichier->current()->getNom()) {
        $point++;
        echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
      }
      $listEnfantFichier->next();
    }

    //Recherche du meilleur emplacement pour les enfants qui sont des dossiers du dossier courant
    // Récupération de la liste des enfants Dossier 
    $listEnfantDossier = $this->getListeEnfantDossier();
    while ($listEnfantDossier->valid()) { 
      echo 'recherche d\'un emplacement pour '.$objectAPlacer->getNom().' dans le dossier '.$listEnfantDossier->current()->getNom();echo '<br>';
      //Recherche à partir du tag
      $listTag = $objectAPlacer->getMesTags();
      $listTagEnfant = $listEnfantDossier->current()->getMesTags();
      $listTagEnfant->rewind();
      while($listTagEnfant->valid()) {
        $listTag->rewind();
        echo 'test';echo '<br>';
        while ($listTag->valid()) {
          if ($listTag->current()->getTitre() == $listTagEnfant->current()->getTitre()) {
            $point++;
            echo "Tag trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
          }
          $listTag->next();
        }
        $listTagEnfant->next();
      }
      // Recherche à partir du nom
      if ($listEnfantDossier->current()->getNom() == $objectAPlacer->getNom()) {
        $point++;
        echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
      }
      $listEnfantDossier->next();
    }

    //Recherche du meilleur emplacement à partir du dossier courant
    //Recherche à partir du tag
    $listTag = $objectAPlacer->getMesTags();
    $listTagEnfant = $this->getMesTags();
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
    //Recherche à partir du nom
    if ($this->getNom() == $objectAPlacer->getNom()) {
      $point++;
      echo "Nom trouvé mise du score à <Strong>".$point."</strong>";echo '<br>';
    }

    //Enregistrement de valeur trouver
    if ($point > $score) {
      echo 'Le dossier '.$this->getNom().' a été trouver avec un score de '.$point;echo '<br>';
      $score = $point;
      $meilleurEmplacement = $this;
      $trouver = true ;
    }

    //Regarde les enfants
    $listEnfantDossier->rewind();
    while ($listEnfantDossier->valid()) {
      $listEnfantDossier->current()->rechercheMeilleurEmplacement($objectAPlacer, $meilleurEmplacement, $score, $trouver);
      $listEnfantDossier->next();
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