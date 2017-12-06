<?php
require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
include 'config/connexion.conf.php';

//Dans cette page, nous allons pouvoir modifier ou ajouter un article selon le bouton dont on aura appuyé


if (isset($_COOKIE["sid"])) { // vérifie que l'utilisateur est connecté 
    if (isset($_POST['ajouter'])) {
        //print_r($_POST);
        print_r($_FILES);

        if ($_FILES['image']['error'] == 0) {

            $notification = 'Aucune notification à afficher';
            $_SESSION['notification_result'] = FALSE;
            $date_du_jour = date("Y-m-d");

            if (!empty($_POST['titre']) AND ! empty($_POST['texte'])) { //verifie que les données sont bien envoyées
                $publie = isset($_POST['publie']) ? $_POST['publie'] : 0; // si publie est coché il est égale à 1 sinon 0
                //var_dump($publie);

                $insert = "INSERT INTO articles(titre, texte, date, publie)"
                        . "VALUES(:titre, :texte, :date, :publie)"; //requête qui permet d'ajouter un articles




                /* @var $bdd PDO */
                $sth = $bdd->prepare($insert);
                $sth->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
                $sth->bindValue(':texte', $_POST['texte'], PDO::PARAM_STR);
                $sth->bindValue(':date', $date_du_jour, PDO::PARAM_STR);
                $sth->bindValue(':publie', $publie, PDO::PARAM_BOOL);

                if ($sth->execute() == TRUE) {

                    $id_article = $bdd->lastInsertId();
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    /*
                      $tab_extension = array(
                      'jpg ',
                      'png',
                      'jpeg'
                      );

                      $result_extension_image = in_array($extension, $tab_extension);
                      var_dump($result_extension_image);
                      exit();
                     */
                    move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $id_article . '.' . $extension);


                    $notification = '<strong>Bravo</strong>, votre article est bien inséré.';
                    $_SESSION['notification_result'] = TRUE;
                } else {
                    $notification = 'Une erreur est survenu lors de l\'insertion de votre article dans la base de données';

                    $_SESSION['notification_result'] = FALSE;
                }
            } else {
                $notification = 'Veuillez renseigner les champs obligatoires.';

                $_SESSION['notification_result'] = FALSE;
            }
        } else {
            $notification = 'Une erreur est survenu lors du traitement de votre image';
            $_SESSION['notification_result'] = FALSE;
        }

        $_SESSION['notification'] = $notification;
        header('Location: article.php');
        exit();
    } else if (isset($_POST['modifier'])) {

        $publie = isset($_POST['publie']) ? $_POST['publie'] : 0;
        $update = "UPDATE articles "
                . "SET titre = :titre, "
                . "texte = :texte, "
                . "publie = :publie "
                . "WHERE id = :id_article; "; //requête qui permet de modifier un article

        $sth = $bdd->prepare($update);
        $sth->bindValue(':id_article', $_POST['id_article'], PDO::PARAM_STR);
        $sth->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $sth->bindValue(':texte', $_POST['texte'], PDO::PARAM_STR);
        $sth->bindValue(':publie', $publie, PDO::PARAM_BOOL);





        if ($sth->execute() == TRUE) {

            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $_POST['id_article'] . '.' . $extension);

            header('Location: index.php');
            exit();
        } else {
            echo 'Une erreur est survenue..';
        }
    }




    include 'includes/header.inc.php';
    ?>
    <div class="container col-md-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if (isset($_GET['action'])) { ?> <h1 class="mt-5">Modifier un article</h1> <?php } else { ?><h1 class="mt-5">Ajouter un article</h1> <?php } ?> 
                <?php include 'includes/notification.inc.php' ?>
            </div>

        </div>
        <?php
        if (isset($_SESSION['notification'])) {
            $notification_result = $_SESSION['notification_result'] == TRUE ? 'alert-success' : 'alert-danger';
            ?>
            <div class="alert <?= $notification_result ?> alert-dismissible fade show" role="alert">
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




        <form action="article.php" method="post" enctype="multipart/form-data" id="form_article">
            <?php if (isset($_GET['id_article'])) { ?>
                <input type="hidden" name="id_article" value="<?= $_GET['id_article']; ?>">
            <?php } ?>
            <div class="form-group">
                <label for="titre" class="col-form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="" required>

            </div>
            <div class="form-group">
                <label for="texte" class="col-form-label" >Texte</label>
                <textarea type="text" class="form-control" id="texte" name="texte"></textarea>
            </div>

            <div class="form-group">
                <label for="image" class="custom-file">
                    <input type="file" id="image" name="image" class="custom-file-input">
                    <span class="custom-file-control">Choisir un fichier</span>
                </label>    
            </div>

            <div class="form-group">
                <div class="form-check">
                    <label for="publie" class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="publie" name="publie" value="1"> Publié ?
                    </label>
                </div>
            </div>
            <?php ?>
            <?php
            #------------------Boutons------------------#
            if (isset($_GET['action'])) {
                ?>
                <button type="submit" class="btn btn-danger" name="modifier">modifier un article</button>
            <?php } else { ?>                    
                <button type="submit" class="btn btn-danger" name="ajouter">ajouter un article</button>
    <?php } ?>

        </form>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <?php
} else {
    include 'includes/header.inc.php';
    ?>
    <div class="container col-md-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mt-5">Vous devez vous connecter</h2> 
            </div>
        </div>
    </div>
    <?php
}
?>
