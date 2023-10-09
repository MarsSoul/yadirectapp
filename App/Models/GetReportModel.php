<?php

namespace App\Models;


class GetReportModel extends BaseModel
{
    public function getAllReports()
    {
        try {
            $sql = "SELECT * FROM dates ORDER BY id DESC";
            $result = $this->db->getConnection()->query($sql);

            $reports = [];
            while ($row = $result->fetch_assoc()) {
                $reports[] = $row;
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
            $result = $this->db->getConnection()->query($sql);

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
            $id = $this->db->getConnection()->real_escape_string($id);
            $sql = "SELECT * FROM dates WHERE id = " . $id;
            $result = $this->db->getConnection()->query($sql);

            if($result){
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return 'ошибка в базе: ' . $e->getMessage();
        }
    }

    public function getGroupsByCampaignId($tableName, $campaignId)
    {

        try {
            $campaignId = $this->db->getConnection()->real_escape_string($campaignId);
            $sql = "SELECT * FROM $tableName WHERE n_Кампании = " . $campaignId;
            $result = $this->db->getConnection()->query($sql);
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
            $campaignId = $this->db->getConnection()->real_escape_string($campaignId);
            $groupId = $this->db->getConnection()->real_escape_string($groupId);
            $sql = "SELECT * FROM $tableName WHERE n_Кампании = $campaignId AND n_Группы = $groupId";
            $result = $this->db->getConnection()->query($sql);
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