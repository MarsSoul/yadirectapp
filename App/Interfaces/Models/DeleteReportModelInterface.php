<?php

namespace App\Interfaces\Models;

interface DeleteReportModelInterface
{
    public function deleteReport($reportId, $tableName);
}