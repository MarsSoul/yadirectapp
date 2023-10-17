<?php

namespace App\Traits;

trait CollectAdTrait
{
    protected function collectAd($ad, $average_fields)
    {
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

        $totalAd = [
            'totals' => [],
            'groupeRows' => 0,
        ];

        foreach ($ad as $row) {
            foreach ($row as $field => $value) {
                if (!in_array($field, $skip_fields)) {

                    if (!isset($totalAd['totals'][$field])) {
                        $totalAd['totals'][$field] = 0;
                    }

                    if (in_array($field, $average_fields)) {
                        $totalAd['totals'][$field] += is_numeric($value) ? $value : 0;

                    } else {
                        if (is_numeric($value)) {
                            $totalAd['totals'][$field] += $value;
                        } else {
                            $totalAd['totals'][$field] += intval($value);
                        }
                    }
                }
            }
            $totalAd['groupeRows']++;
        }

        foreach ($average_fields as $field) {
            if (isset($totalAd['totals'][$field])) {
                $totalAd['totals'][$field] = round($totalAd['totals'][$field] / $totalAd['groupeRows'], 3);
            }
        }

        return $totalAd;
    }
}
