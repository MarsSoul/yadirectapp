<?php

namespace App\Traits;

use App\Models\GetReportModel;
use App\Controllers\Error404Controller;


trait ReportDataTrait
{
    protected function getReportAndData($id)
//    protected function getReportAndData($id, $pageNumber = null, $pageSize = 10) // pagg
    {
        $reportsModel = new GetReportModel();
        $report = $reportsModel->getReportById($id);

        if (is_string($report)) {
            echo $report;
            die();
        }

        if (!$report) {
            $error404 = new Error404Controller();
            $error404->index("Несуществующий отчет");
            die();
        }

        $report_data = $reportsModel->getReportData($report["name_table_report"]);
//        $totalRows = $reportsModel->totalRowsInTable($report["name_table_report"]); // pagg
//        $totalPages = ceil($totalRows / $pageSize); // pagg
//        $report_data = $reportsModel->getReportData($report["name_table_report"], $pageNumber, $pageSize); // pagg
//        var_dump($report_data);


        // 500 erroe
        if (is_string($report_data)) {
            echo $report_data;
            die();
        }

        return [$report, $report_data];
//        return [$report, $report_data, $totalPages]; // pagg
    }
}