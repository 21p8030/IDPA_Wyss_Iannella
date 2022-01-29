<?php
/* Smarty version 3.1.39, created on 2022-01-27 15:00:16
  from '/var/www/html/src/views/html_header.smarty' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f2a5706964f3_63102536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06ae5b770d351c8796ac73dcd1d08286ee5208f7' => 
    array (
      0 => '/var/www/html/src/views/html_header.smarty',
      1 => 1643290213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:styles.smarty' => 1,
  ),
),false)) {
function content_61f2a5706964f3_63102536 (Smarty_Internal_Template $_smarty_tpl) {
?><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.1.3/dist/slate/bootstrap.css" integrity="sha256-NQ08LfRGH2KHlNkNv1YCz8TGoW5et9FWHvCbmv39Tbs=" crossorigin="anonymous">
    <?php $_smarty_tpl->_subTemplateRender('file:styles.smarty', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
 src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://kit.fontawesome.com/3940a601e9.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><?php }
}
