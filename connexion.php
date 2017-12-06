<?php

require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
require_once 'includes/fonction.inc.php';
include 'config/connexion.conf.php';

require_once('libs/Smarty.class.php');

/*
 * Cette page va permettre la connexion au site. L'utilisateur va devoir rentrer son adresse mail et son mot de passe pour se connecter
 * par le biais d'une requête sql
 */




if (isset($_POST['submit'])) {
    print_r($_POST);


    $notification = 'Aucune notification à afficher';
    $_SESSION['notification_result'] = FALSE;


    if (!empty($_POST['email']) AND ! empty($_POST['mdp'])) { // je vérifie que tout les champs sont remplis
        $mdp_hash = cryptPassword($_POST['mdp']); //mot de passe hasher mis dans une variable

        $select = "SELECT email, mdp "
                . "FROM utilisateurs "
                . "WHERE email = :email "
                . "AND mdp = :mdp"; //Requete sql

        /* @var $bdd PDO */
        $sth = $bdd->prepare($select);
        $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $sth->bindValue(':mdp', $mdp_hash, PDO::PARAM_STR);

        if ($sth->execute() == TRUE) {

            $count = $sth->rowCount();
            if ($count > 0) {
                $sid = sid($_POST['email']); //insere l'adresse mail dans le cookie
                $update_sid = "UPDATE utilisateurs "
                        . "SET sid = :sid "
                        . "WHERE email = :email ";
                $sth_update = $bdd->prepare($update_sid);
                $sth_update->bindValue(':sid', $sid, PDO::PARAM_STR);
                $sth_update->bindValue(':email', $_POST['email'], PDO::PARAM_STR); //insère le cookie en base

                if ($sth_update->execute() == TRUE) {

                    setcookie('sid', $sid, time() + 86400); //creation de cookie
                    $notification = '<strong>Bravo</strong> vous êtes connecté';
                    $_SESSION['notification'] = $notification;
                    $_SESSION['notification_result'] = TRUE;
                    header('Location: index.php'); //redirection vers 
                    exit();
                } else {

                    $notification = 'Une erreur est survenu lors de votre connexion';
                    $_SESSION['notification_result'] = FALSE;
                }
            } else {

                $notification = 'L\'email ou le mot de passe sont invalides.';
                $_SESSION['notification_result'] = FALSE;
            }
        } else {

            $notification = 'Une erreur est survenu lors de votre connexion';
            $_SESSION['notification_result'] = FALSE;
        }
    } else {

        $notification = 'Veuillez renseigner les champs obligatoires.';
        $_SESSION['notification_result'] = FALSE;
    }
    $_SESSION['notification'] = $notification;
    header('Location: connexion.php');
    exit();
} else {

    if (isset($_SESSION['notification'])) { //verifie que la session notification existe
        $notification_result = $_SESSION['notification_result'] == TRUE ? 'alert-success' : 'alert-danger'; //on indique la couleur à afficher selon le résultats

        unset($_SESSION['notification']);
        unset($_SESSION['notification_result']);
    } else {
        $notification_result = "";
    }

    $smarty = new Smarty();

    $smarty->setTemplateDir('templates/');
    $smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('configs/');
//$smarty->setCacheDir('cache/');

    $smarty->assign('is_connect', $is_connect);
    $smarty->assign('tab_session', $_SESSION);
    $smarty->assign('notification_result', $notification_result);

//** un-comment the following line to show the debug console
//$smarty->debugging = true;

    include 'includes/header.inc.php';
    $smarty->display('connexion.tpl');
}
?>     