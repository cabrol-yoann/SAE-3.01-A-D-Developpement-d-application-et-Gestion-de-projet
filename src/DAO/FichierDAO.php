<?php


include_once "Database.php";
include_once "Fichier.php";
/**
 * @file FichierDAO.php
 * @author GOUAUD Romain
 * @brief Classe interfacant les objet fichier et la base de données
 * @details Classe permettant de gérer les CRUD de la table fichier et d'en générer des objet Fichier
 * @version 1.0
 * @date 06-02-2022
 */


class FichierDao extends Database{

    private const TABLE = "FICHIER";

    /**
     * @brief Constructeur de la classe FichierDAO
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * @brief Destructeur de la classe FichierDAO
     */
    public function __destruct(){
        parent::__destruct();
    }


    // SELECT 
    /**
     * @brief Fonction permettant de récupérer un fichier
     * @param int $id ID du fichier à récupérer, null par défaut pour récupérer tous les fichiers
     * @return array Tableau contenant les informations du / des fichier
     * @details Fonction permettant de récupérer un fichier en fonction de son ID, ou tous les fichiers si l'ID n'est pas spécifié
     */
    public function getFichier($id = null){
        try{
            $sql = "SELECT * FROM $TABLE WHERE ID = :id";
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
     * @param int $id ID du fichier à supprimer, null par défaut pour supprimer tous les fichiers
     * @return bool Retourne true si la suppression a réussi, false sinon
     * @details Fonction permettant de supprimer un fichier en fonction de son ID, ou tous les fichiers si l'ID n'est pas spécifié
     */

     /**
      * @TODO Vérifier que le fichier existe bien avant de le supprimer. Trouver un moyen de récupérer un attribut unique dans l'objet Fichier
      */
    public function deleteFichier($id = null){
        try{
            $sql = "DELETE FROM $TABLE WHERE ID = :id";
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
            $sql = "INSERT INTO $TABLE (ID, TYPE, NOM, TAILLE, CHEMIN) VALUES (:$id, :$type, :$nom, :$taille, :$chemin)";
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
            $sql = "UPDATE $TABLE SET TYPE = :$type, NOM = :$nom, TAILLE = :$taille, CHEMIN = :$chemin WHERE ID = :$id";
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