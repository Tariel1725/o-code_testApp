<?php
/* Smarty version 4.1.0, created on 2022-04-22 15:12:52
  from 'E:\projects\TestApplication\o-code_testApp\view\templates\newsPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_62629bc4555ff0_05806994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a982a79c36da025edaa0235f8bd09101e7beb53' => 
    array (
      0 => 'E:\\projects\\TestApplication\\o-code_testApp\\view\\templates\\newsPage.tpl',
      1 => 1650629565,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62629bc4555ff0_05806994 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container ">
    <div class="row border-1 border-bottom border-dark mb-5 justify-content-end">
        <button class="btn col-2 btn-primary" onclick="toNewsList()">К списку новостей</button>
    </div>
    <div class="row">
        <div class="col-12 border border-1 border-secondary">
            <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['news']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</p>
            <p><?php echo $_smarty_tpl->tpl_vars['news']->value['announcement'];?>
</p>
            <p><?php echo $_smarty_tpl->tpl_vars['news']->value['text'];?>
</p>
            <i><?php echo $_smarty_tpl->tpl_vars['news']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['news']->value['author'];?>
</i>
        </div>

    </div>
</div><?php }
}
