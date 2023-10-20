<?php

namespace App\Interfaces\Models;

interface UploadReportModelInterface
{
    public function createTable($tableName, $columns);
    public function insertReportData($tableName, $rowData, $columns);
    public function getRowCount($tableName);
    public function addReportInfo($tableName, $dates);
    public function cleanReportTables();
}