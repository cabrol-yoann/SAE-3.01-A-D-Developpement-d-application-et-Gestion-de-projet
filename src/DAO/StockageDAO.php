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
    require_once "DossierDAO.php";

    Class StockageDAO {

        // ATTRIBUTS
        /**
         * @property PDO $link Représentation de la connexion à la base de données
         */
        private $link;

         // CONSTRUCTEUR
         /**
         * @brief Constructeur de la classe StockageDAO qui démarre la connexion à la base de données
         *
         */
        public function __construct(Database $database)
        {
            $this->link = $database->getConnection();
        }


         // DESTRUCTEUR
        /**
         * @brief Destructeur de la classe StockageDAO
         */
        public function __destruct()
        {
            // Fermeture de la connexion PDO
            $this->link = null;
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
            $stmt = $this->link->prepare($query);
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
        public function getAllStockages($idUtilisateur) {
            $query = "SELECT * FROM _stockage WHERE id_utilisateur = :id";
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $idUtilisateur);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $listeStockage = new SplObjectStorage();
            $bd=new DossierDAO(Database::getInstance());
            foreach ($results as $result) {
                $nouveauStockage = new Stockage($result["nom"], $result["taille"], $result["tailleMax"], $result["restructurable"], $result["chemin"], $result["id_utilisateur"], $result["dossierRacine"], $result["id"]);
                $listeStockage->attach($nouveauStockage);
                
                $listeStockage->current()->setMaRacine($bd->getRacineById($result["dossierRacine"]));
                $listeStockage->next();
            }
            $bd->__destruct();
            return $listeStockage;
        }

        /**
         * Fonction qui va ajouter un Stockage à la BDD
         *
         * @param Stockage $Stockage Stockage à ajouter à la BDD
         */
        public function addStockage(Stockage $Stockage, $idUtilisateur) {
            $query = "INSERT INTO _stockage (id, nom, taille, tailleMax, typeStockage, restructurable, chemin, id_utilisateur, dossierRacine) VALUES (:id, :nom, :taille, :tailleMax, :chemin, null, :restruct, :chemin, :idUtilisateur, :dossierRacine)";
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $Stockage->getId());
            $stmt->bindValue(":nom", $Stockage->getNom());
            $stmt->bindValue(":taille", $Stockage->getTaille());
            $stmt->bindValue(":tailleMax", $Stockage->getTailleMax());
            $stmt->bindValue(":restruct", 'false');
            $stmt->bindValue(":chemin", $Stockage->getChemin());
            $stmt->bindValue(":idUtilisateur", $idUtilisateur);
            $stmt->bindValue(":dossierRacine", $Stockage->getMaRacine()->getId());
            $stmt->execute();
        }

        /**
         * Fonction qui va mettre à jour un Stockage sur la BDD
         *
         * @param Stockage $Stockage Stockage à mettre à jour sur la BDD
         */
        public function updateStockage($Stockage) {
            //$Stockage->setId($this->getConnection()->lastInsertId());
            $str = ($Stockage->getRestructurable()) ? 'true' : 'false';
            $query = "UPDATE Stockage SET nom = :nom, chemin_acces = :chemin, restructurable = :restruct, tailleMax = :tailleMax  WHERE ID_Stockage = :id";
            $stmt = $this->link->prepare($query);
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
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $Stockage->getId());
            $stmt->execute();
        }
    }
?>