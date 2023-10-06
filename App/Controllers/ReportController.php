<?php

namespace App\Controllers;

use App\Models\GetReportModel;

// TODO DRY , clean , naming
// TODO interfe
// TODO trait
// TODO err
// TODO comm

// TODO report not found
// TODO if not campa
// TODO больше исключений if ($field !== 'n_Кампании') {
// TODO if ($field !== 'n_Кампании') {  --- среддняя должна счиаться \\ Взвешенные_показы CTR wCTR Отказы_percent Глубина_стр Конверсия_percent Цена_цели_руб узнать что это

class ReportController extends BaseController
{
    public function showReport($id)
    {
        list($report, $report_data) = $this->getReportAndData($id);

//        if (!$report) { return; }

        $data = ['report_data' => $report_data,];

        $this->renderView('report_view', $data);
    }

    public function showCampaigns($id)
    {
        list($report, $report_data) = $this->getReportAndData($id);

//        if (!$report) { return; }

        $campaigns = $this->collectCampaigns($report_data);

        $data = [
            'report' => $report,
            'campaigns' => $campaigns,
        ];

        $this->renderView('campaigns_view', $data);
    }

    protected function collectCampaigns($report_data)
    {

        $campaigns = [];
        $field_totals = [];

        foreach ($report_data as $row) {
            $campaign_id = $row['n_Кампании'];

            if (!isset($campaigns[$campaign_id])) {
                $campaigns[$campaign_id] = [
                    'campaign' => $row,
                    'totals' => [],
                ];
            }

            foreach ($row as $field => $value) {
                if ($field !== 'n_Кампании') {
                    if (!isset($campaigns[$campaign_id]['totals'][$field])) {
                        $campaigns[$campaign_id]['totals'][$field] = 0;
                    }
//                    $campaigns[$campaign_id]['totals'][$field] += intval($value);
                    if (is_numeric($value)) {
                        $campaigns[$campaign_id]['totals'][$field] = bcadd($campaigns[$campaign_id]['totals'][$field], $value, 2);
                    } else {
                        $campaigns[$campaign_id]['totals'][$field] += intval($value);
                    }
                }
            }
        }

        $keys = array_keys($campaigns);

        if ($keys[0] === '' || count($keys) === 0) {
            $error404 = new Error404Controller();
            $error404->index("Нет кампаний в отчете");
            print_r($campaigns[0]);
            die();
        }
        return array_values($campaigns);
    }

    protected function getReportAndData($id)
    {
        $reportsModel = new GetReportModel();
        $report = $reportsModel->getReportById($id);

        if (!$report) {
            $error404 = new Error404Controller();
            $error404->index("Несуществующий отчет");
            die();
        }

        $report_data = $reportsModel->getReportData($report["name_table_report"]);

        return [$report, $report_data];
    }
}