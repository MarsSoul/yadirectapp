<?php

namespace App\Controllers;

use App\Models\GetReportModel;

// TODO report not found
class ReportController extends BaseController
{
    public function view($id)
    {
        $reportsModel = new GetReportModel();
        $report = $reportsModel->getReportById($id);

        if (!$report) { echo "report not found"; }

        $report_data = $reportsModel->getReportData($report['name_table_report']);

        $data = [
            'report_data' => $report_data,
        ];

        $this->renderView('report_view', $data);
    }
}