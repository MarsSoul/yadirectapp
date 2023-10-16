<?php

namespace App\Core;

class Database {
    private $connection;

    public function __construct() {

        $dbHost = $_ENV['DB_HOST'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        $this->connection = new \mysqli($dbHost, $dbUser, $dbPassword, $dbName);
        if ($this->connection->connect_error) {
            die('Ошибка подключения к базе данных: ' . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}