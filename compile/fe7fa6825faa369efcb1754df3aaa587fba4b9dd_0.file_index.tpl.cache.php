<?php
/* Smarty version 5.0.0-rc1, created on 2024-02-22 15:11:33
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc1',
  'unifunc' => 'content_65d76425093fb5_19312681',
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
function content_65d76425093fb5_19312681 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp8.12\\htdocs\\coalition\\wp-content\\themes\\ct-custom\\template-admin';
$_smarty_tpl->getCompiled()->nocache_hash = '185099027765d76425062cf3_99229900';
?>
<div class="wrap">
    Hello <?php echo $_smarty_tpl->getValue('name');?>
, welcome to Smarty!
    <?php $_smarty_tpl->renderSubTemplate('file:index2.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('foo'=>'bar'), (int) 0, $_smarty_current_dir);
?>
</div><?php }
}
