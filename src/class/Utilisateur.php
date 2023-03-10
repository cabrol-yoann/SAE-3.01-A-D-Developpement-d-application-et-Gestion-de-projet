<?php
/**
 * @file Utilisateur.php
 * @author cabrol (ycabrol@iutbayonne.univ-pau.fr)
 * @brief fichier contenant la classe Utilisateur
 * @details Classe représentant un utilisateur que l'on donne a des objets pour les spécifier
 * @version 2
 * @date 10/03/2023
 * 
 * @copyright Copyright (c) 2022
 * 
 */

 
/**
 * Classe représentant un Utilisateur que l'on donne a des objets pour les spécifier
 */
class Utilisateur{ 
    // ATTRIBUTS
    /**
     * @property string $titre Représentation du titre(nom) que possède un tag
     */
    public $id;

    /**
     * nom de l'utilisateur
     *
     * @var string
     */
    public $nom;


    /**
     * email de l'utilisateur
     *
     * @var string
     */
    public $email;

    /**
     * mot de passe de l'utilisateur
     *
     * @var string
     */
    public $mdp;

    /**
     * type_abonnement de l'utilisateur
     *
     * @var string
     */
    public $type_abonnement;

    // CONSTRUCTEUR
    /**
     * @brief Constructeur de la classe
     * @param string $id                    id de l'utilisateur
     * @param string $nom                   nom de l'utilisateur
     * @param string $email                 email de l'utilisateur
     * @param string $mdp                   mot de passe de l'utilisateur
     * @param string $type_abonnement       type_abonnement de l'utilisateur premium ou non
     */
    public function __construct($id, $nom, $email, $mdp, $type_abonnement = 'gratuit')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->type_abonnement = $type_abonnement;
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
     * @brief Retourne l'id de l'objet Utilisateur
     *
     * @return string
     */
    public function getId(){return  $this->id;}
    
    /**
     * @brief Retourne le nom de l'objet Utilisateur
     *
     * @return string
     */
    public function getNom(){return  $this->nom;}


    /**
     * @brief Retourne l'email de l'objet Utilisateur
     *
     * @return string
     */
    public function getEmail(){return  $this->email;}

    /**
     * @brief Retourne le mot de passe de l'objet Utilisateur
     *
     * @return string
     */
    public function getMdp(){return  $this->mdp;}

    /**
     * @brief Retourne le role de l'objet Utilisateur
     *
     * @return boolean
     */
    public function getType_abonnement(){return  $this->type_abonnement;}

    /**
     * @brief Modifie le titre de l'objet Tag
     *
     * @param string $titre Représentation du titre(nom) que possède un tag
     */
    public function setId($id){$this->id = $id;}
    
    /**
     * @brief Modifie le nom de l'objet Utilisateur
     *
     * @param string $nom Représentation du nom de l'utilisateur
     */
    public function setNom($nom){$this->nom = $nom;}

    /**
     * @brief Modifie l'email de l'objet Utilisateur
     *
     * @param string $email Représentation de l'email de l'utilisateur
     */
    public function setEmail($email){$this->email = $email;}

    /**
     * @brief Modifie le mot de passe de l'objet Utilisateur
     *
     * @param string $mdp Représentation du mot de passe de l'utilisateur
     */
    public function setMdp($mdp){$this->mdp = $mdp;}

    /**
     * @brief Modifie le type_abonnement de l'objet Utilisateur
     *
     * @param boolean $type_abonnement Représentation du type_abonnement de l'utilisateur
     */
    public function setType_abonnement($type_abonnement){$this->type_abonnement = $type_abonnement;}

    // MÉTHODE USUELLE : NON
    
    // MÉTHODE SPÉCIFIQUE : NON
}
?>