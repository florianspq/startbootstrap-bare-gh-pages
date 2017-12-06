<?php

//fonction de cryptage
function cryptPassword($mdp) { //fonction de cryptage pour le'insertion en base de données d'un uilisateur
    $mdp_crypt = sha1($mdp);
    return $mdp_crypt;
}

function sid($email){ //
    $sid = md5($email . time());
    return $sid;
} 

// Fonction de retour d'index pour la pagination
function pagination($page_courante, $nb_articles_par_page){ //pagination en fin de page
    
    $index = ($page_courante - 1) * $nb_articles_par_page;
    return $index;
    
}

function nb_total_article_publie($bdd){ //compte le nombre d'article publié pour la pagination
    /* @var $bdd PDO */ 
    $sql = "SELECT COUNT(*) as nb_total_article_publie "
            . "FROM articles "
            . "WHERE publie=1";
    $sth = $bdd->prepare($sql);
    $sth->execute();
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    return $tab_result['nb_total_article_publie'];
}

?>