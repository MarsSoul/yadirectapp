<h1>GROUPS IN CAMPANI: <?= $adGroups[0]["group"]["Кампания"]; ?>  № camp : <?= $adGroups[0]["group"]["n_Кампании"]; ?></h1>

<ul>
<?php

foreach ($adGroups as $group_row):
    $group = $group_row["group"];
    $group_totals = $group_row["totals"];
    ?>
    <li>

        <h2 class="color_green">НОМЕР ГРУППЫ = <?php print_r($group["n_Группы"]); ?> ||| НАЗВАНИЕ ГРУППЫ = <?php print_r($group["Группа"]); ?></h2>


        <?php
            if($group_row["haveNigativeAd"] === true) : echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНЫЕ ЗАПРОСЫ</p>";

                echo "<div class='tabul'>";
                    echo "<p class='color_yellow'>СПИСОК НИГАТИВНЫХ ОБЪЯВЛЕНИЙ:</p>";

                    foreach ($group_row["listNigativeAd"] as $adId => $negativeAds) {
                        echo "<strong class='color_green'>Номер объявления: " . $negativeAds["rows"][0]["n_Объявления"] . "</strong>";
                    //    var_dump($negativeAds["rows"][0]["n_Объявления"]);
    //                    var_dump($negativeAds["adniga"]);
                        if($negativeAds["isAdNigative"] === true) :
                            echo "<strong class='color_red'>   (!) ВСЕ ЭТО ОБЪЯВЛЕНИЕ НИГАТИВНОЕ (во всех поисковых запросах конверсия = 0)</strong>";
                        endif;

                        echo "<br>";
                        echo "<br>";


                        echo "<div class='color_red'>";


                            echo "<div class='tabul'>";

                                echo "<p class='color_yellow'>СПИСОК НИГАТИВНЫХ ПОСИКОВЫХ ЗАПРОСОВ:</p>";
                                foreach ($negativeAds["rows"] as $nigativeAd) {

                                    echo "* строка в отчете: " . $nigativeAd["id"] .
                                        " - поисковый запрос: <strong>" . $nigativeAd["Поисковый_запрос"] . "</strong>" .
                                        " - номер объявления: " . $nigativeAd["n_Объявления"] . "<br>";
                                }
                            echo "</div>"; // tabul
                        echo "</div>"; // color red list search queries

                        echo "<br>";
                        echo "<br>";
                    }
                echo "</div>"; // tabul
            endif;
            echo "<br>";
        ?>

        <strong>ОБЩИЕ ЗНАЧЕНИЯ ПО ГРУППЕ</strong>
        <?php
            echo "<br><br>";
            if(!empty($group_totals["Показы"])) : echo "ПОКАЗОВ по группе == " . $group_totals["Показы"] . "<br>"; endif;
            if(!empty($group_totals["Клики"])) : echo "КЛИКИ по группе == " . $group_totals["Клики"] . "<br>"; endif;
            if(!empty($group_totals["Расход_руб"])) : echo "РАСХОД (руб) по группе == " . $group_totals["Расход_руб"] . " ₽<br>"; endif;
            if(!empty($group_totals["Конверсии"])) :
                echo "КОНВЕРСИИ по группе == " . $group_totals["Конверсии"] . "<br>";
                else: echo "<strong class='color_red'>(!) ВСЯ ГРУППА НИГАТИНАЯ, 0 конверсий</strong>";
            endif;
            if(!empty($group_totals["Доход_руб"])) : echo "ДОХОД (руб) по группе == " . $group_totals["Доход_руб"] . " ₽<br>"; endif;
        ?>
        <br><br><strong>СРЕДНИЕ ЗНАЧЕНИЯ ПО ГРУППЕ</strong><br><br>
        <?php
        if(!empty($group_totals["Ср_позиция_кликов"])) : echo "Ср. позиция кликов ≈ " . $group_totals["Ср_позиция_кликов"] . "<br>"; endif;
        if(!empty($group_totals["Глубина_стр"])) : echo "Глубина_стр ≈ " . $group_totals["Глубина_стр"] . "<br>"; endif;
        if(!empty($group_totals["Ср_объём_трафика"])) : echo "Ср_объём_трафика ≈ " . $group_totals["Ср_объём_трафика"] . "<br>"; endif;
        if(!empty($group_totals["Ср_позиция_показов"])) : echo "Ср_позиция_показов ≈ " . $group_totals["Ср_позиция_показов"] . "<br>"; endif;
        if(!empty($group_totals["Ср_цена_клика_руб"])) : echo "Ср_цена_клика_руб ≈ " . $group_totals["Ср_цена_клика_руб"] . "<br>"; endif;
        ?>
        <br>
        <br>
        <a href="/ads/<?= $adGroups[0]["group"]["n_Кампании"] ?>/<?= $group["n_Группы"] ?>/<?= $table_name ?>"  target="_blank">Показать все запросы</a>

        <br><br>============================================================================================================================================================================================================<br><br>

    </li>
<?php endforeach; ?>
</ul>