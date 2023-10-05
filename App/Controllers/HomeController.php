<?php

namespace App\Controllers;

use App\Models\GetReportModel;

class HomeController extends BaseController
{
    public function index()
    {
        $reportsModel = new GetReportModel();
        $reports = $reportsModel->getAllReports();

        $data = [
            'reports' => $reports,
        ];

        $this->renderView('home', $data);
    }

}