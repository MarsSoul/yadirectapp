<?php

namespace App\Traits;

use App\Controllers\Error404Controller;

trait CollectAdGroupsTrait
{
    protected function collectAdGroups($report_data)
    {
        $adGroups = [];
//        $skip_fields = ['n_Группы',];
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
            $groupId = $row['n_Группы'];

            if (!isset($adGroups[$groupId])) {
                $adGroups[$groupId] = [
                    'group' => $row,
                    'totals' => [],
                ];
            }

            foreach ($row as $field => $value) {
                if (!in_array($field, $skip_fields)) {

                    if (!isset($adGroups[$groupId]['totals'][$field])) {
                        $adGroups[$groupId]['totals'][$field] = 0;
                    }

                    if (is_numeric($value)) {
                        $adGroups[$groupId]['totals'][$field] += $value;
                    } else {
                        $adGroups[$groupId]['totals'][$field] += intval($value);
                    }
                }
            }
        }

        return array_values($adGroups);
    }
}
