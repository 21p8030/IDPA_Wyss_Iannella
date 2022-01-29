<?php
/* Smarty version 3.1.39, created on 2022-01-27 15:00:16
  from '/var/www/html/src/views/statistics.smarty' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61f2a570748d73_16627121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9227f5376763e1a081650db9edd91da9d619245a' => 
    array (
      0 => '/var/www/html/src/views/statistics.smarty',
      1 => 1643290213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f2a570748d73_16627121 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="index_wrapper" style="height: 280px;">
<h2>Statistiken</h2>
    <ul style="display: flex;"><div class="index_list_div">Anzahl Fragen</div><div><?php echo $_smarty_tpl->tpl_vars['stats']->value[0];?>
</div></ul>
    <hr class="index_hr">
    <ul style="display: flex;"><div class="index_list_div">Anzahl Antworten</div><div><?php echo $_smarty_tpl->tpl_vars['stats']->value[1];?>
</div></ul>
    <hr class="index_hr">
    <ul style="display: flex;"><div class="index_list_div">Anzahl Benutzer</div><div><?php echo $_smarty_tpl->tpl_vars['stats']->value[2];?>
</div></ul>
</div><?php }
}
