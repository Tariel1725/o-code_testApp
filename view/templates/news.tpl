<div class="container ">
    <div class="row border-1 border-bottom border-dark mb-5 justify-content-end">
        <button class="btn col-2 btn-primary" onclick="$('#addNews').modal('show')">Добавить новость</button>
    </div>
    <div class="row">
        {foreach $newsList as $news}
            <div class="col-5 m-1 p-1 border border-1 border-secondary">
                {if $news.editable eq 1}
                    <div class="col-1 align-self-end">
                        <i class="fa fa-pencil-square-o " style="cursor: pointer" aria-hidden="true" onclick=" editFormFill({$news.id}); $('#editNews').modal('show');"></i>
                    </div>
                {/if}
                <p><a href="index.php?newsPage={$news.id}">{$news.title|escape}</a></p>
                <p>{$news.announcement}</p>
                <i>{$news.date} {$news.author}</i>
            </div>
            {foreachelse}
            <h3>В базе нет новостей</h3>
        {/foreach}
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
</div>