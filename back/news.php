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

    public function newsList($newsId = null, $userId = null){
        $news = [];
        $connector = new dbSocket();
        $where = '';
        $data = null;
        if($newsId!=null){
            $where = 'WHERE n.`id` = :newsId';
            $data = ['newsId'=>$newsId];
        }
        $stmt = $connector->dbSocket->prepare('SELECT 
                                                     n.`id` as `id`, 
                                                     n.`title` as `title`, 
                                                     n.`announcement` as `announcement`, 
                                                     u.`user_name` as `author`,
                                                     n.`date` as `date`,
                                                     n.`text` as `text`,
                                                     n.`author` as `authorId`
                                                     FROM `news` n 
                                                     INNER JOIN `users` u ON u.`id` = n.`author` '.$where);
        $stmt->execute($data);
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($userId!=null){
            foreach ($news as $k => $v){
                if($v['authorId']==$userId){
                    $news[$k]['editable'] = 1;
                }
                else{
                    $news[$k]['editable'] = 0;
                }
            }
        }
        return $news;
    }

    public function editNews(): bool
    {
        $news = $this->newsList($this->news[0]['id']);
        print_r($this->news);
        if($news[0]['authorId']==$this->news[0]['author']) {
            $connector = new dbSocket();
            $stmt = $connector->dbSocket->prepare('UPDATE `news` SET `title` = :title, `announcement` =  :announcement, `text` = :text WHERE `id` = :id');
            $stmt->execute(['title' => $this->news[0]['title'],
                'announcement' => $this->news[0]['announcement'],
                'text' => $this->news[0]['text'],
                'id' => $this->news[0]['id']]);
            print_r($stmt->errorInfo());
            return true;
        }
        else{
            return false;
        }
    }
}