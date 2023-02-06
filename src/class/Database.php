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
    private $db;

/**
 * @brief Constructeur de la classe Database
 * @var array $dbConfig Tableau contenant les informations de connexion à la base de données, lu dans le fichier bd.php
 */
public function __construct()
{
    $dbConfig = require('../config/bd.php');

    try {
        $this->db = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}", $dbConfig['username'], $dbConfig['password']);
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
    $this->db = null;
}

public function getUtilisateur($login)
{
    $sql = "SELECT * FROM utilisateur WHERE login = :login";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['login' => $login]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

public function getMusique(){
    $sql = "SELECT * FROM musique";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

}
?>