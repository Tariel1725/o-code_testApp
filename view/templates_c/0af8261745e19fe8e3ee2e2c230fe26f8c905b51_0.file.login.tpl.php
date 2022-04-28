<?php
/* Smarty version 4.1.0, created on 2022-04-22 15:51:42
  from 'E:\projects\TestApplication\o-code_testApp\view\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_6262a4dec2c3c9_24085724',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0af8261745e19fe8e3ee2e2c230fe26f8c905b51' => 
    array (
      0 => 'E:\\projects\\TestApplication\\o-code_testApp\\view\\templates\\login.tpl',
      1 => 1650631901,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6262a4dec2c3c9_24085724 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container ">
    <div class="row justify-content-center">
        <h4 id="LoginFormTitle" class="text-center"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true);?>
</h4>
        <form class="form-control col-6"">
            <label for="loginForm">Логин</label>
            <input class="input-group" id="loginForm" type="text">
            <label for="passwordForm">Пароль</label>
            <input class="input-group" id="passwordForm" type="password">
            <button type="button" class="btn btn-primary" onclick="login()">Авторизация</button>
            <button type="button" class="btn btn-light" onclick="$('#register').modal('show')">К регистрации</button>
        </form>
    </div>
</div>

<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewsLabel">Modal title</h5>
                <button type="button" aria-label="Close" onclick="$('#editNews').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="name">Имя</label>
                <input id="name" type="text" class="form-control">
                <label for="email">E-mail</label>
                <input id="email" type="email" class="form-control">
                <label for="login">Логин</label>
                <input id="login" type="text" class="form-control">
                <label for="password">Пароль</label>
                <input id="password" type="password" class="form-control">
                <label for="passwordRepeat">Повтор пароля</label>
                <input id="passwordRepeat" type="password" class="form-control" onchange="function checkPassword()">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#editNews').modal('hide')">Отмена</button>
                <button type="button" class="btn btn-primary" onclick="updateNews()">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<?php }
}
