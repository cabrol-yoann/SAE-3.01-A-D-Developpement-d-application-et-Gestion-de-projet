<?php
 /**
 * @file UtilisateurDAO.php
 * @author CABROL Yoann
 * @brief Classe pour gérer les Utilisateur au niveau de la base de données
 * @details Classe permettant de gérer la connexion et les requêtes aux espaces de Utilisateur
 * @version 1.0
 * @date 10-03-2023
 */

use LDAP\Result;

require_once "Database.php";
require_once "../class/Utilisateur.php";

Class UtilisateurDAO {
    // ATTRIBUTS
    /**
     * @property PDO $link Représentation de la connexion à la base de données
     */
    private $link;

     // CONSTRUCTEUR
     /**
     * @brief Constructeur de la classe UtilisateurDAO qui démarre la connexion à la base de données
     *
     */
    public function __construct(Database $database)
    {
        // Démarre la connexion à la base de données
        $this->link = $database->getInstance()->getConnection();
    }

     // DESTRUCTEUR
    /**
     * @brief Destructeur de la classe UtilisateurDAO
     */
    public function __destruct()
    {
        // Fermeture de la connexion PDO
        $this->link = null;
    }

    // MÉTHODE USUELLE :NON

    // MÉTHODE SPÉCIFIQUE : 

    /**
     * Fonction qui va chercher un Utilisateur sur la BDD en fonction de son id
     *
     * @param integer $id identifiant du Utilisateur à récupérer
     */
    public function getUtilisateurById($id) {
        $stmt = $this->link->prepare("SELECT * FROM _utilisateur WHERE id = :id");
        $stmt->bindValue(":id", $id);
        if($stmt->execute()==false)
            return null;
        $result = $stmt->fetch();
        $newUtilisateur = new Utilisateur($result["id"], $result["nom"], $result["mail"], $result["typeUtilisateur"]);
        return $newUtilisateur;
    }

    /**
     * Fonction qui va chercher un Utilisateur sur la BDD en fonction de son mail et mot de passe pour une connexion
     *
     * @param string $mail email de l'utilisateur
     * @param string $mdp mot de passe de l'utilisateur
     */
    public function getUtilisateurForConnexion($mail, $mdp) {
        $mdp = hash('sha3-512', $mdp);
        $stmt = $this->link->prepare("SELECT id,nom,typeUtilisateur, mail FROM _utilisateur WHERE mail  = :mail AND password = :mdp");
        $stmt->bindValue("mail",$mail);
        $stmt->bindValue("mdp",$mdp);
        if($stmt->execute() == true) {
            $result= $stmt->fetch();
            $newUtilisateur = new Utilisateur($result["id"], $result["nom"], $result["mail"], null, $result["typeUtilisateur"]);
            return $newUtilisateur;
        }
        return false;
        
    }

    /**
     * Fonction qui va chercher un Utilisateur sur la BDD en fonction de son id
     *
     * @param string $nom nom de l'utilisateur
     * @param string $mail email de l'utilisateur
     * @param string $mdp mot de passe de l'utilisateur
     */
    public function getUtilisateurForInscription($nom,$mail, $mdp) {
        $mdp = hash('sha3-512', $mdp);
        $stmt = $this->link->prepare("INSERT INTO _utilisateur (nom, mail,typeUtilisateur, password) VALUES (:nom,:mail,'gratuit', :mdp)");
        $stmt->bindvalue("nom",$nom);
        $stmt->bindValue("mail",$mail);
        $stmt->bindValue("mdp",$mdp);
        if($stmt->execute()==true) {
            $result= $stmt->fetch();
            $newUtilisateur = new Utilisateur($result["id"], $result["nom"], $result["mail"], null, $result["typeUtilisateur"]);
            return $newUtilisateur;
        }

    }

    /**
     * Fonction qui va chercher tous les Utilisateur de la BDD
     *
     * @return Utilisateur
     */
    public function getAllUtilisateur() {
        $stmt = $this->link->prepare("SELECT * FROM _utilisateur", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute();
        $results = $stmt->fetchAll();
        $Utilisateurs = new SplObjectStorage;
        foreach ($results as $result) {
            $Utilisateurs->attach(new Utilisateur( $result["id"], $result["nom"], $result["mdp"], $result["role"]));
        }
        return $Utilisateurs;
    }
    /**
     * Fonction qui va ajouter un Utilisateur à la BDD
     *
     * @param Utilisateur $Utilisateur Utilisateur à ajouter à la BDD
    */
    public function addUtilisateur(Utilisateur $Utilisateur) {
        $query = "INSERT INTO _utilisateur (id , nom, email, password, role) VALUES (:id, :nom, :email, :mdp, :role)";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getID());
        $stmt->bindValue(":nom", $Utilisateur->getNom());
        $stmt->bindValue(":email", $Utilisateur->getEmail());
        $stmt->bindValue(":mdp", $Utilisateur->getMdp());
        $stmt->bindValue(":typeUtilisateur", $Utilisateur->gettypeUtilisateur());
        $stmt->execute();
    }

    public function setToken($id, $token) {
        $stmt = $this->link->prepare("UPDATE _utilisateur SET token = :token WHERE id = :id");
        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    /**
     * Fonction qui va mettre à jour un Utilisateur sur la BDD
     *
     * @param Utilisateur $Utilisateur Utilisateur à mettre à jour sur la BDD
    */
    public function updateUtilisateur(Utilisateur $Utilisateur) {
        $query = "UPDATE _utilisateur SET id  = :id, nom = :nom, email = :email mdp = :mdp typeUtilisateur = :typeUtilisateur WHERE id = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getID());
        $stmt->bindValue(":nom", $Utilisateur->getNom());
        $stmt->bindValue(":email", $Utilisateur->getEmail());
        $stmt->bindValue(":mdp", $Utilisateur->getMdp());
        $stmt->bindValue(":typeUtilisateur", $Utilisateur->gettypeUtilisateur());
        $stmt->execute();
    }
    /**
     * Fonction qui va supprimer un Utilisateur de la BDD
     *
     * @param Utilisateur $Utilisateur Utilisateur à supprimer de BDD
    */
    public function deleteUtilisateur(Utilisateur $Utilisateur) {
        $query = "DELETE FROM _utilisateur WHERE id = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getId());
        $stmt->execute();
    }
    }
?>