<h1>GROUPS IN CAMPANI: <?= $adGroups[0]["group"]["Кампания"]; ?>  № camp : <?= $adGroups[0]["group"]["n_Кампании"]; ?></h1>

СОРТИРОВКА ПО ОБЩИМ ЗНАЧЕНИЯМ <br>
<button data-sort="Показы" data-order="asc">Сортировать по <strong>показам</strong></button>
<button data-sort="Клики" data-order="asc">Сортировать по <strong>кликам</strong></button>
<button data-sort="Расход_руб" data-order="asc">Сортировать по <strong>расходу</strong></button>
<button data-sort="Конверсии" data-order="asc">Сортировать по <strong>конверсии</strong></button>
<button data-sort="Доход_руб" data-order="asc">Сортировать по <strong>доходу</strong></button>
<br>
СОРТИРОВКА ПО СРЕДНИМ ЗНАЧЕНИЯМ <br>
<button data-sort="Ср_позиция_кликов" data-order="asc">Сортировать по <strong>Ср. позиция кликов</strong></button>
<button data-sort="Глубина_стр" data-order="asc">Сортировать по <strong>Глубине стр.</strong></button>
<button data-sort="Ср_объём_трафика" data-order="asc">Сортировать по <strong>Ср. объёму трафика</strong></button>
<button data-sort="Ср_позиция_показов" data-order="asc">Сортировать по <strong>Ср. позиции показов</strong></button>
<button data-sort="Ср_цена_клика_руб" data-order="asc">Сортировать по <strong>Ср. цене клика руб.</strong></button>

<div  class="group-list">
<?php

