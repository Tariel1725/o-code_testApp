function readCookie(name) {
    let name_cook = name + "=";
    let spl = document.cookie.split(";");

    for (let i = 0; i < spl.length; i++) {
        let c = spl[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(name_cook) == 0) {
            return c.substring(name_cook.length, c.length);
        }
    }
}

function login(){
    let login = document.getElementById('loginForm').value;
    let pwd = md5(document.getElementById('passwordForm').value);
    $.ajax({
        type: 'POST',
        url: 'back/controller.php?action=login',
        method: 'post',
        dataType: 'html',
        data: {login:login, pwdHash:pwd},
        success: function(data) {
            if(data.length!==4){
                let userData = JSON.parse(data);
                document.cookie = "sessionKey="+userData['session'];
                document.cookie = "userId="+userData['userId'];
                window.location.reload();
            }
            else {
                document.getElementById('LoginFormTitle').innerText = 'Логин или пароль не верны';
            }
        },
    });
}

function editFormFill(id){
    $.ajax({
        type: 'POST',
        url: 'back/controller.php?action=newsData',
        method: 'post',
        dataType: 'html',
        data: {newsId:id},
        success: function(data) {
            if(data.length!==4){
                let newsData = JSON.parse(data);
                console.log(newsData[0]['title']);
                document.getElementById('newsId').innerText = newsData[0]['id'];
                document.getElementById('newsTitleEdit').value = newsData[0]['title'];
                document.getElementById('newsAnnouncementEdit').value = newsData[0]['announcement'];
                document.getElementById('newsTextEdit').value = newsData[0]['text'];
            }
        },
    });
}


function createNews(){
    $.ajax({
        type: 'POST',
        url: 'back/controller.php?action=addNews',
        method: 'post',
        dataType: 'html',
        data: {'userId':readCookie('userId'),
                'sessionKey':readCookie('sessionKey'),
                'title':document.getElementById('newsTitle').value,
                'announcement':document.getElementById('newsAnnouncement').value,
                'text':document.getElementById('newsText').value},
        success: function() {
            window.location.reload();
        },
    });
}

function updateNews(){
    $.ajax({
        type: 'POST',
        url: 'back/controller.php?action=updateNews',
        method: 'post',
        dataType: 'html',
        data: {'newsId':document.getElementById('newsId').innerText,
            'userId':readCookie('userId'),
            'sessionKey':readCookie('sessionKey'),
            'title':document.getElementById('newsTitleEdit').value,
            'announcement':document.getElementById('newsAnnouncementEdit').value,
            'text':document.getElementById('newsTextEdit').value},
        success: function(data) {
            window.location.reload();
        },
    });
}

function toNewsList(){
    let url = new URL(document.location);
    url.searchParams.delete('newsPage');
    window.history.pushState({}, '', url.toString());
    window.location.reload();
}
