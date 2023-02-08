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
        protected $link;

        /**
         * @brief Constructeur de la classe Database
         * @var array $dbConfig Tableau contenant les informations de connexion à la base de données, lu dans le fichier bd.php
         */
        public function __construct()
        {
            $dbConfig = require('../config/bd.php');

            try {
                $this->link = new PDO("odbc:SAE", "rgouaud", "rgouaud");
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            $this->link = null;
        }

    }   


?>