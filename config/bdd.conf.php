<?php

// connexion à la base de données 
try {

    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    $bdd->exec("set names utf8");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
