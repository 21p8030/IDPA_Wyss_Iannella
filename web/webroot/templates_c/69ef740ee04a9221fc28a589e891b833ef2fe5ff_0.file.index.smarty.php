<?php
/* Smarty version 3.1.39, created on 2022-01-27 15:00:52
  from '/var/www/html/src/views/index.smarty' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f2a594bb98c0_94686160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69ef740ee04a9221fc28a589e891b833ef2fe5ff' => 
    array (
      0 => '/var/www/html/src/views/index.smarty',
      1 => 1643292049,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.smarty' => 1,
    'file:navbar.smarty' => 1,
    'file:statistics.smarty' => 1,
  ),
),false)) {
function content_61f2a594bb98c0_94686160 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="de">

<head>
    <?php $_smarty_tpl->_subTemplateRender('file:html_header.smarty', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <title>Willkommen</title>
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender('file:navbar.smarty', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <h1>Herzlich Willkommen in unserem super tollen Forumm</h1>
    <div style="display: flex;">
        <div class="index_wrapper">
            <ul style="display: flex;"><div class="index_list_div">Kategorie</div><div>Anzahl Beiträge</div></ul>
            <hr class="index_hr">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['CategorysData']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                    <a href="/category?name=<?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
" style="text-decoration: none;"><ul style="display: flex;"><div class="index_list_div"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</div><div><?php echo $_smarty_tpl->tpl_vars['value']->value->numberOfThreads;?>
 Beiträge</div></ul></a>
                    <hr class="index_hr">
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
        <?php $_smarty_tpl->_subTemplateRender('file:statistics.smarty', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('stats'=>$_smarty_tpl->tpl_vars['stats']->value), 0, false);
?>
    </div>
</body>

</html><?php }
}
