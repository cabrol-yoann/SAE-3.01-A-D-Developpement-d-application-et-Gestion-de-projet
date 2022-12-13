<?php

require "Archive.php";
require "Tag.php";

/**
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @version 0.1
 * 
 * 
 * @copyright Copyright (c) 2022
 * 
 */

/**
 * Classe représentent un fichier physique à partir de son type et de ses tags héritant la classe Archive lui donnant un nom, une taille et un chemin
 */
class Fichier extends Archive {
 
// ATTRIBUT
/**
 * Représentation du type du fichier
 *
 * @var string
 */
public $type;
/**
 * Lien avec la classe tag
 *
 * @var list
 */
public $mesTags;
 
// CONSTRUCTEUR
/**
 * Constructeur de la classe
 *
 * @param string $type  Représentation du type du fichier
 * @param string $nom     Représentation du nom que va posséder l'objet
 * @param int $taille        Représentation de la taille que va avoir l'objet
 * @param string $chemin     Représentaton du chemin que va posséder l'objet
 */
public function __construct($nom, $taille, $chemin, $type)
{
  $this->mesTags = new \SplObjectStorage(); 
  $this->type = $type;
  parent::__construct($nom, $taille, $chemin);
  
}
 
// DESTRUCTEUR
/**
 * Destructeur de la classe
 *
 */
public function __destuct(){
  echo 'Destroying: ', $this->type;
  echo 'Destroying: ', $this->mesTags;
}
 
// ENCASPULATION
//public
/**
 * Fonction de récupération du type de l'object dossier
 *
 * @return string
 */
public function getType(){return $this->type;}
/**
 * Fonction de modification de l'attribut type
 *
 * @param string $type Représentation du type du fichier
 */
public function setType($type){$this->type = $type;}
/**
 * Fonction de récupération de l'attribut mesTags
 *
 * @return Tag
 */
public function getMesTags() {
  return $this->mesTags;
}
/**
 * Fonction de mofication de l'attribut mesTags
 *
 * @param Tag $mesTags Lien avec la classe tag
 */

public function ajouterTags($tag){
  $this->mesTags->attach($tag);
}

public function supprimerTags($tag){
  $this->mesTags->detach($tag);
}

public function __toString()
{
  
}

// MÉTHODE SPÉCIFIQUE : NON
 
 
}

?>