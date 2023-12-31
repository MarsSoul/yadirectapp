<?php

namespace App\Models;

use App\Interfaces\Models\GetReportModelInterface;

class GetReportModel extends BaseModel implements GetReportModelInterface
{
    public function getAllReports()
    {
        try {
            $sql = "SELECT * FROM dates ORDER BY id DESC";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $reports = [];

            while ($row = $result->fetch_assoc()) {
                $tableName = $row['name_table_report'];

                if ($this->tableExists($tableName)) {
                    $reports[] = $row;
                } else {
                    return 'Not found reports';
                }
            }

            return $reports;
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }

    public function getReportData($tableName)
    {
        try {
            $sql = "SELECT * FROM $tableName";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $report_data = [];
            while ($row = $result->fetch_assoc()) {
                $report_data[] = $row;
            }

            return $report_data;
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }

    public function getReportById($id)
    {
        try {
            $sql = "SELECT * FROM dates WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc() ?? null;
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }

    public function getGroupsByCampaignId($tableName, $campaignId)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE n_Кампании = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bind_param('s', $campaignId);
            $stmt->execute();
            $result = $stmt->get_result();

            $groups = [];

            while ($row = $result->fetch_assoc()) {
                $groups[] = $row;
            }

            if($groups){
                return $groups;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }

    public function getAdsByGroupAndCampaignId($tableName, $campaignId, $groupId)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE n_Кампании = ? AND n_Группы = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bind_param('ss', $campaignId, $groupId);
            $stmt->execute();
            $result = $stmt->get_result();

            $ads = [];

            while ($row = $result->fetch_assoc()) {
                $ads[] = $row;
            }

            if ($ads) {
                return $ads;
            } else {
                return null;
            }

        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }
}