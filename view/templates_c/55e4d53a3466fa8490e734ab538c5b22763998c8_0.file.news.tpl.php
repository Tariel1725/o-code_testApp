<?php
/* Smarty version 4.1.0, created on 2022-04-22 15:19:46
  from 'E:\projects\TestApplication\o-code_testApp\view\templates\news.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_62629d6279ef87_77115419',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55e4d53a3466fa8490e734ab538c5b22763998c8' => 
    array (
      0 => 'E:\\projects\\TestApplication\\o-code_testApp\\view\\templates\\news.tpl',
      1 => 1650629979,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62629d6279ef87_77115419 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container ">
    <div class="row border-1 border-bottom border-dark mb-5 justify-content-end">
        <button class="btn col-2 btn-primary" onclick="$('#addNews').modal('show')">Добавить новость</button>
    </div>
    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['newsList']->value, 'news');
$_smarty_tpl->tpl_vars['news']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['news']->value) {
$_smarty_tpl->tpl_vars['news']->do_else = false;
?>
            <div class="col-5 m-1 p-1 border border-1 border-secondary">
                <?php if ($_smarty_tpl->tpl_vars['news']->value['editable'] == 1) {?>
                    <div class="col-1 align-self-end">
                        <i class="fa fa-pencil-square-o " style="cursor: pointer" aria-hidden="true" onclick=" editFormFill(<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
); $('#editNews').modal('show');"></i>
                    </div>
                <?php }?>
                <p><a href="index.php?newsPage=<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['news']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</a></p>
                <p><?php echo $_smarty_tpl->tpl_vars['news']->value['announcement'];?>
</p>
                <i><?php echo $_smarty_tpl->tpl_vars['news']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['news']->value['author'];?>
</i>
            </div>
            <?php
}
if ($_smarty_tpl->tpl_vars['news']->do_else) {
?>
            <h3>В базе нет новостей</h3>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</div>


<div class="modal fade" id="addNews" tabindex="-1" role="dialog" aria-labelledby="editNewsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNewsLabel">Редактирование новости</h5>
                <button type="button" aria-label="Close" onclick="$('#addNews').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="newsTitle">Заголовок</label>
                <input id="newsTitle" type="text" class="input-group">
                <label for="newsAnnouncement">Краткое содержание</label>
                <textarea id="newsAnnouncement" type="text" class="input-group"></textarea>
                <label for="newsText">Текст статьи</label>
                <textarea id="newsText" type="text" class="input-group"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#addNews').modal('hide')">Отмена</button>
                <button type="button" class="btn btn-primary" onclick="createNews()">Сохранить</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editNews" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewsLabel">Modal title</h5>
                <button type="button" aria-label="Close" onclick="$('#editNews').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Идентификатор </h4><h4 id="newsId"></h4>
                <label for="newsTitleEdit">Заголовок</label>
                <input id="newsTitleEdit" type="text" class="input-group">
                <label for="newsAnnouncementEdit">Краткое содержание</label>
                <textarea id="newsAnnouncementEdit" type="text" class="input-group"></textarea>
                <label for="newsTextEdit">Текст статьи</label>
                <textarea id="newsTextEdit" type="text" class="input-group"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#editNews').modal('hide')">Отмена</button>
                <button type="button" class="btn btn-primary" onclick="updateNews()">Сохранить</button>
            </div>
        </div>
    </div>
</div><?php }
}
