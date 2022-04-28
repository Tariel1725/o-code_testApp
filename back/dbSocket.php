<?php

class dbSocket
{
    public $dbSocket;
    public $dsn = 'mysql:dbname=test_application;host=localhost';
    public $dbUser = 'test';
    public $dbPassword = 'test';


    public function __construct(){
        $this->dbSocket = new PDO($this->dsn, $this->dbUser, $this->dbPassword);
    }
}