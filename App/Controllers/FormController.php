<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DateTime;
use App\Models\ReportModel;

// TODO DRY , clean , naming
// TODO interfe
// TODO trait
// TODO err
// TODO comm

class FormController extends BaseController
{
    public function uploadReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['xlsx_file']) && $_FILES['xlsx_file']['error'] === UPLOAD_ERR_OK) {

                $fileInfo = pathinfo($_FILES['xlsx_file']['name']);
                $fileExtension = strtolower($fileInfo['extension']);

                if ($fileExtension === 'xlsx') {
                    $uploadedFilePath = $_FILES['xlsx_file']['tmp_name'];

                    $spreadsheet = IOFactory::load($uploadedFilePath);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $firstCellValue = $worksheet->getCellByColumnAndRow(1, 1)->getValue();

                    $reportName = "";
                    $hash = substr(hash('sha256', bin2hex(random_bytes(16))), 0, 6);

                    preg_match('/(\d{2}\.\d{2}\.\d{4} - \d{2}\.\d{2}\.\d{4})/', $firstCellValue, $matches);

                    if (isset($matches[0])) {

                        $dates = explode(" - ", $matches[0]);
                        $startDate = DateTime::createFromFormat('d.m.Y', $dates[0])->format('Y_m_d');
                        $endDate = DateTime::createFromFormat('d.m.Y', $dates[1])->format('Y_m_d');

                        if ($startDate !== false && $endDate !== false) {
//                            $reportName = "($hash) Report-" . $startDate ."-". $endDate;
                            $reportName = "MS" . $hash. "_Report_" . $startDate . "___" . $endDate;
                        } else {
                            $reportName = "MS" . $hash. "_Not_date_report" . date('Ymd') . time();
                        }

                    } else {
                        $reportName = "MS" . $hash. "_Not_date_report" . date('Ymd') . time();
                    }

//                    $targetFilePath = __DIR__ . "/../../Reports/$reportName.xlsx";

                    $reportModel = new ReportModel();
                    $reportModel->createTable($reportName);

                    $worksheet = $spreadsheet->getActiveSheet();
                    $startRow = 6;
                    $endRow = $worksheet->getHighestRow();


                    for ($rowIndex = $startRow; $rowIndex <= $endRow; $rowIndex++) {
                        $rowData = [];

                        for ($colIndex = 1; $colIndex <= 28; $colIndex++) {  // 28 = AB
                            $colLetter = Coordinate::stringFromColumnIndex($colIndex);
                            $cellValue = $worksheet->getCell($colLetter . $rowIndex)->getValue();
                            $rowData[] = $cellValue;
                        }
//                            var_dump($rowData);
                        $reportModel->insertReportData($reportName, $rowData);
                    }

                    if ($reportModel->getRowCount($reportName) == $endRow - 5) {
                        $dates = [$startDate, $endDate];
                        $reportModel->addReportInfo($reportName, $dates);
                        // clear db table dates
                        $reportModel->cleanReportTables();
                        echo 'OK'; // locaton home

                    } else {
                        echo 'количество строк в файле и в базе данных не совпадает, что то пошло не так';
                    }
                } else {
                    echo "расширение файла не xlsx";
                }
            } else {
                echo "загрузка файла не ок";
            }
        } else {
            echo "метод не пост";
        }
    }
}