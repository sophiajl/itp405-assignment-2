<?php

class Database {
    private $host = 'itp460.usc.edu';
    private $database_name = 'dvd';
    private $username = 'student';
    private $password = 'ttrojan';
    protected static $pdo;

    public function __construct()
    {
        // use static property to prevent multiple db connections from being made
        if (!self::$pdo) {
            $connection_string = "mysql:host=$this->host;dbname=$this->database_name";
            self::$pdo = new PDO($connection_string, $this->username, $this->password);
        }
    }
}

