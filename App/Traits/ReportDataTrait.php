<?php

namespace App\Traits;

use App\Models\GetReportModel;
use App\Controllers\Error404Controller;


trait ReportDataTrait
{
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