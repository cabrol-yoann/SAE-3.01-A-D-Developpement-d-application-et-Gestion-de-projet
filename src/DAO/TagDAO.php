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

class TagDAO{
    
    /**
     * @brief Constructeur de la classe TagDAO qui démarre la connexion à la base de données
     */
    public function __construct(Database $database)
    {
        $this->link = $database->getConnection();
    }

    /**
     * @brief Destructeur de la classe TagDAO
     */
    public function __destruct()
    {
        // Fermeture de la connexion PDO
        $this->link = null;
    }

    /**
     * @brief Fonction qui ajoute un tag
     * 
     * @param Tag $tag
     * @return void
     */
    public function getTagByIdDossier($possesseur) {
        $query = "SELECT * FROM _assoTagDossier WHERE idDossier = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindValue(":id", $possesseur->getId());
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $result) {
            $bd=new TagDAO(Database::getInstance());
            $tag=$bd->getTagById($result["idTag"]);
            $tag->rewind();
            while($tag->valid()) {
                $possesseur->ajouterTags($tag->current());
                $tag->next();
            } 
        }
        return;
    }

    public function getTagByIdFichier($possesseur) {
        $query = "SELECT * FROM _assoTagFichier WHERE :id= idFichier";
        $stmt = $this->link->prepare($query);
        $stmt->bindvalue(":id",$possesseur->getId());
        $stmt->execute();
        $results = $stmt->fetchAll();
        $listTag = new SplObjectStorage;
        foreach ($results as $result) {
            $bd=new TagDAO(Database::getInstance());
            $tag=$bd->getTagById($result["idTag"]);
            $tag->rewind();
            while($tag->valid()) {
                $possesseur->ajouterTags($tag->current());
                $tag->next();
            } 
        }
    }

    public function getTagById($id) {
        $query = "SELECT * FROM _tag WHERE id = :id";
        $stmt = $this->link->prepare($query);
        $stmt->bindvalue(":id",$id);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $listTag = new SplObjectStorage;
        foreach ($results as $result) {
            $listTag->attach(new Tag($result["libelle"], $result["id"]));
        }
        return $listTag;
    }

    public function getListeTag() {
        $query = "SELECT * FROM _tag ";
        $stmt = $this->link->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $listTag = new SplObjectStorage;
        foreach ($results as $result) {
            $listTag->attach(new Tag($result["id"], $result["libelle"]));
            var_dump($listTag);
        }
        return $listTag;
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