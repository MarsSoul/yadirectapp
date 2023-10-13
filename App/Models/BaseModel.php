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

    public function tableExists($tableName)
    {
        $tableName = $this->db->getConnection()->real_escape_string($tableName);
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = $this->db->getConnection()->query($sql);

        return $result->num_rows > 0;
    }
}