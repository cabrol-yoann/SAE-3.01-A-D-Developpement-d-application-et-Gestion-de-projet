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

        // CONSTRUCTEUR
         /**
         * @brief Constructeur de la classe DossierDAO qui démarre la connexion à la base de données
         *
         */
        public function __construct()
        {
            $database = parent::getInstance();
            $this->link = $database->getConnection();
        }


         // DESTRUCTEUR
        /**
         * @brief Destructeur de la classe DossierDAO
         */
        public function __destruct()
        {
            parent::__destruct();
        }

    // MÉTHODE USUELLE :NON

    // MÉTHODE SPÉCIFIQUE : 


        /**
         * Fonction qui va chercher un dossier sur la BDD en fonction de son id
         *
         * @param integer $id identifiant du dossier à récupérer
         */
        public function getDossierById($id) {
            $query = "SELECT * FROM disque WHERE id = :id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Dossier($result["titre"], $result["auteur"], $result["id"]);
        }

          /**
         * Fonction qui va chercher tous les dossiers de la BDD
         *
         * @return Dossier
         */
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

              /**
             * Fonction qui va ajouter un dossier à la BDD
             *
             * @param Dossier $dossier dossier à ajouter à la BDD
             */
            public function addDossier(Dossier $dossier) {
                $query = "INSERT INTO disque (titre, auteur, genre, prix, image) VALUES (:nom, :chemin, null, null, null)";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->execute();
            }

              /**
             * Fonction qui va mettre à jour un dossier sur la BDD
             *
             * @param Dossier $dossier dossier à mettre à jour sur la BDD
             */
            public function updateDossier(Dossier $dossier) {
                //$dossier->setId($this->getConnection()->lastInsertId());
                $query = "UPDATE disque SET titre = :nom, auteur = :date_modification WHERE id = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":date_modification", $dossier->getChemin());
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }

             /**
             * Fonction qui va supprimer un dossier de la BDD
             *
             * @param Dossier $dossier dossier à supprimer de BDD
             */
            public function deleteDossier(Dossier $dossier) {
                $query = "DELETE FROM disque WHERE id = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }
     }
?>
