<?php


include_once "Database.php";
include_once "../class/Fichier.php";
/**
 * @file FichierDAO.php
 * @author GOUAUD Romain
 * @brief Classe interfacant les objet fichier et la base de données
 * @details Classe permettant de gérer les CRUD de la table fichier et d'en générer des objet Fichier
 * @version 1.0
 * @date 06-02-2022
 */


class FichierDao {

    // ATTRIBUTS
    /**
     * @property PDO $link Représentation de la connexion à la base de données
     */
    protected $link;

    /**
     * @var string $TABLE Nom de la table fichier
     */
    public const TABLE = "FICHIER";

    /**
     * @brief Constructeur de la classe FichierDAO
     */
    public function __construct(Database $database){
        $this->link = $database->getConnection();
    }
    /**
     * @brief Destructeur de la classe FichierDAO
     */
    public function __destruct(){
        // Fermeture de la connexion PDO
        $this->link = null;
    }


    // SELECT 
    /**
     * @brief Fonction permettant de récupérer tous les fichiers
     * @return array Tableau contenant les informations du / des fichiers
     * @details Fonction permettant de récupérer tous les fichiers
     */
    public function getFichiers(){
        try{
            $sql = "SELECT * FROM this->TABLE";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }

        /**
         * @TODO Convertion des résultats en objet Fichier
         */
        //Convertion des résultats en objet Fichier
        foreach($result as $key => $value){
            $result[$key] = new Fichier($value);
        }
        return $result;
    }

    /**
     * @brief Fonction permettant de récupérer un fichier
     * @param int $id ID du fichier à récupérer
     * @return array Tableau contenant les informations du fichier
     * @details Fonction permettant de récupérer un fichier en fonction de son ID
     */
    public function getFichier($id){
        try{
            $sql = "SELECT * FROM $this->TABLE WHERE ID = :id";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }

        /**
         * @TODO Convertion des résultats en objet Fichier
         */
        //Convertion des résultats en objet Fichier
        foreach($result as $key => $value){
            $result[$key] = new Fichier($value);
        }
        return $result;
    }



    // DELETE
    /**
     * @brief Fonction permettant de supprimer un fichier
     * @param int $id ID du fichier à supprimer
     * @return bool Retourne true si la suppression a réussi, false sinon
     * @details Fonction permettant de supprimer un fichier en fonction de son ID
     */
    public function deleteFichier($id){
        try{
            $sql = "DELETE FROM $this->TABLE WHERE ID = :id";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
   }

   // INSERT 
   /**
    * @brief Fonction permettant d'insérer un fichier
    * @param Fichier $fichier Objet Fichier à insérer
    * @return bool Retourne true si l'insertion a réussi, false sinon
    * @details Fonction permettant d'insérer un objet fichier dans la base de données
    */
    public function insertFichier(Fichier $fichier){
        $type = $fichier->getType();
        $nom = $fichier->getNom();
        $taille = $fichier->getTaille();
        $chemin = $fichier->getChemin();
        
        // Récupération du dernier ID disponible
        try{
            $sql = "SELECT MAX(ID) FROM $TABLE";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
        $id = $result[0]['MAX(ID)'] + 1;

        try{
            $sql = "INSERT INTO $this->TABLE (ID, TYPE, NOM, TAILLE, CHEMIN) VALUES (:$id, :$type, :$nom, :$taille, :$chemin)";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    // UPDATE
    /**
     * @brief Fonction permettant de mettre à jour un fichier
     * @param Fichier $fichier Objet Fichier à mettre à jour
     * @return bool Retourne true si la mise à jour a réussi, false sinon
     * @details Fonction permettant de mettre à jour un objet fichier dans la base de données
     */
    public function updateFichier(Fichier $fichier){
        $id = $fichier->getId();
        $type = $fichier->getType();
        $nom = $fichier->getNom();
        $taille = $fichier->getTaille();
        $chemin = $fichier->getChemin();
        
        try{
            $sql = "UPDATE $this->TABLE SET TYPE = :$type, NOM = :$nom, TAILLE = :$taille, CHEMIN = :$chemin WHERE ID = :$id";
            $stmt = $this->link->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }
}
?>