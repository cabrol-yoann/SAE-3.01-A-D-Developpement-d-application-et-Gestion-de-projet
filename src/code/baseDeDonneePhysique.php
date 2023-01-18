<?php

include_once "../classe/Stockage.php";
include_once "../classe/Dossier.php";
include_once "../classe/Fichier.php";

// ESPACE DE STOCKAGE
$drive = new Stockage("SAE","/",500000000,false);
$cloud = new Stockage("TEST","/",666690420,true);
$FTP = new Stockage("Stockage","/",987654321,true);
$petitStockage = new Stockage("petit", "/", 200000, true);
$stockagePlein = new Stockage("plein", "/",50000000, true);

$stockage = new \SplObjectStorage();
$stockage -> attach($drive);
$stockage -> attach($cloud);
$stockage -> attach($FTP);
//$stockage -> attach($petitStockage);
//$stockage -> attach($stockagePlein);

//DOSSIER
$dossier1 = new Dossier("TD","/TD");
$dossier2 = new Dossier("photo","/photo");
$dossier3 = new Dossier("cour","/cour");
$dossier4 = new Dossier("noël","/photo/noël");
$dossier5 = new Dossier("vacance","/photo/vacance");
$dossier6 = new Dossier("dev","/TD/dev");
$dossier7 = new Dossier("gestion projet","/cour/gestionprojet");
$dossier8 = new Dossier("ski","/photo/vacance/ski");
$dossier9 = new Dossier("TP","/TP");

// FICHIER
$fichier = new Fichier("buche",300000,"/photo/noël/buche","png");
$fichier1 = new Fichier("sapin",383000,"/photo/noël/sapin","png");
$fichier2 = new Fichier("decoMaison",500000,"/photo/noël/decoMaison","png");
$fichier3 = new Fichier("montagne",475000,"/photo/vacance/ski/montagne","png");
$fichier4 = new Fichier("raclette",183000,"/photo/vacance/ski/raclette","png");
$fichier5 = new Fichier("polymorphisme",351085,"/TD/dev/polymorphisme","pdf");
$fichier6 = new Fichier("cycle_v",864215,"/cour/gestion projet/cycle_v","pdf");
$fichier7 = new Fichier("SCRUM",256755,"/cour/gestion projet/SCRUM","word");

// TAG
$tag = new Tag("photo");
$tag1 = new Tag("noël");
$tag2 = new Tag("cour");
$tag3 = new Tag("travail");

// CREATION DE LA LISTE DE TAGS (arraylist)
$tags = new \SplObjectStorage();
$tags -> attach($tag);
$tags -> attach($tag1);
$tags -> attach($tag2);
$tags -> attach($tag3);

// AJOUT DES ENFANTS
$drive->setMaRacine($dossier1);
$cloud->setMaRacine($dossier2);
$FTP->setMaRacine($dossier3);
//$petitStockage->setMaRacine($dossier9);
//$stockagePlein->setMaRacine($dossier8);

$dossier1->ajouterEnfantDossier($dossier6);

$dossier2->ajouterEnfantDossier($dossier4);
$dossier2->ajouterEnfantDossier($dossier5);

$dossier3->ajouterEnfantDossier($dossier7);

$dossier4->ajouterEnfantFichier($fichier1);
$dossier4->ajouterEnfantFichier($fichier);
$dossier4->ajouterEnfantFichier($fichier2);

$dossier5->ajouterEnfantDossier($dossier8);

$dossier6->ajouterEnfantFichier($fichier5);

$dossier7->ajouterEnfantFichier($fichier6);
$dossier7->ajouterEnfantFichier($fichier7);

$dossier8->ajouterEnfantFichier($fichier3);
$dossier8->ajouterEnfantFichier($fichier4);

// AJOUT DES TAGS

$dossier1->ajouterTags($tag3);
$dossier2->ajouterTags($tag);
$dossier2->ajouterTags($tag1);
$dossier3->ajouterTags($tag2);
$dossier4->ajouterTags($tag);
$dossier4->ajouterTags($tag1);
$dossier5->ajouterTags($tag);
$dossier6->ajouterTags($tag3);
$dossier7->ajouterTags($tag2);
$dossier8->ajouterTags($tag);


// Object a ajouter

$objetAPlacer = new Fichier("sapin",1528,"","png");
$objetAPlacer->ajouterTags($tag1);
?>