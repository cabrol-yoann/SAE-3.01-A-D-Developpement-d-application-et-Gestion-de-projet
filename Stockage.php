<?php
class Stockage{

// Attributs
private $restructurable;
private $nom;
private $taille;
private $chemin;
private $tailleMax;


//Constructeur
public function __construct($r, $n, $t, $c, $tm)
{
  $this->restructurable = $r;
  $this->nom = $n; 
  $this->taille = $t; 
  $this->chemin = $c; 
  $this->tailleMax = $tm;    
}

//Destructeur
public function __destuct(){
    echo 'Destroying: ', $this->restructurable;
    echo 'Destroying: ', $this->nom;
    echo 'Destroying: ', $this->taille;
    echo 'Destroying: ', $this->chemin;
    echo 'Destroying: ', $this->tailleMax;
}

//Encapsulation
//public
public function getRestructurable(){return $this->restructurable;}
public function getNom(){return $this->nom;}
public function getTaille(){return $this->taille;}
public function getChemin(){return $this->chemin;}
public function getTailleMax(){return $this->tailleMax;}

public function setRestructurable($restructurable){$this->restructurable = $restructurable;}
public function setNom($nom){$this->nom = $nom;}
public function setTaille($taille){$this->taille = $taille;}
public function setChemin($chemin){$this->chemin = $chemin;}
public function setTailleMax($tailleMax){$this->tailleMax = $tailleMax;}

//Methode usuelles 
/*
public function getListeEnfantDossier(){}
public function getListEnfantFichier(){}

public function ajouterEnfant(){}

public function ajouterTag(){}
public function supprimerTag(){}
*/

//Methode spécifique : NON


}

?>