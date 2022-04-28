<?php
require_once 'news.php';
require_once 'users.php';

//Использовал switch-case для экономии времени, чтобы не городить полноценный контроллер на десяток методов тестового задания
switch ($_GET['action']){
    case 'login':
        if(isset($_POST['login'])){
            $user = new users();
            $user->login = $_POST['login'];
            $user->password = $_POST['pwdHash'];
            $result['session'] = $user->logIn();
            $result['userId'] = $user->id;
            echo json_encode($result);
        }
        break;
    case 'newsData':
        $news = new news();
        echo json_encode($news->newsList($_POST['newsId'], null));
        break;
    case 'addNews':
        $user = new users();
        $news = new news();
        $user->id = $_POST['userId'];
        $user->sessionKey = $_POST['sessionKey'];
        if($user->checkSession()>0){
            $news->news[0]['title'] = $_POST['title'];
            $news->news[0]['author'] = $_POST['userId'];
            $news->news[0]['announcement'] = $_POST['announcement'];
            $news->news[0]['text'] = $_POST['text'];
            $news->createNews();
        }
        break;
    case 'updateNews':
        $user = new users();
        $news = new news();
        $user->id = $_POST['userId'];
        $user->sessionKey = $_POST['sessionKey'];
        if($user->checkSession()>0){
            $news->news[0]['author'] = $_POST['userId'];
            $news->news[0]['title'] = $_POST['title'];
            $news->news[0]['id'] = $_POST['newsId'];
            $news->news[0]['announcement'] = $_POST['announcement'];
            $news->news[0]['text'] = $_POST['text'];
            $news->editNews();
        }
        break;
}
