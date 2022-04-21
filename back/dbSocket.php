<?php

class dbSocket
{
    public $dbSocket;
    public $dsn = 'mysql:dbname=db_name;host=localhost';
    public $dbUser = 'user';
    public $dbPassword = 'password';


    public function __construct(){
        $this->dbSocket = new PDO($this->dsn, $this->dbUser, $this->dbPassword);
    }
}