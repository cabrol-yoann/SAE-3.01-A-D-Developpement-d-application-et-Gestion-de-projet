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
         * @var PDO $db Objet PDO pour la connexion à la base de données
         */
            private static $_instance = null; 
            protected $link;

        /**
         * @brief Constructeur de la classe Database
         * @var array $dbConfig Tableau contenant les informations de connexion à la base de données, lu dans le fichier bd.php
         */
        private function __construct()
        {    
            $dbConfig = require('../config/bd.php');
            
            try {
                $this->link = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}", $dbConfig['username'], $dbConfig['password']);
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

        public static function getInstance() {
            if(self::$_instance == null)
               self::$_instance = new self();
            return self::$_instance ;
         }

        public function getConnection() {
            return $this->link;
        }
    }
?>