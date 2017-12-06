<?php

require_once 'config/init.conf.php'; //demarrage de session
require_once 'config/bdd.conf.php'; //connexion à la base de données pour les requêtes à venir 
require_once 'includes/fonction.inc.php'; //fonction
include 'config/connexion.conf.php'; //vérifie que l'utilisateur est connecté
require_once('libs/Smarty.class.php'); //class pour les pages smarty
include 'includes/notification.inc.php'; //système de notification


/*
  Cette page est l'index du blog, ici, nous allons retrouver plusieurs éléments. Nous allons savoir si l'utilisateur est connecté ou non
 * Nous pouvons voir les différents article présent dans la base de données
 * Cette page va afficher les différents commentaires lié aux articles qui ont été ajouté 
 * Cette page à une méthode de recherche pour trouver un article précis selon son titre ou le contenu de son texte
 */




$nb_articles_par_page = 1;

$page_courante = isset($_GET['page']) ? $_GET['page'] : 1;

$index = pagination($page_courante, $nb_articles_par_page);

$nb_total_article_publie = nb_total_article_publie($bdd);

$nb_pages = ceil($nb_total_article_publie / $nb_articles_par_page); //système de pagination


error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$select = "SELECT id, "
        . "titre, "
        . "texte, "
        . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
        . "FROM articles "
        . "WHERE publie = :publie "
        . "ORDER BY titre "
        . "LIMIT :index, :nb_articles_par_page;"; //requête qui permet d'afficher les articles publié présent dans la base de données 
//echo $select; 
/* @var $bdd PDO */
$sth = $bdd->prepare($select);
$sth->bindValue(':publie', 1, PDO::PARAM_BOOL);
$sth->bindValue(':index', $index, PDO::PARAM_INT);
$sth->bindValue(':nb_articles_par_page', $nb_articles_par_page, PDO::PARAM_INT);




if ($sth->execute() == TRUE) {
    $tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC); //on met le résultat d ela recherche dans un tableau
    //print_r($tab_articles);
    //echo $tab_articles[0]['titre'];
} else {
    echo 'Une erreur est survenue..';
}


if (isset($_GET['recherche'])) { //vérifie si il y a une recherche d'efectué 
    $sql = "SELECT id, "
            . "titre, "
            . "texte, "
            . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
            . "FROM articles "
            . "WHERE (titre LIKE :recherche or texte LIKE :recherche) "
            . "AND publie=1 "
            . "ORDER BY date DESC "
            . "LIMIT :debut, :message_par_page;";  //requête qui permet d'afficher le ou les articles recherché 

    $stt = $bdd->prepare($sql);
    $stt->bindValue(':publie', 1, PDO::PARAM_BOOL);
    $stt->bindValue(':debut', $index, PDO::PARAM_INT);
    $stt->bindValue(':message_par_page', $nb_articles_par_page, PDO::PARAM_INT);
    $stt->bindValue(':recherche', '%' . $_GET['recherche'] . '%', PDO::PARAM_STR);

    if ($stt->execute() == TRUE) {
        $tab_articles_recherche = $stt->fetchAll(PDO::FETCH_ASSOC); //on met le résultat d ela recherche dans un tableau
        //print_r($tab_articles);
        //echo $tab_articles_recherche[0]['titre'];
    } else {
        echo 'Une erreur est survenue..';
    }
}

if (isset($_SESSION['notification'])) { //verifie que la session notification existe
    $notification_result = $_SESSION['notification_result'] == TRUE ? 'alert-success' : 'alert-danger'; //on indique la couleur à afficher selon le résultats

    unset($_SESSION['notification']);
    unset($_SESSION['notification_result']);
} else {
    $notification_result = "";
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "commentaire") { //verifie que l'action est égale à commentaire
        $sql = "SELECT commentaires.texte as txt, commentaires.nom, commentaires.prenom, commentaires.date as date "
                . "FROM commentaires "
                . "INNER JOIN articles ON commentaires.id_articles=articles.id "
                . "WHERE id_articles = :id"; //requête qui permet d'afficher les commentaires

        $std = $bdd->prepare($sql);
        $std->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        if ($std->execute() == TRUE) {
            $tab_articles_commentaire = $std->fetchAll(PDO::FETCH_ASSOC);
            //print_r ($tab_articles_commentaire);
        } else {
            echo "Une erreur est survenue.. ";
        }
    }
}


if (isset($_GET['action'])) {
    if ($_GET['action'] == "ajouter_commentaire") { //verifie que l'action est égale à ajouter_commentaire 
        $date_du_jour = date("Y-m-d");
        //echo $_GET['id'];
        //exit();
        $sql = "INSERT INTO commentaires values ('', :commentaire, :nom, :prenom, :mail, :datedujour, :id_articles)"; //requête qui permet d'insérer un commentaire en base 

        $std = $bdd->prepare($sql);
        $std->bindValue(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
        $std->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $std->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $std->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
        $std->bindValue(':datedujour', $date_du_jour, PDO::PARAM_STR);
        $std->bindValue(':id_articles', $_GET['id'], PDO::PARAM_INT);

        if ($std->execute() == TRUE) {
            header('Location:index.php');
        } else {
            echo "Une erreur est survenue.. ";
        }
    }
}





$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('configs/');
//$smarty->setCacheDir('cache/');

$smarty->assign('is_connect', $is_connect);
$smarty->assign('nom_connect', $nom_connect);
$smarty->assign('prenom_connect', $prenom_connect);
$smarty->assign('tab_session', $_SESSION);
$smarty->assign('tab_articles', $tab_articles);
$smarty->assign('tab_articles_recherche', $tab_articles_recherche);
$smarty->assign('tab_commentaires', $tab_commentaires);
$smarty->assign('nb_pages', $nb_pages);
$smarty->assign('page_courante', $page_courante);
$smarty->assign('is_active', $is_active);
$smarty->assign('notification_result', $notification_result);
$smarty->assign('get', $_GET);
$smarty->assign('tab_articles_commentaire', $tab_articles_commentaire);

//** un-comment the following line to show the debug console
//$smarty->debugging = true;

include 'includes/header.inc.php';
$smarty->display('index.tpl');
?>

