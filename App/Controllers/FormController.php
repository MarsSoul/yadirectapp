<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

class FormController extends BaseController
{
    public function uploadReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['xlsx_file']) && $_FILES['xlsx_file']['error'] === UPLOAD_ERR_OK) {
                
                
                $uploadedFilePath = $_FILES['xlsx_file']['tmp_name'];

                $spreadsheet = IOFactory::load($uploadedFilePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $firstCellValue = $worksheet->getCellByColumnAndRow(1, 1)->getValue();

                // echo  $firstCellValue;


                $reportName = "";

                $pattern = '/(\d{2}\.\d{2}\.\d{4} - \d{2}\.\d{2}\.\d{4})/';
                preg_match($pattern, $firstCellValue, $matches);
                // echo $matches[0];
                if (isset($matches[0])) {
                    $dateRange = $matches[0];
                    $dates = explode(" - ", $dateRange);

                    $startDate = DateTime::createFromFormat('d.m.Y', $dates[0]);
                    $endDate = DateTime::createFromFormat('d.m.Y', $dates[1]);
                    
                    if ($startDate !== false && $endDate !== false) {
                        $reportName = "Report-" . $startDate->format('Y-m-d') ."-". $endDate->format('Y-m-d');
                    } else {
                        $reportName = "Not_date_report" . date('Ymd') . time();
                    }

                } else {
                    $reportName = "Not_date_report" . date('Ymd') . time();
                }

                $targetFilePath = __DIR__ . "/../../Reports/$reportName.xlsx";


                if (move_uploaded_file($uploadedFilePath, $targetFilePath)) {
                    echo 'OK';
                    
                } else {
                    echo 'neOK';
                }

            } else {
                echo "загрузка файла не ок";
            }
        } else {
            echo "метод не пост";
        }
    }
}