<?php
 /**
 * @file UtilisateurDAO.php
 * @author CABROL Yoann
 * @brief Classe pour gérer les Utilisateur au niveau de la base de données
 * @details Classe permettant de gérer la connexion et les requêtes aux espaces de Utilisateur
 * @version 1.0
 * @date 10-03-2023
 */
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
        $this->link = $database->getInstance();
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
        $query = "SELECT * FROM utilisateur WHERE ID_Utilisateur = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Utilisateur($result["id"], $result[""], $result[""], $result[""], $result[""]);
    }

    /**
     * Fonction qui va chercher tous les Utilisateur de la BDD
     *
     * @return Utilisateur
     */
    public function getAllUtilisateur() {
        $query = "SELECT * FROM Utilisateur";
        $stmt = $this->link->prepare($query);
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
        $query = "INSERT INTO Utilisateur (ID_utilisateur , nom, email, mdp, role) VALUES (:id, :nom, :email, :mdp, :role)";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getID());
        $stmt->bindValue(":nom", $Utilisateur->getNom());
        $stmt->bindValue(":email", $Utilisateur->getEmail());
        $stmt->bindValue(":mdp", $Utilisateur->getMdp());
        $stmt->bindValue(":type_abonnement", $Utilisateur->getType_abonnement());
        $stmt->execute();
    }

    /**
     * Fonction qui va mettre à jour un Utilisateur sur la BDD
     *
     * @param Utilisateur $Utilisateur Utilisateur à mettre à jour sur la BDD
    */
    public function updateUtilisateur(Utilisateur $Utilisateur) {
        $query = "UPDATE Utilisateur SET ID_utilisateur  = :id, nom = :nom, email = :email mdp = :mdp type_abonnement = :type_abonnement WHERE ID_Utilisateur = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getID());
        $stmt->bindValue(":nom", $Utilisateur->getNom());
        $stmt->bindValue(":email", $Utilisateur->getEmail());
        $stmt->bindValue(":mdp", $Utilisateur->getMdp());
        $stmt->bindValue(":type_abonnement", $Utilisateur->getType_abonnement());
        $stmt->execute();
    }
    /**
     * Fonction qui va supprimer un Utilisateur de la BDD
     *
     * @param Utilisateur $Utilisateur Utilisateur à supprimer de BDD
    */
    public function deleteUtilisateur(Utilisateur $Utilisateur) {
        $query = "DELETE FROM Utilisateur WHERE ID_Utilisateur = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $Utilisateur->getId());
        $stmt->execute();
    }
    }
?>