<?php

namespace App\Models;

use App\Core\Database;

class BaseModel 
{
    protected $db;

    public function __construct()
    {
//        $this->db = new Database();
        try {
            $this->db = new Database();
        } catch (\Exception $e) {
            die("Ошибка подключения к базе" . $e->getMessage());
        }
    }
}