<?php
 /**
     * @file StockageDAO.php
     * @author FERREIRA Alexandre
     * @brief Classe pour gérer les espaces de stockage au niveau de la base de données
     * @details Classe permettant de gérer la connexion et les requêtes aux espaces de stockage
     * @version 1.0
     * @date 09-02-2022
     */


    require_once "Database.php";
    require_once "../class/Stockage.php";

    Class StockageDAO extends Database {

         // CONSTRUCTEUR
         /**
         * @brief Constructeur de la classe StockageDAO qui démarre la connexion à la base de données
         *
         */
        public function __construct()
        {
            $database = parent::getInstance();
            $this->link = $database->getConnection();
        }


         // DESTRUCTEUR
        /**
         * @brief Destructeur de la classe StockageDAO
         */
        public function __destruct()
        {
            parent::__destruct();
        }

        // MÉTHODE USUELLE :NON

    // MÉTHODE SPÉCIFIQUE : 


        /**
         * Fonction qui va chercher un Stockage sur la BDD en fonction de son id
         *
         * @param integer $id identifiant du Stockage à récupérer
         */
        public function getStockageById($id) {
            $query = "SELECT * FROM Stockage WHERE ID_Stockage = :id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Stockage($result["nom"], $result["chemin_acces"], $result["tailleMax"], $result["restructurable"], $result["ID_Stockage"]);
        }

          /**
         * Fonction qui va chercher tous les Stockages de la BDD
         *
         * @return Stockage
         */
        public function getAllStockages() {
            $query = "SELECT * FROM Stockage";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $Stockages = new SplObjectStorage;
            foreach ($results as $result) {
            $Stockages->attach(new Stockage( $result["nom"], $result["chemin_acces"], $result["tailleMax"], $result["restructurable"], $result["ID_Stockage"]));
            }
            $Stockages->rewind();
            while($Stockages->valid()){
                $this->getAllRacines($Stockages->current());
            }
            $Stockages->rewind();
            while($Stockages->valid()){
                $this->getAllDossiers($Stockages->current()->getMaRacine());
            }
            
            return $Stockages;
            }

              /**
             * Fonction qui va ajouter un Stockage à la BDD
             *
             * @param Stockage $Stockage Stockage à ajouter à la BDD
             */
            public function addStockage(Stockage $Stockage) {
                $query = "INSERT INTO Stockage (nom, taille, chemin_acces, type, restructurable, nom_utilisateur, ID_dossier, ID_utilisateur, tailleMax) VALUES (:nom, 0, :chemin, null, :restruct, null, null, null, :tailleMax)";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $Stockage->getNom());
                $stmt->bindValue(":chemin", $Stockage->getChemin());
                $stmt->bindValue(":restruct", 'false');
                $stmt->bindValue(":tailleMax", $Stockage->getTailleMax());
                $stmt->execute();
            }

              /**
             * Fonction qui va mettre à jour un Stockage sur la BDD
             *
             * @param Stockage $Stockage Stockage à mettre à jour sur la BDD
             */
            public function updateStockage(Stockage $Stockage) {
                //$Stockage->setId($this->getConnection()->lastInsertId());
                $str = ($Stockage->getRestructurable()) ? 'true' : 'false';
                $query = "UPDATE Stockage SET nom = :nom, chemin_acces = :chemin, restructurable = :restruct, tailleMax = :tailleMax  WHERE ID_Stockage = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":nom", $Stockage->getNom());
                $stmt->bindValue(":chemin", $Stockage->getChemin());
                $stmt->bindValue(":id", $Stockage->getId());
                $stmt->bindValue(":restruct", $str);
                $stmt->bindValue(":tailleMax", $Stockage->getTailleMax());
                $stmt->execute();
            }

             /**
             * Fonction qui va supprimer un Stockage de la BDD
             *
             * @param Stockage $Stockage Stockage à supprimer de BDD
             */
            public function deleteStockage(Stockage $Stockage) {
                $query = "DELETE FROM Stockage WHERE ID_Stockage = :id";
                $stmt = $this->getConnection()->prepare($query);
                $stmt->bindValue(":id", $Stockage->getId());
                $stmt->execute();
            }
    }
?>