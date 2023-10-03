<?php

namespace App\Core;

class Database {
    private $connection;

    public function __construct() {
        $this->connection = new \mysqli('localhost', 'root', '', 'yadirect_db');
        if ($this->connection->connect_error) {
            die('Ошибка подключения к базе данных: ' . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}