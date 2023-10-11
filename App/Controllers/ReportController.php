<?php

namespace App\Controllers;

use App\Traits\ReportDataTrait;
use App\Traits\CollectCampaignsTrait;
use App\Traits\CollectAdGroupsTrait;
use App\Models\GetReportModel;

// TODO DRY , clean , naming
// TODO interfe
// TODO err
// TODO comm
// TODO if ($field !== 'n_Кампании') {  --- среддняя должна счиаться \\ Взвешенные_показы CTR wCTR Отказы_percent Глубина_стр Конверсия_percent Цена_цели_руб узнать что это

class ReportController extends BaseController
{
    use ReportDataTrait, CollectCampaignsTrait, CollectAdGroupsTrait;

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