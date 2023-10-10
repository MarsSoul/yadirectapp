<?php

namespace App\Traits;


trait CollectAdGroupsTrait
{
    protected function collectAdGroups($report_data)
    {
        $adGroups = [];
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

        $average_fields = [
            'Ср_цена_клика_руб',
            'Ср_позиция_показов',
            'Ср_объём_трафика',
            'Ср_позиция_кликов',
            'Глубина_стр',
        ];

        foreach ($report_data as $row) {
            $groupId = $row['n_Группы'];

            if (!isset($adGroups[$groupId])) {
                $adGroups[$groupId] = [
                    'group' => $row,
                    'totals' => [],
                    'haveNigativeAd' => false,
                    'groupeRows' => 0,
                    'listNigativeAd' => [],
                ];
            }

            foreach ($row as $field => $value) {
                if (!in_array($field, $skip_fields)) {

                    if (!isset($adGroups[$groupId]['totals'][$field])) {
                        $adGroups[$groupId]['totals'][$field] = 0;
                    }

                    if (in_array($field, $average_fields)) {
                        $adGroups[$groupId]['totals'][$field] += is_numeric($value) ? $value : 0;

                    } else {
                        if (is_numeric($value)) {
                            $adGroups[$groupId]['totals'][$field] += $value;
                        } else {
                            $adGroups[$groupId]['totals'][$field] += intval($value);
                        }
                    }
                }

                if ($field === "Конверсии") {
                    if ($value == "0" || $value == "-") {
                        $adGroups[$groupId]['haveNigativeAd'] = true;
                        $adGroups[$groupId]['listNigativeAd'][] = $row;
                    }
                }
            }
            $adGroups[$groupId]['groupeRows']++;
        }

        foreach ($adGroups as &$adGroup) {
            foreach ($average_fields as $field) {
                if (isset($adGroup['totals'][$field])) {
                    $adGroup['totals'][$field] = round($adGroup['totals'][$field] / $adGroup['groupeRows'], 3);
                }
            }
        }

        return array_values($adGroups);
    }
}
