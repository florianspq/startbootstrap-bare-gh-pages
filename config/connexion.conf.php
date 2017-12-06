<?php

require_once 'bdd.conf.php';
//permet de faire la connexion au site avec le cookie
$is_connect = false;

if (isset($_COOKIE['sid']) AND ! empty($_COOKIE['sid'])) { //vérifie que le cookie existe
    $requete_cookie = "SELECT COUNT(*) as nb_sid, nom, prenom, id "
            . "FROM utilisateurs "
            . "WHERE sid = :sid"; //vérifie que le cookie est bien egale à celui dans la bdd

    $sth = $bdd->prepare($requete_cookie);
    $sth->bindValue(':sid', $_COOKIE['sid'], PDO::PARAM_STR);

    $sth->execute();

    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);

    if ($tab_result['nb_sid'] > 0) {
        $is_connect = TRUE;
        $nom_connect = $tab_result['nom'];
        $prenom_connect = $tab_result['prenom'];
        $id_connect = $tab_result['id'];
    }
}
?>