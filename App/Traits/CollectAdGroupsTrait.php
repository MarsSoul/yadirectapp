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
                    'PPAGroupe' => 0,
                    'PPCGroupe' => 0,
                    'CTRGroupe' => 0,
                    'wCTRGroupe' => 0,
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

            // ==========
            if ($field === "Конверсии") {
                $adId = $row['n_Объявления'];

                if (!isset($adGroups[$groupId]['listNigativeAd'][$adId])) {
                    $adGroups[$groupId]['listNigativeAd'][$adId] = [
                        'rows' => [],
                        'isAdNigative' => true // изначально нигативное
                    ];
                }

                if ($value != "0" && $value != "-") {
                    $adGroups[$groupId]['listNigativeAd'][$adId]['isAdNigative'] = false;
                }
                else {
                    $adGroups[$groupId]['listNigativeAd'][$adId]['rows'][] = $row;
                    $adGroups[$groupId]['haveNigativeAd'] = true;
                }

            }

                // ==========
            }
            $adGroups[$groupId]['groupeRows']++;
        }

        foreach ($adGroups as &$adGroup) {
            foreach ($average_fields as $field) {
                if (isset($adGroup['totals'][$field])) {
                    $adGroup['totals'][$field] = round($adGroup['totals'][$field] / $adGroup['groupeRows'], 3);
                }
            }

            // PPAGroupe, PPCGroupe
            if (isset($adGroup['totals']["Клики"]) && isset($adGroup['totals']["Конверсии"])) {
                if ($adGroup['totals']["Клики"] != "0" && $adGroup['totals']["Клики"] != 0 && $adGroup['totals']["Клики"] != "-") {
                    if ($adGroup['totals']["Конверсии"] != "0.00" && $adGroup['totals']["Конверсии"] != 0.00 && $adGroup['totals']["Конверсии"] != "-") {
                        // PPAGroupe
                        if (isset($adGroup['totals']["Расход_руб"])) {
                            $adGroup['PPAGroupe'] = $adGroup['totals']["Расход_руб"] / $adGroup['totals']["Конверсии"];
                            $adGroup['PPAGroupe'] = round($adGroup['PPAGroupe'], 2);
                        }
                        // PPCGroupe
                        $adGroup['PPCGroupe'] = $adGroup['totals']["Конверсии"] / $adGroup['totals']["Клики"] * 100;
                        $adGroup['PPCGroupe'] = round($adGroup['PPCGroupe'], 2);
                    }
                }
            }
            // CTR, wCTR
            if (isset($adGroup['totals']["Клики"])) {
                if ($adGroup['totals']["Клики"] != "0" && $adGroup['totals']["Клики"] != 0 && $adGroup['totals']["Клики"] != "-") {
                    // CTR
                    if (isset($adGroup['totals']["Показы"])) {
                        if ($adGroup['totals']["Показы"] != "0" && $adGroup['totals']["Показы"] != 0 && $adGroup['totals']["Показы"] != "-") {
                            $adGroup['CTRGroupe'] = $adGroup['totals']["Клики"] / $adGroup['totals']["Показы"];
                            $adGroup['CTRGroupe'] = round($adGroup['CTRGroupe'], 2);
                        }
                    }
                    // wCTR
                    if (isset($adGroup['totals']["Взвешенные_показы"])) {
                        if ($adGroup['totals']["Взвешенные_показы"] != "0" && $adGroup['totals']["Взвешенные_показы"] != 0 && $adGroup['totals']["Взвешенные_показы"] != "-") {
                            $adGroup['wCTRGroupe'] = $adGroup['totals']["Клики"] / $adGroup['totals']["Взвешенные_показы"];
                            $adGroup['wCTRGroupe'] = round($adGroup['wCTRGroupe'], 2);
                        }
                    }
                }
            }
        }

        return array_values($adGroups);
    }
}
