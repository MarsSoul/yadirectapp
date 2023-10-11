<?php

namespace App\Models;

use DateTime;

// TODO DRY , clean , naming
// TODO interfe
// TODO trait
// TODO err
// TODO comm

class UploadReportModel extends BaseModel
{
    // create table report
    public function createTable($tableName, $columns)
    {
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ";

        foreach ($columns as $column) {
            if ($column != '') {
                $sql .= "`" . $column . "` TEXT, ";
            } else {
                echo 'проверить столбцы в 5 строке';
            }
        }

        $sql = rtrim($sql, ", ") . ")";

        $this->db->getConnection()->query($sql);
    }

    // insert table report
    public function insertReportData($tableName, $rowData, $columns)
    {
        $placeholders = implode(',', array_fill(0, count($rowData), '?'));
        $columnNames = implode(',', $columns);
        $sql = "INSERT INTO $tableName 
            ($columnNames)
            VALUES ($placeholders)";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute($rowData);
    }

    // for equal row in db and file
    public function getRowCount($tableName) {
        $query = "SELECT COUNT(*) AS count FROM " . $tableName;
        $result = $this->db->getConnection()->query($query);

        if ($result !== false && $result->num_rows > 0) {
            return $result->fetch_assoc()['count'];
        } else {
            throw new \Exception("db NO ok");
        }
    }

    // for dates report in db
    public function addReportInfo($tableName, $dates)
    {
        $date_create = date("Y-m-d"); // current date
        $date_start_obj = DateTime::createFromFormat('Y_m_d', $dates[0]);
        if ($date_start_obj === false) { $date_start = '0000-00-00';}
        else { $date_start = $date_start_obj->format('Y-m-d'); }

        $date_end_obj = DateTime::createFromFormat('Y_m_d', $dates[1]);
        if ($date_end_obj === false) { $date_end = '0000-00-00'; }
        else { $date_end = $date_end_obj->format('Y-m-d'); }

        $sql = "INSERT INTO dates (name_table_report, date_start_report, date_end_report, date_create_report) 
    VALUES (?, ?, ?, ?)";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param('ssss', $tableName, $date_start, $date_end, $date_create);
        $stmt->execute();
    }

    // for clear db (каждый раз когда добавляется новый отчет в Controllers/FormController.php вызывается чистильщик)
    // если таблицы с отчетом нет, то удаляется запись из dates
    public function cleanReportTables() {
        $result = $this->db->getConnection()->query('SHOW TABLES');
        $tables = [];
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }

        $result = $this->db->getConnection()->query("SELECT `name_table_report` FROM `dates`");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        foreach ($rows as $row) {
            $table_name = $row['name_table_report'];
            if (!in_array($table_name, $tables)) {
                $this->db->getConnection()->query("DELETE FROM `dates` WHERE `name_table_report`='" . $table_name . "'");
            }
        }
    }
}
