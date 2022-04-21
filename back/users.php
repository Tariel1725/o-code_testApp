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
        $connector->dbSocket->prepare('SELECT * FROM `users` WHERE `login` = :login AND `password` = :password');
        $connector->dbSocket->execute(['login' => $this->login, 'password' => $this->password]);
        $row = $connector->dbSocket->fetch(PDO::FETCH_ASSOC);
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
        $connector->dbSocket->prepare('SELECT * FROM `users` WHERE `login` = :login && sessin_key = :sessionKey');
        $connector->dbSocket->execute(['login' => $this->login, 'sessionKey' => $this->sessionKey]);
        $row = $connector->dbSocket->fetch(PDO::FETCH_ASSOC);
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
        $this->password = md5($this->password);
        $connector = new dbSocket();
        $connector->dbSocket->prepare('UPDATE `users` SET 
                                            `user_name` = :userName, 
                                            `login` = :login, 
                                            `email` = :email, 
                                            `password` = :password,
                                            `session_key` = :sessionKey WHERE `id` = :id');
        $connector->dbSocket->execute(['userName' => $this->name,
                                        'login' => $this->login,
                                        'email' => $this->email,
                                        'password' => $this->password,
                                        'session_key' => $this->sessionKey,
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
}