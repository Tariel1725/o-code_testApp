<head>
    <title>TestApplication</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-grid.css" rel="stylesheet">
    <link href="css/bootstrap-reboot.css" rel="stylesheet">
    <link href="css/bootstrap-utilities.css" rel="stylesheet">
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/md5.js"></script>
</head>

<?php
require_once 'view/smarty/libs/Smarty.class.php';
require_once 'back/news.php';
require_once 'back/users.php';
$users = new users();
$news = new news();
$smarty = new Smarty();

$smarty->setTemplateDir('view/templates/');
$smarty->setCompileDir('view/templates_c/');
$smarty->setConfigDir('view/configs/');
$smarty->setCacheDir('view/cache/');

$smarty->assign('title', 'Для работы с приложение пожалуйста авторизуйтесь');
if(isset($_COOKIE['sessionKey'])&&isset($_COOKIE['userId'])){
    $users->id = $_COOKIE['userId'];
    $users->sessionKey = $_COOKIE['sessionKey'];
    if($users->checkSession()>0){
        if(isset($_GET['newsPage'])){
            $news = $news->newsList($_GET['newsPage'], $_COOKIE['userId']);
            $smarty->assign('news', $news[0]);
            $smarty->display('newsPage.tpl');
        }
        else{
            $newsList = $news->newsList(null, $_COOKIE['userId']);
            $smarty->assign('newsList', $newsList);
            $smarty->display('news.tpl');
        }
    }
}
else{
    $smarty->display('login.tpl');
}
?>
<script>
    let input = document.getElementById('passwordRepeat')
    let passwordInput = document.getElementById('password');
    input.addEventListener('input', () => {
        if(input.value===passwordInput.value){
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
            passwordInput.classList.add('is-valid');
            passwordInput.classList.remove('is-invalid');
        }
        else {
            input.classList.remove('is-valid');
            passwordInput.classList.remove('is-valid');
            input.classList.add('is-invalid');
            passwordInput.classList.add('is-invalid');
        }
    });
</script>
