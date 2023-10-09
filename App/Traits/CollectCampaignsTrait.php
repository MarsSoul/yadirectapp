<?php

namespace App\Traits;

use App\Controllers\Error404Controller;


trait CollectCampaignsTrait
{
    protected function collectCampaigns($report_data)
    {
        $campaigns = [];
        $field_totals = [];
        $skip_fields = [
            'id',
            'Логин_клиента',
            'Поисковый_запрос',
            'Кампания',
            'n_Кампании',
            'Группа',
            'n_Группы',
            'n_Объявления',
            'Условие_показа',
            'Тип_условия_показа',
            'Тип_соответствия',
            'Подобранная_фраза',
            'Категория_таргетинга',
            'Уровень_платежеспособности'
        ];

        foreach ($report_data as $row) {
            $campaign_id = $row['n_Кампании'];

            if (!isset($campaigns[$campaign_id])) {
                $campaigns[$campaign_id] = [
                    'campaign' => $row,
                    'totals' => [],
                    'haveNigativeGroup' => false,
                ];
            }

            foreach ($row as $field => $value) {

                if (!in_array($field, $skip_fields)) {

                    if (!isset($campaigns[$campaign_id]['totals'][$field])) {
                        $campaigns[$campaign_id]['totals'][$field] = 0;
                    }

                    if (is_numeric($value)) {
                        $campaigns[$campaign_id]['totals'][$field] = bcadd($campaigns[$campaign_id]['totals'][$field], $value, 2);
                    } else {
                        $campaigns[$campaign_id]['totals'][$field] += intval($value);
                    }
                }
                if ($field === "Конверсии") {
                    if ($value == 0 || $value == "-") {
                        $campaigns[$campaign_id]['haveNigativeGroup'] = true;
                    }
                }
            }
        }

        $keys = array_keys($campaigns);

        if ($keys[0] === '' || count($keys) === 0) {
            $error404 = new Error404Controller();
            $error404->index("Нет кампаний в отчете");
            die();
        }
        return array_values($campaigns);
    }

}