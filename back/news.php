<?php
require_once 'dbSocket.php';
class news
{
    public $news;

    public function createNews(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('INSERT INTO `news` (`title`, `date`, `author`, `announcement`, `text`) VALUES (:title, :date, :author, :announcement, :text)');
        $stmt->execute(['title' => $this->news[0]['title'],
                        'date' => date('Y-m-d'),
                        'author' => $this->news[0]['author'],
                        'announcement' => $this->news[0]['announcement'],
                        'text' => $this->news[0]['text']]);
        return $connector->dbSocket->lastInsertId();
    }

    public function newsList($newsId = null){
        $news = [];
        $connector = new dbSocket();
        $where = '';
        if($newsId!=null){
            $where = 'WHERE `id` = ?';
        }
        $stmt = $connector->dbSocket->prepare('SELECT * FROM `news`'.$where);
        $stmt->execute($newsId);
        while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
            $news[] = $row;
        }
        return $news;
    }

    public function editNews(){
        $news = $this->newsList($this->news[0]['id']);
        if($news[0]['author']==$this->news['author']) {
            $connector = new dbSocket();
            $stmt = $connector->dbSocket->prepare('UPDATE `news` SET `title` = :title, `announcement` =  :announcement, `text` = :text WHERE `id` = :id');
            $stmt->execute(['title' => $this->news[0]['title'],
                'announcement' => $this->news[0]['announcement'],
                'text' => $this->news[0]['text'],
                'id' => $this->news[0]['id']]);
            return true;
        }
        else{
            return false;
        }
    }
}