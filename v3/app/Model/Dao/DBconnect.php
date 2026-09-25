<?php

namespace Model\Dao;

class DBconnect {

    private static $instance;
    private $pdo;

    const DB_IP = "db";
    const DB_PORT = "3306";
    const DB_NAME = "app";
    const DB_USER = "app";
    const DB_PASS = "app";

    private function __construct() {
        try {
            $this->pdo = new \PDO('mysql:host=' . self::DB_IP . ':' . self::DB_PORT . ';dbname='
                . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function dbConnect() {
        return $this->pdo;
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBconnect();
        }
        return self::$instance;
    }
}
