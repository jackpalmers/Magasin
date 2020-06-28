<?php

define( 'DB_NAME', 'db_magasin' );
define( 'DB_USER', 'root' ); // => A changer
define( 'DB_PASSWORD', 'root' ); // => A changer
define( 'DB_HOST', 'localhost:3308' ); // => A changer

$db = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASSWORD);

// On teste si la base existe
$requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$db->prepare($requete)->execute();


$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);

// Créations des tables client et produit
$tableClient = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`client` (
            `id_client` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `nom` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `prenom` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `date_naissance` DATE NOT NULL
            ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

$tableProduit = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`produit` (
            `id_produit` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `libelle` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `prix` INT(11) NOT NULL,
            `id_client` INT(11) NOT NULL,
            FOREIGN KEY (id_client) REFERENCES client (id_client)  
            ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

$db->prepare($tableClient)->execute();
$db->prepare($tableProduit)->execute();

header('Location: IHMS/accueil.php');
