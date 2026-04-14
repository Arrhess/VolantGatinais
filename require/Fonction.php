<?php

function  Nb_matchs(){
    if ($Nb_Joueur = 3){
        $Nb_Matchs = 3;
    }else if ($Nb_Joueur = 4){
        $Nb_Matchs = 6;
    }else if ($Nb_Joueur = 5){
        $Nb_Matchs = 10;
    }else if ($Nb_Joueur = 6){
        $Nb_Matchs = 15;
}}

//Fonction a continuer

function Matchs(){

//Definition des constantes :

define("DBHOSTF","localhost:3307");
define("DBUSERF","root");
define("DBPASSF","");
define("DBNAMEF","volantgatinais");

// DSN de connection :

$dsn = "mysql:dbname=".DBNAMEF.";host=".DBHOSTF;

// on se connect à la base:

try{
    $bdd = new PDO($dsn, DBUSERF, DBPASSF);
    // On s'assure d'utiliser utf-8
    $bdd->exec("SET NAMES utf8");
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}

    $NbPoule = 3;
    $Nb_Matchs = 3;
    for ($Poule = 1 ; $Poule <= $NbPoule ; $Poule++){
        for ($i = 1; $i<=$Nb_Matchs;$i++){

                $Nom_Table = "poule".$Poule;

                $sql = "SELECT Equipe FROM $Nom_Table WHERE id = $i";
                $requete = $bdd->exec($sql);
                
                $result = $requete->FetchAll();
        }
    }

}