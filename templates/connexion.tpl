<div class="container col-md-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Connexion</h1>
        </div>
        </div>            
            {if isset($tab_session['notification'])}
                <div class="alert {$notification_result} alert-dismissible fade show" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                   
                </button>
                {$tab_session['notification']}
                </div>
            {/if }
        <form action="connexion.php" method="post" enctype="multipart/form-data" id="form_article">
            <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre Email" required>
            </div>
            <div class="form-group">
                <label for="mdp" class="col-form-label" >Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Votre Mot de passe" required>
            </div>
        <button type="submit" class="btn btn-danger" name="submit">Connexion</button>
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
    $(document).ready(function(){
        $("#form_article").validate();
    });
</script>
