<?php
/* Smarty version 3.1.30, created on 2017-12-06 10:02:04
  from "H:\UwAmp\www\startbootstrap-bare-gh-pages\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a27c01cb32a91_33398352',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed3bb91c1034654a3ade4bb59e3760f8b0765cee' => 
    array (
      0 => 'H:\\UwAmp\\www\\startbootstrap-bare-gh-pages\\templates\\index.tpl',
      1 => 1512554522,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a27c01cb32a91_33398352 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="container ">
    <div class="row">

        <div class="col-lg-12 text-center">

            <h1 class="mt-5">Bienvenue</h1>
            <p class="lead">Vous voici sur la page d'accueil</p>
            <?php if (isset($_smarty_tpl->tpl_vars['tab_session']->value['notification'])) {?> <!-- vérifie qu'il y a une notification en session -->
                <div class="alert <?php echo $_smarty_tpl->tpl_vars['notification_result']->value;?>
 alert-dismissible fade show" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>                   
                    </button>
                    <?php echo $_smarty_tpl->tpl_vars['tab_session']->value['notification'];?>

                </div>
            <?php }?>
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
            <?php if (!isset($_smarty_tpl->tpl_vars['get']->value['recherche'])) {?> <!-- affiche les articles -->
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                    <div class="card col-md-8 border border-secondary">
                        </br>
                        <img class="card-img-top" src="img/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
">
                        <br/>
                        <h3 class="card-title "><?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
</h3>
                        <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['value']->value['texte'];?>

                        </p>
                        <div class="card-body col">
                            <a href="#" class="btn btn-info ">Créé le : <?php echo $_smarty_tpl->tpl_vars['value']->value['date_fr'];?>
</a>
                            <a href="article.php?action=modifier&id_article=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info ">Modifier l'article</a>
                            <a href="delete.php?action=supprimer&id_article=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info ">Supprimer l'article</a>
                            <a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page_courante']->value;?>
&action=commentaire&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info" name="Commentaire">Commentaire</a>
                            </br> </br>
                            <?php if (($_smarty_tpl->tpl_vars['get']->value['action'] == "commentaire")) {?> <!-- affiche les commentaires de l'article -->
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles_commentaire']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <div class="card">
                                        <div class="card-body" style="background-color:Gainsboro">
                                            <h6 class="card-title text-left font-weight-bold">Ajouté par <font color="red"><?php echo $_smarty_tpl->tpl_vars['value']->value['nom'];?>
 <?php echo $_smarty_tpl->tpl_vars['value']->value['prenom'];?>
 </font> le <?php echo $_smarty_tpl->tpl_vars['value']->value['date'];?>
 :</h6>
                                            <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['value']->value['txt'];?>
</p>
                                        </div>
                                    </div>
                                    </br>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                <form action="index.php?action=ajouter_commentaire&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" method="POST" enctype="multipart/form-data" id='form_commentaire'>
                                    <div class="form-group">
                                        <label for="titre" class="col-form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom" required></br>
                                        <label for="texte" class="col-form-label" >Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre Prénom" required></br>
                                        <label for="mail" class="col-form-label" >Email</label>
                                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre Email" required></br>
                                        <label for="commentaire" class="col-form-label">Commentaire</label>
                                        <textarea type="text" class="form-control" id="commentaire" name="commentaire" rows="6" placeholder="Entrez ici votre commentaire" required></textarea>
                                        <input type="hidden" name="id" value="<?php echo '<?=';?> $id <?php echo '?>';?>" />
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="submit" value="ajouter_commentaire" >Ajouter</button>
                                        </div>
                                    </div>
                                </form>

                            <?php }?>
                        </div>             
                    </div>
                    </br>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


            <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles_recherche']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?> <!-- affiche les résultats de la recherche -->
                    <div class="card col-md-8 border border-secondary">
                        </br>
                        <img class="card-img-top" src="img/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
">
                        <br/>
                        <h3 class="card-title "><?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
</h3>
                        <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['value']->value['texte'];?>

                        </p>
                        <div class="card-body col">
                            <a href="#" class="btn btn-info ">Créé le : <?php echo $_smarty_tpl->tpl_vars['value']->value['date_fr'];?>
</a>
                            <a href="article.php?action=modifier&id_article=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info ">Modifier l'article</a>
                            <a href="delete.php?action=supprimer&id_article=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info ">Supprimer l'article</a>
                            <a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['page_courante']->value;?>
&action=commentaire&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-info" name="Commentaire">Commentaire</a>
                            </br>
                            </br>
                            <?php if (($_smarty_tpl->tpl_vars['get']->value['action'] == "commentaire")) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles_commentaire']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <div class="card">
                                        <div class="card-body" style="background-color:Gainsboro">
                                            <h6 class="card-title text-left font-weight-bold">Ajouté par <font face="georgia" color="red"><?php echo $_smarty_tpl->tpl_vars['value']->value['nom'];?>
 <?php echo $_smarty_tpl->tpl_vars['value']->value['prenom'];?>
 </font> le <?php echo $_smarty_tpl->tpl_vars['value']->value['date'];?>
 :</h6>
                                            <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['value']->value['txt'];?>
</p>
                                        </div>
                                    </div>
                                    </br>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                            <br/>
                            </br>
                        </div>
                    </div> 
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
            </br>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['nb_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nb_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                        <li class="page-item <?php if ($_smarty_tpl->tpl_vars['page_courante']->value == $_smarty_tpl->tpl_vars['i']->value) {?>active<?php }?>">
                            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
                        <?php }
}
?>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript -->
<?php echo '<script'; ?>
 src="vendor/jquery/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="vendor/popper/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/dist/jquery.validate.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/dist/localization/messages_fr.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function () {
        $('#mdp').hide();
    });
<?php echo '</script'; ?>
>
<style> 
            label.error {
                color: red;
            }
        </style>

        <?php echo '<script'; ?>
>
            $(document).ready(function () {
                $("#form_commentaire").validate();
            });
        <?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
