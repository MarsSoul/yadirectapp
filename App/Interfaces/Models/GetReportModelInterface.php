<?php

namespace App\Interfaces\Models;

interface GetReportModelInterface
{
    public function getAllReports();
    public function getReportData($tableName);
    public function getReportById($id);
    public function getGroupsByCampaignId($tableName, $campaignId);
    public function getAdsByGroupAndCampaignId($tableName, $campaignId, $groupId);
}