<?php
 /**
     * @file DossierDao.php
     * @author FERREIRA Alexandre
     * @brief Classe pour gérer les dossiers au niveau de la base de données
     * @details Classe permettant de gérer la connexion et les requêtes aux dossiers
     * @version 1.0
     * @date 03-02-2022
     */
require_once "Database.php";
require_once "../class/Dossier.php";

     Class DossierDAO extends Database{


        //public const TABLE = "disque";


        public function __construct()
        {
            $database = parent::getInstance();
            $this->link = $database->getConnection();
        }

        public function __destruct()
        {
            parent::__destruct();
        }


       /* public function select(){
            try{
                $stmt = $this->link->prepare('SELECT id, titre, auteur, genre FROM '.self::TABLE);
                $stmt->execute();
                return $stmt->fetch();
            }

            catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }
        }*/

        public function getDossierById($id) {
            $query = "SELECT * FROM disque WHERE id = :id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Dossier($result["id"], $result["titre"], $result["auteur"], $result["genre"]);
        }

        public function getAllDossiers() {
            $query = "SELECT * FROM disque";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $dossiers = array();
            foreach ($results as $result) {
            $dossiers[] = new Dossier($result["id"], $result["titre"], $result["auteur"], $result["genre"]);
            }
            return $dossiers;
            }
     }
?>