foreach ($adGroups as $group_row):
    $group = $group_row["group"];
    $group_totals = $group_row["totals"];
    ?>
    <div class="group" data-показы="<?= $group_totals['Показы'] ?>">

        <h2 class="color_green">НОМЕР ГРУППЫ = <?php print_r($group["n_Группы"]); ?> ||| НАЗВАНИЕ ГРУППЫ = <?php print_r($group["Группа"]); ?></h2>


        <?php
            if($group_row["haveNigativeAd"] === true) : echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНЫЕ ЗАПРОСЫ</p>";

                echo "<div class='tabul'>";
                    ?>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header"><p class='color_yellow'>СПИСОК НИГАТИВНЫХ ОБЪЯВЛЕНИЙ: 🢃показать🢃</p></div>

                            <div class="accordion-content">
                            <?php
        //                    echo "<p class='color_yellow'>СПИСОК НИГАТИВНЫХ ОБЪЯВЛЕНИЙ:</p>";

                            foreach ($group_row["listNigativeAd"] as $adId => $negativeAds) {
                                if (count($negativeAds["rows"]) !== 0 ){
                                    echo "<strong class='color_green'>Номер объявления: " . $negativeAds["rows"][0]["n_Объявления"] . "</strong>";

                                    if($negativeAds["isAdNigative"] === true) :
                                        echo "<strong class='color_red'>   (!) ВСЕ ЭТО ОБЪЯВЛЕНИЕ НИГАТИВНОЕ (во всех поисковых запросах конверсия = 0)</strong>";
                                    endif;

                                    echo "<br>";
                                    echo "<br>";

                                    echo "<div class='color_red'>";
                                        echo "<div class='tabul'>";
                                            ?>
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <div class="accordion-header"><p class='color_yellow'>СПИСОК НИГАТИВНЫХ ПОСИКОВЫХ ЗАПРОСОВ: 🢃показать🢃</p></div>

                                                    <div class="accordion-content">

                                                        <?php
                        //                                echo "<p class='color_yellow'>СПИСОК НИГАТИВНЫХ ПОСИКОВЫХ ЗАПРОСОВ:</p>";
//                                                        var_dump($negativeAds);
//                                                        echo "<br>";
//                                                        var_dump($negativeAds["rows"]);
                                                        foreach ($negativeAds["rows"] as $nigativeAd) {

                                                            echo "* строка в отчете: " . $nigativeAd["id"] .
                                                                " - поисковый запрос: <strong>" . $nigativeAd["Поисковый_запрос"] . "</strong>" .
                                                                " - номер объявления: " . $nigativeAd["n_Объявления"] . "<br>";
                                                        }
                                                        echo "</div>"; // tabul
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                    echo "</div>"; // color red list search queries

                                    echo "<br>";
                                    echo "<br>";

                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                <?php
                echo "</div>"; // tabul
            endif;
            echo "<br>";
        ?>

        <strong>ОБЩИЕ ЗНАЧЕНИЯ ПО ГРУППЕ</strong>
        <?php
        echo "<br><br>";
        if(!empty($group_totals["Показы"])) : echo "ПОКАЗОВ по группе == " . '<span data-field="Показы">' . $group_totals["Показы"] . '</span>' . "<br>"; endif;
        if(!empty($group_totals["Клики"])) : echo "КЛИКИ по группе == " . '<span data-field="Клики">' . $group_totals["Клики"] . '</span>' . "<br>"; endif;
        if(!empty($group_totals["Расход_руб"])) : echo "РАСХОД (руб) по группе == " . '<span data-field="Расход_руб">' . $group_totals["Расход_руб"] . '</span>' . " ₽<br>"; endif;

        if(!empty($group_totals["Конверсии"])) :
            echo "КОНВЕРСИИ по группе == " . '<span data-field="Конверсии">' . $group_totals["Конверсии"] . '</span>' . "<br>";
            else: echo "<strong class='color_red'>(!) ВСЯ ГРУППА НИГАТИНАЯ, 0 конверсий</strong>" . '<span data-field="Конверсии">' . "0" . '</span>';
        endif;

        if(!empty($group_totals["Доход_руб"])) : echo "ДОХОД (руб) по группе == " . '<span data-field="Доход_руб">' . $group_totals["Доход_руб"] . '</span>' . " ₽<br>"; endif;

        echo "<br>";

        if(!empty($group_row["PPAGroupe"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по группе == " . $group_row["PPAGroupe"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
            else : echo "<div class='color_yellow'>Нет расходa/кликов - стоимость клиента не рассчитывается</div>";
        endif;

        if(!empty($group_row["PPCGroupe"])) : echo "Коэффициент конверсии PPC (%) по группе == " . $group_row["PPCGroupe"] . " % ( (кол-во конверсий разделенный на кол-во кликов)*100 )<br>";
        else : echo "<div class='color_yellow'>Нет конверсий/кликов - PPC не рассчитывается</div>";
        endif;


        if(!empty($group_row["CTRGroupe"])) : echo "CTR (%) по группе == " . $group_row["CTRGroupe"] . " % ( кол-во клики разделенный на кол-во показов )<br>";
        else : echo "<div class='color_yellow'>Нет показов/кликов - CTR не рассчитывается</div>";
        endif;

        if(!empty($group_row["wCTRGroupe"])) : echo "wCTR (%) по группе == " . $group_row["wCTRGroupe"] . " % ( кол-во клики разделенный на кол-во Взвешенных показов )<br>";
        else : echo "<div class='color_yellow'>Нет взвешенных показов/кликов - wCTR не рассчитывается</div>";
        endif;

        ?>
        <br><br><strong>СРЕДНИЕ ЗНАЧЕНИЯ ПО ГРУППЕ</strong><br><br>
        <?php
        if(!empty($group_totals["Ср_позиция_кликов"])) : echo "Ср. позиция кликов ≈ " . '<span data-field="Ср_позиция_кликов">' . $group_totals["Ср_позиция_кликов"] . '</span>' . "<br>"; endif;
        if(!empty($group_totals["Глубина_стр"])) : echo "Глубина_стр ≈ " . '<span data-field="Глубина_стр">' . $group_totals["Глубина_стр"] . '</span>' . "<br>"; endif;
        if(!empty($group_totals["Ср_объём_трафика"])) : echo "Ср_объём_трафика ≈ " . '<span data-field="Ср_объём_трафика">' . $group_totals["Ср_объём_трафика"] . '</span>' . "<br>"; endif;
        if(!empty($group_totals["Ср_позиция_показов"])) : echo "Ср_позиция_показов ≈ " . '<span data-field="Ср_позиция_показов">' . $group_totals["Ср_позиция_показов"] . '</span>' . "<br>"; endif;

        if(!empty($group_totals["Ср_цена_клика_руб"])) : echo "Ср_цена_клика_руб ≈ " . '<span data-field="Ср_цена_клика_руб">' . $group_totals["Ср_цена_клика_руб"] . '</span>' . "<br>"; endif;
        ?>
        <br>
        <br>
        <a href="/ads/<?= $adGroups[0]["group"]["n_Кампании"] ?>/<?= $group["n_Группы"] ?>/<?= $table_name ?>"  target="_blank">Показать все запросы</a>
        <a href="/adGroup/<?= $adGroups[0]["group"]["n_Кампании"] ?>/<?= $group["n_Группы"] ?>/<?= $table_name ?>"  target="_blank">Перейти в группу</a>

        <br><br>============================================================================================================================================================================================================<br><br>

    </div>
<?php endforeach; ?>
</div>