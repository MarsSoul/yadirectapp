<?php

namespace App\Models;

// TODO report not found

class GetReportModel extends BaseModel
{
    public function getAllReports()
    {
        $sql = "SELECT * FROM dates ORDER BY id DESC";
        $result = $this->db->getConnection()->query($sql);

        $reports = [];
        while ($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }

        return $reports;
    }

    public function getReportData($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $result = $this->db->getConnection()->query($sql);

        $report_data = [];
        while ($row = $result->fetch_assoc()) {
            $report_data[] = $row;
        }

        return $report_data;
    }

    public function getReportById($id)
    {
        $id = $this->db->getConnection()->real_escape_string($id);
        $sql = "SELECT * FROM dates WHERE id = " . $id;
        $result = $this->db->getConnection()->query($sql);

        if($result){
            return $result->fetch_assoc();
        } else {
            // если отчет не найден report controller
            return null;
        }
    }
}