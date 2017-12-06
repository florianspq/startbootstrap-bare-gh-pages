<?php
require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
include 'config/connexion.conf.php';
include 'includes/header.inc.php';
/*
  Page qui permet de supprimer un article et ses commentaires, je récupère id-articles à partir de la méthode GET et je le supprime dans la base de données avec une requete SQL

 */
if (isset($_POST['supprimer'])) {

    $delete = "DELETE FROM articles WHERE id= :id_article";
    $sth = $bdd->prepare($delete);
    $sth->bindValue(':id_article', $_POST['id_article'], PDO::PARAM_STR);

    $deleteCommentaire = "DELETE FROM commentaires WHERE id_articles= :id_article";
    $sthC = $bdd->prepare($deleteCommentaire);
    $sthC->bindValue(':id_article', $_POST['id_article'], PDO::PARAM_STR);

    if ($sth->execute() == TRUE) {
        $notification = '<strong>Bravo</strong>, votre article est bien été supprimé.';
        $_SESSION['notification_result'] = TRUE;
        $_SESSION['notification'] = $notification;
    }

    if ($sthC->execute() == TRUE) {
        header('Location: index.php');
    }
}
?>
<div class="container col-md-4">
    <div class="row">
        <div class="col-lg-12 text-center">
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            </br>
            <form action="delete.php" method="post" enctype="multipart/form-data" id="form_article">
                <?php if (isset($_GET['id_article'])) { ?>
                    <input type="hidden" name="id_article" value="<?= $_GET['id_article']; ?>">
                <?php } ?>
                Êtes-vous sur de vouloir supprimer l'article ?
                <button type="submit" class="btn btn-danger" name="supprimer">Oui</button>
                <a class="btn btn-danger" href="index.php" role="button">Non</a>
            </form>
        </div>
    </div>
</div>
