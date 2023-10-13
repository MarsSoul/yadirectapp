<?php

namespace App\Controllers;

use App\Models\DeleteReportModel;

class DeleteReportController extends BaseController
{
    public function deleteReport($reportId, $tableName)
    {

        $deleteReportModel = new DeleteReportModel();

        $result = $deleteReportModel->deleteReport($reportId, $tableName);
        if ($result) {
            header('Location: /');
        } else {
            $error404 = new Error404Controller();
            $error404->index("Нне удалось удалить, проверить номер отчета и название отчета");
            die();
//            var_dump("не удалось удалить");
        }
    }
}