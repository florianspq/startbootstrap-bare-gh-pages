<?php
include 'includes/header.inc.php';
include 'config/connexion.conf.php';
?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Contact</h1>
                <?php include 'includes/notification.inc.php'?>
                <p class="lead">Veuillez remplir les champs ci-dessous</p>
                <form method="post" action="#" id="commentForm">
                    <div class="row justify-content-center" >
                        <div class="col-md-3 mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="nom" placeholder="Prénom" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">    
                        <div class="col-md-3 mb-3">
                            <label for="adresse1">Adresse1</label>
                            <input type="text" class="form-control" id="adresse1" name="adress1" placeholder="Adresse1" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="adresse2">Adresse2</label>
                            <input type="text" class="form-control" id="adresse2" name="adresse2" placeholder="Adresse2">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <label for="ville">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cp">Code Postal</label>
                            <input type="text" class="form-control" id="cp" name="cp" placeholder="Code Postal" data-mask="99999" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">    
                        <div class="col-md-3 mb-3">
                            <label for="civilite">Civilité</label>
                            <select class="form-control" id="civilite" name="civilite">
                                <option>Monsieur</option>
                                <option>Madadme</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="datenaiss">Date de Naissance</label>
                            <input type="text" class="form-control" id="datenaiss" name="datenaiss" placeholder="Date de naissance" required>
                        </div>      
                    </div>
                    <div class="row justify-content-center">  
                        <div class="col-md-3 mb-3">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
                        </div>
                        <div class="col-md-3 mb-3 ">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                        </div>
                        <div class="col-md-3 mb-3 " id="pass2">
                            <label for="mdp2">Confirmation Mot de passe</label>
                            <input type="password" class="form-control" id="mdp2" name="mdp2" placeholder="Confirmation Mot de passe" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">    
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </div>
                    </div>
                </form>
                <ul class="list-unstyled">
                    <li></li>
                    <li>jQuery 3.2.1</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="jquery/dist/jquery.validate.min.js"></script>
    <script src="jquery/dist/additional-methods.min"></script>
    
    <script>
        $(document).ready(function () {
            $('#pass2').hide();
            
            $('#mdp').change(function (){
                if($(this).val()!==''){
                    $('#pass2').fadeIn(1000);
                } else {
                    $('#pass2').fadeOut(1000);
                }
            });
            $( function() {
                $("#datenaiss").datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            } );
            $('#datenaiss').inputmask({
              mask: '99/99/9999'
               });
            $("#commentForm").validate();
        });
    </script>
  </body>

</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

