<?php
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Stockage.php";
include_once "../class/Archive.php";
include_once "../DAO/StockageDAO.php";

$bdStockage = new StockageDAO();

//Test de la recherche de Stockage par ID
    var_dump($bdStockage->getStockageById(4)). '<br>'; // Fonctionnel 

//Test de la recherche de tous les Stockages
    $allBD = $bdStockage->getAllStockages();
    foreach($allBD as $object)
    {
        $restruct = '';
        if($object->restructurable == "false")
            {
                $restruct = 'Non';
                $object->setRestructurable(false);
            }
        else 
            {
                $restruct = 'Oui';
                $object->setRestructurable(true);
            }
  
        echo 'Id : '. $object->id. '<br>';
        echo 'Nom : '. $object->nom. '<br>';
        echo 'Chemin : '. $object->chemin. '<br>' ;
        echo 'Taille max : '. $object->tailleMax. '<br>';
        echo 'Restructurable : '. $restruct. '<br>'.'<br>';
    
    //Test de l'ajout d'un Stockage
        $stockageTest = new Stockage('nom', '/', 'true', 80000);
    }
?>