<?php
include 'config/connexion.conf.php';

if(isset($_SESSION['notification'])) { //verifie que la session notification existe
    $notification_result = $_SESSION['notification_result'] == TRUE ? 'alert-success' : 'alert-danger'; //on indique la couleur à afficher selon le résultats
    ?>
        <div class="alert <?= $notification_result; //on affiche la notification?> alert-dismissible fade show" role="alert"> 
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

