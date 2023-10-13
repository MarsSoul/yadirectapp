<?php

namespace App\Controllers;

use App\Interfaces\Controllers\HomeControllerInterface;
use App\Models\GetReportModel;
use DateTime;

class HomeController extends BaseController implements HomeControllerInterface
{
    public function index()
    {
        $reportsModel = new GetReportModel();
        $reports = $reportsModel->getAllReports();

        if ($reports === "Not found reports")
        {
            $reports = null;
            $lastReport = null;
        }
        else { $lastReport = $reports[0]; }

        if (!empty($lastReport))
        {
            $dateEndReport = new DateTime($lastReport["date_end_report"]);
            $twoWeeksAgo = new DateTime('-2 weeks');
            $today = new DateTime('now');
            if ($dateEndReport < $twoWeeksAgo)
            {
                $recommendedDate = [
                    'recommendStart' => $dateEndReport->format('Y-m-d'),
                    'recommendEnd' => $today->format('Y-m-d')
                ];
            }
            else { $recommendedDate = []; }
        }

        $data = [
            'reports' => $reports,
            'lastReport' => $lastReport,
            'recommendedDate' => $recommendedDate,
        ];

        $this->renderView('home', $data);
    }
}