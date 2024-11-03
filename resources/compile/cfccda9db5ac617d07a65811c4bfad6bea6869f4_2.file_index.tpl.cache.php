<?php
/* Smarty version 5.4.1, created on 2024-10-20 18:42:50
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_67154f2a1257f1_34822744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfccda9db5ac617d07a65811c4bfad6bea6869f4' => 
    array (
      0 => 'index.tpl',
      1 => 1729449768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67154f2a1257f1_34822744 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/resources/views';
$_smarty_tpl->getCompiled()->nocache_hash = '96629508067154f2a104844_44765132';
?>
<html>
    Hello <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('entity')), ENT_QUOTES, 'UTF-8');?>

</html><?php }
}
