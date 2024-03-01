<?php
/* Smarty version 5.0.0-rc1, created on 2024-02-22 15:12:02
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc1',
  'unifunc' => 'content_65d76442ac9370_53572082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe7fa6825faa369efcb1754df3aaa587fba4b9dd' => 
    array (
      0 => 'index.tpl',
      1 => 1708608142,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:index2.tpl' => 1,
  ),
))) {
function content_65d76442ac9370_53572082 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp8.12\\htdocs\\coalition\\wp-content\\themes\\ct-custom\\template-admin';
?><div class="wrap">
    Hello <?php echo $_smarty_tpl->getValue('name');?>
, welcome to Smarty!
    <?php $_smarty_tpl->renderSubTemplate('file:index2.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('foo'=>'bar'), (int) 0, $_smarty_current_dir);
?>
</div><?php }
}
