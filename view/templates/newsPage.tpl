<div class="container ">
    <div class="row border-1 border-bottom border-dark mb-5 justify-content-end">
        <button class="btn col-2 btn-primary" onclick="toNewsList()">К списку новостей</button>
    </div>
    <div class="row">
        <div class="col-12 border border-1 border-secondary">
            <p>{$news.title|escape}</p>
            <p>{$news.announcement}</p>
            <p>{$news.text}</p>
            <i>{$news.date} {$news.author}</i>
        </div>

    </div>
</div>