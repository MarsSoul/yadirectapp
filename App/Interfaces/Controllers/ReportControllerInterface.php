<?php

namespace App\Interfaces\Controllers;

interface ReportControllerInterface {

    public function showReport($id);
    public function showCampaigns($id);
    public function showAdGroups($campaign_id, $table_name);
    public function showAds($campaign_id, $group_id, $table_name);

}