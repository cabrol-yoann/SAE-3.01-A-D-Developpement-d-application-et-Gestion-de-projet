<?php
/**
 * @file debutRecherche.php
 * @author Cabrol Yoann, Gouaud Romain
 * @details Fonction permettant de restructurer un dossier
 * @version 3.0
 */


include_once "trierList.php";
include_once "recherche.php";


/**
 * @brief Fonction permettant d'initialiser la recherche. Elle s'occupe de chercher quels sont les stockages dans lesquel il est possible de stocker le fichier
 * @param SplObjectStorage $stockage Stockage dans lequel on va restructurer
 * @param Fichier $objetAPlacer Objet à placer
 * @param Stockage $nomStockageTrouver Espace dans lequel on va restructurer
 * @param Dossier $nomDossierTrouver Dossier dans lequel on va restructurer
 * @param bool $restructuration pour savoir si on est en mode restructuration
 * @return void
 */
function debutRecherche ($stockage, $objetAPlacer, &$nomStockageTrouver, &$nomDossierTrouver, $restructuration){
//Meilleur Emplacement
    //initialisation
    /**
     * @var int $score Score du dossier analysé
     * @var string $nomDossierTrouver Nom du dossier que l'on a trouvé
     * @var SplObjectStorage $listStockage Liste des stockages dans lesquels on peut stocker le dossier
     * @var bool $trouver Pour savoir si on a trouvé un dossier
     * @var int $tailleCalculer Taille total calculé du dossier avec le fichier à ajouter
     */
    $score = 0;
    $nomDossierTrouver = "";
    $listStockage = new \SplObjectStorage();
    $trouver = false;
    $tailleCalculer = 0;

    //Recherche de taille
    $stockage->rewind(); // placement de l'itérateur au début de la structure
    
    while($stockage->valid()){
        $nomStockage = $stockage->current();
        $tailleCalculer = $nomStockage->getTaille() + $objetAPlacer->getTaille();
        //On regarde si on peut stocker le dossier dans un espace puis on enregistre la valeur dans une liste
        if ($tailleCalculer > $nomStockage->getTailleMax()) {               // Fichier trop volumineux pour être stocké dans le stockage
            echo $tailleCalculer.$nomStockage->getNom(); echo '<br><br><br>';
            if ($restructuration == false) {
                if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                    if($objetAPlacer->getTaille() < $nomStockage->getTaille()){   // Et que le poids du fichier < taille totale du stockage
                        $listStockage->attach($nomStockage);
                    }
                }
            }
            elseif ($nomStockage->getNom() == $nomStockageTrouver->getNom()) { // Si on est en mode restructuration
                echo $nomStockage->getNom(). $nomStockageTrouver->getNom();
                if ($nomStockage->getRestructurable() == true) {                // Mais restructurable (donc peut potentiellement être intégré)
                    if($objetAPlacer->getTaille() < $nomStockage->getTaille()){   // Et que le poids du fichier < taille totale du stockage
                        $listStockage->attach($nomStockage);
                    }
                }
            }
        }
        else{ // Sinon, restructurable ou non, mais place suffisante pour l'intégrer
            $listStockage->attach($nomStockage);
        }

        $stockage->next();
    }
    //tri de la list
    trierList($listStockage);

    //Recherche dans tous les espaces de stockage
    $listStockage -> rewind();
    while($listStockage->valid()) { 
        recherche($score, $trouver, $nomDossierTrouver, $listStockage->current()->getMaRacine(), $objetAPlacer, $restructuration);
        //Recupération du nom de l'espace de stockage comportent la meilleur position
        if ($trouver == true) {
            $nomStockageTrouver = $listStockage->current();
        }
    
        $listStockage->next(); // A chaque itération de la boucle for, on passe à l'objet suivant de listStockage
    }
}




?>