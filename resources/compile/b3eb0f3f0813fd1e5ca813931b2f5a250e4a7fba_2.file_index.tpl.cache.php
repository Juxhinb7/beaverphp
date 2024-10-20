<?php
/* Smarty version 5.4.1, created on 2024-10-20 21:23:06
  from 'file:home/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_671574ba768aa7_37765880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3eb0f3f0813fd1e5ca813931b2f5a250e4a7fba' => 
    array (
      0 => 'home/index.tpl',
      1 => 1729459384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_671574ba768aa7_37765880 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/resources/views/home';
$_smarty_tpl->getCompiled()->nocache_hash = '1086452631671574ba758910_80428542';
?>
<html>

    <div class="container">
            
            <div style="display:flex; flex-direction: row; justify-content: space-between; column-gap: 70px;">
                <div><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>"beaver.png",'width'=>"170",'height'=>"165"), $_smarty_tpl);?>
</div>
               <div><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>"smartyLogo.png",'width'=>"170",'height'=>"165"), $_smarty_tpl);?>
</div>
            </div>
            <h1 style="padding-top: 3vh;"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('webFramework')), ENT_QUOTES, 'UTF-8');?>
 + <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('templateEngine')), ENT_QUOTES, 'UTF-8');?>
 </h1>


    </div>
    



   
</html>

<style>
    
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            top: 50;
            padding: 30vh;
            font-family:'Courier New', Courier, monospace;
        }


    {}
</style><?php }
}
