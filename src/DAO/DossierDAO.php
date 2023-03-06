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
            $query = "SELECT * FROM Dossier WHERE ID_Dossier = :id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Dossier($result["nom"], $result["chemin"], $result["ID_dossier"]);
        }

          /**
         * Fonction qui va chercher tous les dossiers de la BDD
         *
         * @return Dossier
         */
        public function getAllRacines($parent) {
            $query = "SELECT * FROM Dossier WHERE ID_pere = $parent->getId()";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
            $parent->setMaRacine(new Dossier($result["nom"], $result["chemin"], $result["ID_dossier"]));
            }
            return $dossiers;
            }

        public function getAllDossier($parent) {
            $query = "SELECT * FROM Dossier WHERE ID_pere = $parent->getId()";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                $parent->ajouterEnfantFichier(Dossier($result["nom"], $result["chemin"], $result["ID_dossier"]));
            }
            return $dossiers;
            }

              /**
             * Fonction qui va ajouter un dossier à la BDD
             *
             * @param Dossier $dossier dossier à ajouter à la BDD
             */
            public function addDossier(Dossier $dossier) {
                $query = "INSERT INTO Dossier (nom, chemin, racine, ID_pere, ID_tag) VALUES (:nom, :chemin, :racine, null, null)";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->bindValue(":racine", 'false');
                $stmt->execute();
            }

              /**
             * Fonction qui va mettre à jour un dossier sur la BDD
             *
             * @param Dossier $dossier dossier à mettre à jour sur la BDD
             */
            public function updateDossier(Dossier $dossier) {
                //$dossier->setId($this->getConnection()->lastInsertId());
                $query = "UPDATE Dossier SET nom = :nom, chemin = :chemin WHERE ID_dossier = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }

             /**
             * Fonction qui va supprimer un dossier de la BDD
             *
             * @param Dossier $dossier dossier à supprimer de BDD
             */
            public function deleteDossier(Dossier $dossier) {
                $query = "DELETE FROM Dossier WHERE ID_Dossier = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }
     }
?>
