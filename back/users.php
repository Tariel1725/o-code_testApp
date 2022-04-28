<?php
require_once 'dbSocket.php';

class users
{
    public $id;
    public $name;
    public $login;
    public $email;
    public $password;
    public $sessionKey;

    public function __construct(){
        $this->id = null;
        $this->name = null;
        $this->login = null;
        $this->email = null;
        $this->password = null;
        $this->sessionKey = null;
    }

    public function validateNewLogin(): bool
    {
        $this->selectUserByLogin();
        if($this->id==null){
            return true;
        }
        else{
            return false;
        }
    }

    public function validatePassword(): bool
    {
        if($this->password!=null&&!preg_match('/[^a-zA-Z0-9]/', $this->password)){
            return true;
        }
        else{
            return false;
        }
    }

    public function createUser(){
        if($this->validateNewLogin()&&$this->validatePassword()) {
            $this->password = md5($this->password);
            $connector = new dbSocket();
            $connector->dbSocket->prepare('INSERT INTO `users` (`user_name`, `login`, `email`, `password`) VALUES (`:userName`, `:login`, `:email`, `:password`)');
            $connector->dbSocket->execute(['userName' => $this->name,
                'login' => $this->login,
                'email' => $this->email,
                'password' => $this->password
            ]);
            return $connector->dbSocket->lastInsertId();
        }
        else{
            return  false;
        }
    }

    public function logIn(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('SELECT * FROM `users` WHERE `login` = :login AND `password` = :password');
        $stmt->execute(['login' => $this->login, 'password' => $this->password]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $this->id = $row['id'];
            $this->login = $row['login'];
            $this->email = $row['email'];
            $this->name = $row['user_name'];
            $this->password = $row['password'];
            $this->sessionKey = md5($this->login.$this->password.date('Y-m-d H:i'));
            $this->updateUser();
            return $this->sessionKey;
        }
        else{
            return  false;
        }

    }

    public function logOut(): bool{
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('SELECT * FROM `users` WHERE `login` = :login && sessin_key = :sessionKey');
        $stmt->execute(['login' => $this->login, 'sessionKey' => $this->sessionKey]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $this->id = $row['id'];
            $this->login = $row['login'];
            $this->email = $row['email'];
            $this->name = $row['user_name'];
            $this->password = $row['password'];
            $this->sessionKey = null;
            $this->updateUser();
            return true;
        }
        else{
            return false;
        }
    }

    public function updateUser(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('UPDATE `users` SET 
                                            `user_name` = :userName, 
                                            `login` = :login, 
                                            `email` = :email, 
                                            `password` = :password,
                                            `session_key` = :sessionKey WHERE `id` = :id');
        $stmt->execute(['userName' => $this->name,
                        'login' => $this->login,
                        'email' => $this->email,
                        'password' => $this->password,
                        'sessionKey' => $this->sessionKey,
                        'id' => $this->id]);
    }

    public function selectUserByLogin(){
        $connector = new dbSocket();
        $connector->dbSocket->prepare('SELECT * FROM `users` WHERE `login` = ?');
        $connector->dbSocket->execute($this->login);
        $row = $connector->dbSocket->fetch(PDO::FETCH_ASSOC);
        if($row){
            $this->id = $row['id'];
            $this->login = $row['login'];
            $this->email = $row['email'];
            $this->name = $row['user_name'];
            $this->password = $row['password'];
            $this->sessionKey = $row['sessionKey'];
        }
        else{
            $this->id = null;
        }
    }

    public function checkSession(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('SELECT COUNT(`id`) as `count` FROM `users` WHERE `id` = :id AND `session_key` = :sessionKey');
        $stmt->execute(['id' => $this->id, 'sessionKey' => $this->sessionKey]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['count'];
    }
}