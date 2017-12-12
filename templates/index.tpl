
<div class="container ">
    <div class="row">

        <div class="col-lg-12 text-center">

            <h1 class="mt-5">Bienvenue</h1>
            <p class="lead">Vous voici sur la page d'accueil</p>
            {if isset($tab_session['notification'])} <!-- vérifie qu'il y a une notification en session -->
                <div class="alert {$notification_result} alert-dismissible fade show" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                   
                    </button>
                    {$tab_session['notification']}
                </div>
            {/if }
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand">Recherche d'un article</a>
                <form class="form-inline" method='GET' action='index.php'>
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Recherche" name='recherche'>
                    <button type="submit" class="btn btn-outline-danger">Recherche</button>
                </form>
            </nav>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img\Desert.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img\Lighthouse.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img\Tulips.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </br>
            {if !isset($get['recherche'])} <!-- affiche les articles -->
                {foreach from=$tab_articles item=value }
                    <div class="card col-md-8 border border-secondary">
                        </br>
                        <img class="card-img-top" src="img/{$value['id']}.jpg" alt="{$value['titre'] }">
                        <br/>
                        <h3 class="card-title ">{$value['titre'] }</h3>
                        <p class="card-text">{$value['texte'] }
                        </p>
                        <div class="card-body col">
                            <a href="#" class="btn btn-info ">Créé le : {$value['date_fr']}</a>
							{if ($is_connect == TRUE)}
                            <a href="article.php?action=modifier&id_article={$value['id'] }" class="btn btn-info ">Modifier l'article</a>
                            <a href="delete.php?action=supprimer&id_article={$value['id'] }" class="btn btn-info ">Supprimer l'article</a>
							{/if}
                            <a href="index.php?page={$page_courante}&action=commentaire&id={$value['id']}" class="btn btn-info" name="Commentaire">Commentaire</a>
                            </br> </br>
                            {if ($get['action']=="commentaire")} <!-- affiche les commentaires de l'article -->
                                {foreach from=$tab_articles_commentaire item=$value}
                                    <div class="card">
                                        <div class="card-body" style="background-color:Gainsboro">
                                            <h6 class="card-title text-left font-weight-bold">Ajouté par <font color="red">{$value['nom']} {$value['prenom']} </font> le {$value['date']} :</h6>
                                            <p class="card-text">{$value['txt']}</p>
                                        </div>
                                    </div>
                                    </br>
                                {/foreach}
                                <form action="index.php?action=ajouter_commentaire&id={$value['id']}" method="POST" enctype="multipart/form-data" id='form_commentaire'>
                                    <div class="form-group">
                                        <label for="titre" class="col-form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom" required></br>
                                        <label for="texte" class="col-form-label" >Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre Prénom" required></br>
                                        <label for="mail" class="col-form-label" >Email</label>
                                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre Email" required></br>
                                        <label for="commentaire" class="col-form-label">Commentaire</label>
                                        <textarea type="text" class="form-control" id="commentaire" name="commentaire" rows="6" placeholder="Entrez ici votre commentaire" required></textarea>
                                        <input type="hidden" name="id" value="<?= $id ?>" />
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="submit" value="ajouter_commentaire" >Ajouter</button>
                                        </div>
                                    </div>
                                </form>

                            {/if}
                        </div>             
                    </div>
                    </br>
                {/foreach}

            {else}
                {foreach from=$tab_articles_recherche item=value } <!-- affiche les résultats de la recherche -->
                    <div class="card col-md-8 border border-secondary">
                        </br>
                        <img class="card-img-top" src="img/{$value['id'] }.jpg" alt="{$value['titre'] }">
                        <br/>
                        <h3 class="card-title ">{$value['titre'] }</h3>
                        <p class="card-text">{$value['texte'] }
                        </p>
                        <div class="card-body col">
                            <a href="#" class="btn btn-info ">Créé le : {$value['date_fr'] }</a>
							{if ($is_connect == TRUE)}
                            <a href="article.php?action=modifier&id_article={$value['id'] }" class="btn btn-info ">Modifier l'article</a>
                            <a href="delete.php?action=supprimer&id_article={$value['id'] }" class="btn btn-info ">Supprimer l'article</a>
							{/if}
                            <a href="index.php?page={$page_courante}&action=commentaire&id={$value['id']}" class="btn btn-info" name="Commentaire">Commentaire</a>
                            </br>
                            </br>
                            {if ($get['action']=="commentaire")}
                                {foreach from=$tab_articles_commentaire item=$value}
                                    <div class="card">
                                        <div class="card-body" style="background-color:Gainsboro">
                                            <h6 class="card-title text-left font-weight-bold">Ajouté par <font face="georgia" color="red">{$value['nom']} {$value['prenom']} </font> le {$value['date']} :</h6>
                                            <p class="card-text">{$value['txt']}</p>
                                        </div>
                                    </div>
                                    </br>
                                {/foreach}
                            {/if}
                            <br/>
                            </br>
                        </div>
                    </div> 
                {/foreach}
            {/if}
            </br>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {for $i=1 to $nb_pages}
                        <li class="page-item {if $page_courante == $i}active{/if}">
                            <a class="page-link" href="?page={$i }">{$i }</a>
                        {/for}
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/dist/jquery.validate.min.js"></script>
<script src="js/dist/localization/messages_fr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#mdp').hide();
    });
</script>
<style> 
            label.error {
                color: red;
            }
        </style>

        <script>
            $(document).ready(function () {
                $("#form_commentaire").validate();
            });
        </script>
</body>
</html>

