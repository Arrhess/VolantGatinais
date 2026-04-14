<?php
//Definition des constantes :

define("DBHOST","mysql-levolantgatinais.alwaysdata.net");
define("DBUSER","levolantgatinais");
define("DBPASS","Volantgatinais@2026");
define("DBNAME","levolantgatinais_bdd");

// DSN de connection :

$dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

// on se connect à la base:

try{
    $db = new PDO($dsn, DBUSER, DBPASS);
    // On s'assure d'utiliser utf-8
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}
