<?php

//require_once 'config/init.conf.php';
require_once 'includes/fonction.inc.php';
require_once 'config/bdd.conf.php';
include 'config/connexion.conf.php';
require_once('libs/Smarty.class.php');


$prenom='Florian';

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('configs/');
//$smarty->setCacheDir('cache/');

$smarty->assign('name',$prenom);

//** un-comment the following line to show the debug console
//$smarty->debugging = true;

include 'includes/header.inc.php';
$smarty->display('smarty-test.tpl');
?>