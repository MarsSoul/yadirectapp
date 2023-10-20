<?php

namespace App\Controllers;

use App\Interfaces\Controllers\ReportControllerInterface;
use App\Traits\ReportDataTrait;
use App\Traits\CollectCampaignsTrait;
use App\Traits\CollectAdGroupsTrait;
use App\Traits\CollectAdGroupTrait;
use App\Models\GetReportModel;


class ReportController extends BaseController implements ReportControllerInterface
{
    use ReportDataTrait, CollectCampaignsTrait, CollectAdGroupsTrait, CollectAdGroupTrait;

    public function showReport($id)
    {
        list($report, $report_data) = $this->getReportAndData($id);
        $data = [
            'report_data' => $report_data,
            'report' => $report,
        ];
        $this->renderView('report_view', $data);
    }

    public function showCampaigns($id)
    {
        list($report, $report_data) = $this->getReportAndData($id);
        $campaigns = $this->collectCampaigns($report_data);
        $data = [
            'report' => $report,
            'campaigns' => $campaigns,
        ];
        $this->renderView('campaigns_view', $data);
    }

    public function showAdGroups($campaign_id, $table_name)
    {
        $reportsModel = new GetReportModel();
        $adGroups = $this->collectAdGroups($reportsModel->getGroupsByCampaignId($table_name, $campaign_id));
        // 500 erroe
        if (is_string($adGroups)) {
            echo $adGroups;
            die();
        }

        if (!$adGroups) {
            $error404 = new Error404Controller();
            $error404->index("Неправильные данные для получения групп, проверить номер кампании и название отчета");
            die();
        }

        $data = [
            'adGroups' => $adGroups,
            'table_name' => $table_name
        ];
        $this->renderView('groups_view', $data);
    }

    public function showAdGroup($campaign_id, $group_id, $table_name)
    {
        $reportsModel = new GetReportModel();
        $adGroup = $this->collectAdGroup($reportsModel->getGroupsByCampaignId($table_name, $campaign_id), $group_id);

        if (!$adGroup) {
            $error404 = new Error404Controller();
            $error404->index("Группа не найдена");
            die();
        }

        $data = [
            'adGroup' => $adGroup,
            'table_name' => $table_name,
        ];

        $this->renderView('group_view', $data);
    }

    public function showAds($campaign_id, $group_id, $table_name)
    {
        $reportsModel = new GetReportModel();
        $ads = $reportsModel->getAdsByGroupAndCampaignId($table_name, $campaign_id, $group_id);

        // 500 erroe
        if (is_string($ads)) {
            echo $ads;
            die();
        }

        if (!$ads) {
            $error404 = new Error404Controller();
            $error404->index("Неправильные данные для получения объявлений, проверьте номер кампании и группы");
            die();
        }

        $data = [
            'ads' => $ads
        ];
        $this->renderView('search_queries_view', $data);
    }

}