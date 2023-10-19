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
            'PPAAd' => 0,
            'PPCAd' => 0,
            'CTRAd' => 0,
            'wCTRAd' => 0,

            'listSearchQueriesAd' => [],
            'listNigativeSearchQueriesAd' => [],
            'listNormalSearchQueriesAd' => [],
            'listExclusivelyNigativWordsAd' => [],
        ];

        foreach ($ad as $row) {
            foreach ($row as $field => $value) {

                // all/nigativ/normal search queries in group
                if ($field == 'Поисковый_запрос') {
                    // all
                    if (!in_array($value, $totalAd['listSearchQueriesAd'])) {
                        $totalAd['listSearchQueriesAd'][] = $value;
                    }
                    // normal
                    if ($row['Конверсии'] != "0" && $row['Конверсии'] != "-") {
                        if (!in_array($row['Поисковый_запрос'], $totalAd['listNormalSearchQueriesAd'])){
                            $totalAd['listNormalSearchQueriesAd'][] = $value;
                        }
                    }
                    // nigative
                    else {
                        if (!in_array($row['Поисковый_запрос'], $totalAd['listNigativeSearchQueriesAd'])){
                            $totalAd['listNigativeSearchQueriesAd'][] = $row['Поисковый_запрос'];
                        }
                    }
                }

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

//        ======
        // PPA PPC
        if (isset($totalAd['totals']["Клики"]) && isset($totalAd['totals']["Конверсии"])) {
            if ($totalAd['totals']["Клики"] != 0 && $totalAd['totals']["Конверсии"] != 0) {
                // PPA
                if (isset($totalAd['totals']["Расход_руб"])) {
                    $totalAd['PPAAd'] = $totalAd['totals']["Расход_руб"] / $totalAd['totals']["Конверсии"];
                    $totalAd['PPAAd'] = round($totalAd['PPAAd'], 2);
                }
                // PPC
                $totalAd['PPCAd'] = $totalAd['totals']["Конверсии"] / $totalAd['totals']["Клики"] * 100;
                $totalAd['PPCAd'] = round($totalAd['PPCAd'], 2);
            }
        }
        // CTR, wCTR
        if (isset($totalAd['totals']["Клики"])) {
            if ($totalAd['totals']["Клики"] != 0) {
                // CTR
                if (isset($totalAd['totals']["Показы"])) {
                    if ($totalAd['totals']["Показы"] != 0) {
                        $totalAd['CTRAd'] = $totalAd['totals']["Клики"] / $totalAd['totals']["Показы"];
                        $totalAd['CTRAd'] = round($totalAd['CTRAd'], 2);
                    }
                }
                // wCTR
                if (isset($totalAd['totals']["Взвешенные_показы"])) {
                    if ($totalAd['totals']["Взвешенные_показы"] != 0) {
                        $totalAd['wCTRAd'] = $totalAd['totals']["Клики"] / $totalAd['totals']["Взвешенные_показы"];
                        $totalAd['wCTRAd'] = round($totalAd['wCTRAd'], 2);
                    }
                }
            }
        }
//        ======

        $allCleanWords = $this->rebuildSearchQueries($totalAd['listSearchQueriesAd']);
        $nigativeCleanWords = $this->rebuildSearchQueries($totalAd['listNigativeSearchQueriesAd']);
        $normalCleanWords = $this->rebuildSearchQueries($totalAd['listNormalSearchQueriesAd']);
        $exclusivelyNigativWordsAd = $this->comparisonNigativeNormalWords($nigativeCleanWords, $normalCleanWords);

        $totalAd['listSearchQueriesAd'] = $allCleanWords;
        $totalAd['listNigativeSearchQueriesAd'] = $nigativeCleanWords;
        $totalAd['listNormalSearchQueriesAd'] = $normalCleanWords;
        $totalAd['listExclusivelyNigativWordsAd'] = $exclusivelyNigativWordsAd;

        return $totalAd;
    }
}
