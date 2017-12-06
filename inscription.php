<?php
require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';

//fonction de cryptage
function cryptPassword($mdp) {
    $mdp_crypt = sha1($mdp);
    return $mdp_crypt;
}

/*
  Cette page permet d'inscrire un utilisateur au site. On ne peut s'inscrire si on n'est pas connecté. Un nouvel utilisateur doit contacter
  l'administrateur pour pouvoir l'inscrire
 */

if (isset($_COOKIE["sid"])) { //vérifie qu'il y a un utilisateur de connecté 
    if (isset($_POST['submit'])) {
        print_r($_POST);

        $notification = 'Aucune notification à afficher';
        $_SESSION['notification_result'] = FALSE;


        if (!empty($_POST['nom']) AND ! empty($_POST['prenom']) AND ! empty($_POST['mail']) AND ! empty($_POST['mdp'])) { // je vérifie que tout les champs sont remplis
            $insert = "INSERT INTO utilisateurs(nom, prenom, email, mdp)"
                    . "VALUES(:nom, :prenom, :mail, :mdp)"; //Requete sql qui permet d'insérer un utilisateur dans la base de données

            $sth = $bdd->prepare($insert);
            $sth->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
            $sth->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $sth->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
            $sth->bindValue(':mdp', cryptPassword($_POST['mdp']), PDO::PARAM_STR);



            if ($sth->execute() == TRUE) {

                $notification = '<strong>Bravo</strong>, votre inscription a été réalisé avec succés.';
                $_SESSION['notification_result'] = TRUE;
            } else {

                $notification = 'Une erreur est survenu lors de votre inscription';
                $_SESSION['notification_result'] = FALSE;
            }
        } else {

            $notification = 'Veuillez renseigner les champs obligatoires.';
            $_SESSION['notification_result'] = FALSE;
        }

        $_SESSION['notification'] = $notification;
        header('Location: inscription.php'); //redirection vers 
        exit();
    } else {
        include 'includes/header.inc.php';
        ?>
        <div class="container col-md-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="mt-5">Inscription</h1>
                </div>
            </div>
            <?php
            if (isset($_SESSION['notification'])) { //verifie que la session notification existe
                $notification_result = $_SESSION['notification_result'] == TRUE ? 'alert-success' : 'alert-danger'; //on indique la couleur à afficher selon le résultats
                ?>
                <div class="alert <?= $notification_result //on affiche la notification ?> alert-dismissible fade show" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                   
                    </button>
                    <?= $_SESSION['notification'];
                    ?>
                </div>
                <?php
                unset($_SESSION['notification']);
                unset($_SESSION['notification_result']);
            }
            ?>
            <form action="inscription.php" method="post" enctype="multipart/form-data" id="form_inscription">
                <div class="form-group">
                    <label for="titre" class="col-form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom" required>

                </div>
                <div class="form-group">
                    <label for="texte" class="col-form-label" >Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre Prénom" required>
                </div>

                <div class="form-group">
                    <label for="mail" class="col-form-label" >Email</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre Email" required>
                </div>

                <div class="form-group">
                    <label for="mdp" class="col-form-label" >Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Votre Mot de Passe" required>
                </div>

                <button type="submit" class="btn btn-danger" name="submit" value="ajouter">Inscription</button>
            </form>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/dist/jquery.validate.min.js"></script>
        <script src="js/dist/localization/messages_fr.min.js"></script>


        <style> 
            label.error {
                color: red;
            }
        </style>

        <script>
            $(document).ready(function () {
                $("#form_inscription").validate();
            });
        </script>
        <?php
    }
} else {
    include 'includes/header.inc.php';
    ?>
    <div class="container col-md-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-5">Contacter votre administrateur pour qu'il puisse vous inscrire</h2> 
            </div>
        </div>
    </div>
    <?php
}
?>
?>