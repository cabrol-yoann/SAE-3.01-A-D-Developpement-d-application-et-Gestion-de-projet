<?php
    /**
     * @file Database.php
     * @author GOUAUD Romain
     * @brief Classe pour gérer la base de données
     * @details Classe permettant de gérer la connexion et les requêtes à la base de données
     * @version 1.0
     * @date 03-02-2022
     */

    class Database{

        /**
         * @property mixed $_instance Représentation de l'unique instance de la classe
        */
        private static $_instance = null;

        /**
         * @property PDO $link Représentation la connexion à la base de données
         */
        protected $link;
        /**
         * @property string $utilisateur Représentation de l'utilisateur en base de données
         */
        protected $utilisateur;


        /**
         * @brief Constructeur de la classe Database
         * @var array $dbConfig Tableau contenant les informations de connexion à la base de données, lu dans le fichier bd.php
         */

        private function __construct()
        {    
            $dbConfig = require('../config/bd.php');
            
            try {
                $this->link = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}", $dbConfig['username'], $dbConfig['password']);
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$this->utilisateur = $_SESSION['utilisateur'];

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        /**
         * @brief Destructeur de la classe Database
         */
        public function __destruct()
            {
            // Fermeture de la connexion PDO
                self::$_instance = null;
            }

         // MÉTHODE USUELLE

         /**
         * @brief retourne une instance de la connexion à la base de données si elle existe
         *
         * @return mixed instance
         */
        public static function getInstance() {
            if(self::$_instance == null)
               self::$_instance = new self();
            return self::$_instance ;
         }

         /**
         * @brief retourne l'objet PDO qui représente la connexion à la base de données.
         *
         * @return PDO connexion à la BDD
         */

        public function getConnection() {
            return $this->link;
        }
    }
?>