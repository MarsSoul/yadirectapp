<?php

namespace App\Models;

class DeleteReportModel extends BaseModel
{
    public function deleteReport($reportId, $tableName)
    {
        try {
            if ($this->tableExists($tableName)) {

                $sql = "DELETE FROM dates WHERE id = ? AND name_table_report = ?";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bind_param('is', $reportId, $tableName);
                $stmt->execute();

                $sql = "DROP TABLE IF EXISTS $tableName";
                $this->db->getConnection()->query($sql);

                return true;
            }
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }
}