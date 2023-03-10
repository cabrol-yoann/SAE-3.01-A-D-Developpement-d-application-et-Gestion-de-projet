<?php

/**
 * @file TagDAO.php
 * @author GOUAUD Romain
 * @brief Classe pour gérer les tags au niveau de la base de données
 * @details Classe permettant de gérer la connexion et les requêtes aux tags
 * @version 1.0
 * @date 06-03-2022
 */

include_once "Database.php";
include_once "../class/Tag.php";

class TagDAO extends Database{
    
    /**
     * @brief Constructeur de la classe TagDAO qui démarre la connexion à la base de données
     */
    public function __construct()
    {
        $database = parent::getInstance();
        $this->link = $database->getConnection();
    }

    /**
     * @brief Destructeur de la classe TagDAO
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @brief Fonction qui ajoute un tag
     * 
     * @param Tag $tag
     * @return void
     */
    public function getTagByID($id) {
        $query = "SELECT * FROM Tag WHERE ID_Tag = :id";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Tag($result["nom"], $result["ID_tag"]);
    }

    /**
     * @brief Fonction qui ajoute un tag
     * 
     * @param Tag $tag
     */
    public function deleteTag($tag) {
        $query = "DELETE FROM Tag WHERE ID_Tag = :id";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->execute();
    }

    /**
     * @brief Fonction qui met à jour un tag
     * 
     * @param Tag $tag
     * @return void
     */
    public function updateTag($tag) {
        $query = "UPDATE Tag SET nom = :nom WHERE ID_Tag = :id";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->bindValue(":nom", $tag.getTitre());
        $stmt->execute();
    }

    /**
     * @brief Fonction qui crée un tag
     * 
     * @param string $nom
     */
    public function createTag($nom) {
        $query = "INSERT INTO Tag (nom) VALUES (:nom)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":nom", $nom);
        $stmt->execute();
        
    }

    /**
     * @brief Fonction qui associe un tag à un dossier
     * 
     * @param Tag $tag
     * @param Dossier $dossier
     */
    public function associerTagDossier($tag,  $dossier){
        $query = "INSERT INTO _assoTagDossier (ID_Tag, ID_Dossier) VALUES (:id, :dossier)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->bindValue(":dossier", $dossier.getId());
        $stmt->execute();
    }

    /**
     * @brief Fonction qui supprime l'association entre un tag et un dossier
     * 
     * @param Tag $tag
     * @param Dossier $dossier
     */
    public function desassocierTagDossier($tag,  $dossier){
        $query = "DELETE FROM _assoTagDossier WHERE ID_Tag = :id AND ID_Dossier = :dossier";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->bindValue(":dossier", $dossier.getId());
        $stmt->execute();
    }

    /**
     * @brief Fonction qui associe un tag à un fichier
     * 
     * @param Tag $tag
     * @param Fichier $fichier
     */
    public function associerTagFichier($tag,  $fichier){
        $query = "INSERT INTO _assoTagFichier (ID_Tag, ID_Fichier) VALUES (:id, :fichier)";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->bindValue(":fichier", $fichier.getId());
        $stmt->execute();
    }

    /**
     * @brief Fonction qui supprime l'association entre un tag et un fichier
     * 
     * @param Tag $tag 
     * @param Fichier $fichier
     */
    public function desassocierTagFichier($tag,  $fichier){
        $query = "DELETE FROM _assoTagFichier WHERE ID_Tag = :id AND ID_Fichier = :fichier";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":id", $tag.getId());
        $stmt->bindValue(":fichier", $fichier.getId());
        $stmt->execute();
    }

}

?>