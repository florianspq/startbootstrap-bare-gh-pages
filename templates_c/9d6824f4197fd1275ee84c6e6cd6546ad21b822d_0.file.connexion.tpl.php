<?php
/* Smarty version 3.1.30, created on 2017-11-06 16:02:16
  from "H:\UwAmp\www\startbootstrap-bare-gh-pages\templates\connexion.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a0087884abf33_01322809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d6824f4197fd1275ee84c6e6cd6546ad21b822d' => 
    array (
      0 => 'H:\\UwAmp\\www\\startbootstrap-bare-gh-pages\\templates\\connexion.tpl',
      1 => 1509984060,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0087884abf33_01322809 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container col-md-4">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Connexion</h1>
        </div>
        </div>            
            <?php if (isset($_smarty_tpl->tpl_vars['tab_session']->value['notification'])) {?>
                <div class="alert <?php echo $_smarty_tpl->tpl_vars['notification_result']->value;?>
 alert-dismissible fade show" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                   
                </button>
                <?php echo $_smarty_tpl->tpl_vars['tab_session']->value['notification'];?>

                </div>
            <?php }?>
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
    
    
<style> 
    label.error {
    color: red;
    }
</style>

<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $("#form_article").validate();
    });
<?php echo '</script'; ?>
>
<?php }
}
