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


        public function getDossierById($id) {
            $query = "SELECT * FROM disque WHERE id = :id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Dossier($result["titre"], $result["auteur"], $result["id"]);
        }

        public function getAllDossiers() {
            $query = "SELECT * FROM disque";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $dossiers = array();
            foreach ($results as $result) {
            $dossiers[] = new Dossier($result["titre"], $result["auteur"], $result["id"]);
            }
            return $dossiers;
            }

            public function addDossier(Dossier $dossier) {
                $query = "INSERT INTO disque (titre, auteur, genre, prix, image) VALUES (:nom, :chemin, null, null, null)";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->execute();
            }

            public function updateDossier(Dossier $dossier) {
                $query = "UPDATE disque SET titre = :nom, auteur = :date_modification WHERE id = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":date_modification", $dossier->getChemin());
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }

            public function deleteDossier(Dossier $dossier) {
                $query = "DELETE FROM disque WHERE id = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":id", $dossier->getId());

                echo "Query: " . $query . "<br>";
                echo "Data: " . $dossier->getId() . "<br>";

                $stmt->execute();
            }
     }
?>
