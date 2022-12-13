<?php


class Fichier extends Archive{

// Attributs
private $type;
private $mesTags;

//Constructeur
public function __construct($n, $t, $c,$ty)
{
  parent::__construct($n, $t, $c);
  $this->type = $ty;   
}

//Destructeur
public function __destuct(){
   echo 'Destroying: ', $this->type;
   echo 'Destroying: ', $this->mesTags;
}

//Encapsulations 
//public
public function getType(){return  $this->type;}
public function setType($type){$this->type = $type;}

public function getMesTags(){return $this->mesTag;}
public function setMesTags($mesTag){$this->mesTag = $mesTag;}

//Methode usuelle
/*
public function ajouterTag(){}
public function supprimerTag(){}
*/
//Methode spécifique : NON


}

?>