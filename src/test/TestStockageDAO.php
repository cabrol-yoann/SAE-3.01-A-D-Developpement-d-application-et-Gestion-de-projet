<?php
include_once "../class/Fichier.php";
include_once "../class/Dossier.php";
include_once "../class/Stockage.php";
include_once "../class/Archive.php";
include_once "../DAO/StockageDAO.php";

$bdStockage = new StockageDAO();

//Test de la recherche de Stockage par ID
echo '<strong>Test de la recherche de Stockage par ID</strong> <br>';
    var_dump($bdStockage->getStockageById(4)). '<br>'; // Fonctionnel 

//Test de la recherche de tous les Stockages
echo '<strong>Test de la recherche de tous les Stockages</strong> <br>';
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
    }

     //Test de l'ajout d'un Stockage (Fonctionnel)
        $stockageTest = new Stockage('nom', '/', 80000,'true');
        //$bdStockage->addStockage($stockageTest);


    //Test de l'update des Stockages (Fonctionnel)
        $stockageTest->setId($bdStockage->getConnection()->lastInsertId());
        $stockageTest->setNom('Eduardo');
        $stockageTest->setTailleMax(8500);
        //$bdStockage->updateStockage($stockageTest);

    
    //Test de la suppression d'un Stockage (Fonctionnel)
        //echo $stockageTest->setId();
        $bdStockage->deleteStockage($stockageTest);
        
?>