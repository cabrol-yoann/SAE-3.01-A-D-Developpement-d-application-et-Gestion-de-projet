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
require_once "FichierDAO.php";
require_once "TagDAO.php";

     Class DossierDAO {

        // ATTRIBUTS
        /**
         * @property PDO $link Représentation de la connexion à la base de données
         */
        protected $link;

        // CONSTRUCTEUR
         /**
         * @brief Constructeur de la classe DossierDAO qui démarre la connexion à la base de données
         *
         */
        public function __construct(Database $database)
        {
            $this->link = $database->getConnection();
        }


         // DESTRUCTEUR
        /**
         * @brief Destructeur de la classe DossierDAO
         */
        public function __destruct()
        {
            // Fermeture de la connexion PDO
            $this->link = null;
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
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Dossier($result["nom"], $result["chemin"], $result["ID_dossier"]);
        }

        public function getRacineById($idRacine) {
            $test='true';
            $query = "SELECT * FROM _dossier WHERE id = :id AND Racine = 'true';";
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $idRacine);
            $stmt->execute();
            $result = $stmt->fetch();
            $racine =new Dossier($result["id"], $result["nom"], $result["chemin"], $result["nbFichier"]);
            return $racine;
        }

        /**
         * @brief Fonction qui va chercher tous les dossiers de la BDD
         *
         * @return Dossier
         */
        public function getAllEnfant($parent) {
            $query = "SELECT * FROM _dossier WHERE idPere = :id";
            $stmt = $this->link->prepare($query);
            $stmt->bindValue(":id", $parent->getId());
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                $enfant = new Dossier($result['id'], $result["nom"], $result["chemin"], $result['nbFichier']);
                $parent->ajouterEnfantDossier($enfant);
                //recupère les enfants fichier
                if ($result['nbFichier']) {
                    //ajout enfant dossier
                    $bd=new DossierDAO(Database::getInstance());
                    $bd->getAllEnfant($enfant);
                    $bd->__destruct();
                    //ajout enfant Fichier
                    $bd=new FichierDAO(Database::getInstance());
                    $bd->getAllEnfant($enfant, $_SESSION['utilisateur']);
                    $bd->__destruct();
                }
                //ajout des tags
                $bd=new TagDAO(Database::getInstance());
                $bd->getTagByIdDossier($enfant);
                $bd->__destruct();

            }
            return;
        }

        public function getAllDossier($parent) {
            $query = "SELECT * FROM Dossier WHERE ID_pere = $parent->getId()";
            $stmt = $this->link->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $result) {
                $parent->ajouterEnfantFichier(new Dossier($result["nom"], $result["chemin"], $result["ID_dossier"]));
            }
        }

              /**
             * Fonction qui va ajouter un dossier à la BDD
             *
             * @param Dossier $dossier dossier à ajouter à la BDD
             */
            public function addDossier(Dossier $dossier) {
                $query = "INSERT INTO _dossier (nom, taille, chemin, idPere, Racine, nbFichier) VALUES (:nom, :taille, :chemin, :idPere, false, :nbFichier)";
                $stmt = $this->link->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":taille", $dossier->getTaille());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->bindValue(":idPere", $dossier->getIdPere());
                $stmt->bindValue(":nbFichier", $dossier->getNbFichier());
                $stmt->execute();
            }

            public function addDossierRacine($dossier) {
                $query = "INSERT INTO _dossier (nom, taille, chemin, idPere, Racine, nbFichier) VALUES (:nom, :taille, :chemin, :idPere, true, :nbFichier)";
                $stmt = $this->link->prepare($query);
                $stmt->bindValue(":nom", $dossier->getNom());
                $stmt->bindValue(":taille", $dossier->getTaille());
                $stmt->bindValue(":chemin", $dossier->getChemin());
                $stmt->bindValue(":idPere", $dossier->getIdPere());
                $stmt->bindValue(":nbFichier", $dossier->getNbFichier());
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
                $stmt = $this->link->prepare($query);
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
                $stmt = $this->link->prepare($query);
                $stmt->bindValue(":id", $dossier->getId());
                $stmt->execute();
            }
     }
?>
