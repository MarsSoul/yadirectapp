<h1>GROUPS IN CAMPANI: <?= $adGroups[0]["group"]["Кампания"]; ?>  № camp : <?= $adGroups[0]["group"]["n_Кампании"]; ?></h1>

<ul>
<?php

foreach ($adGroups as $group_row):
    $group = $group_row["group"];
    $group_totals = $group_row["totals"];
    ?>
    <li>
        <?php var_dump($group["n_Группы"]); ?><br><br>
        <?php var_dump($group["Группа"]); ?><br><br>


        <?php
            if($group_row["haveNigativeAd"] === true) : echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНОЕ ОБЪЯВЛЕНИЕ</p>";

                echo "<p class='color_yellow'>СПИСОК НИГАТИВНЫХ:</p>";
            endif;

            echo "<div class='color_red'>";
                foreach ($group_row["listNigativeAd"] as $nigativeAd):
                    echo "* строка в отчете: " . $nigativeAd["id"] .
                        " - поисковый запрос: " . $nigativeAd["Поисковый_запрос"] .
                        " - номер объявления: " . $nigativeAd["n_Объявления"];
                endforeach;
            echo "</div>";
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
        <a href="/ads/<?= $adGroups[0]["group"]["n_Кампании"] ?>/<?= $group["n_Группы"] ?>/<?= $table_name ?>"  target="_blank">Показать объявления</a>
        <br><br>======================================<br><br>
    </li>
<?php endforeach; ?>
</ul>