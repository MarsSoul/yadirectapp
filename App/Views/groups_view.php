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
            if($group_row["haveNigativeAd"] === true) : echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНОЕ ОБЪЯВЛЕНИЕ</p>"; endif;
        ?>

        <?php
            echo "<br><br>";
            echo "Общая информация по групаавм объявлений:<br>";
            if(!empty($group_totals["Показы"])) : echo "ПОКАЗОВ по группе == " . $group_totals["Показы"] . "<br>"; endif;
            if(!empty($group_totals["Клики"])) : echo "КЛИКИ по группе == " . $group_totals["Клики"] . "<br>"; endif;
            if(!empty($group_totals["Расход_руб"])) : echo "РАСХОД (руб) по группе == " . $group_totals["Расход_руб"] . " ₽<br>"; endif;
            if(!empty($group_totals["Конверсии"])) :
                echo "КОНВЕРСИИ по группе == " . $group_totals["Конверсии"] . "<br>";
                else: echo "<strong class='color_red'>(!) ВСЯ ГРУППА НИГАТИНАЯ, 0 конверсий</strong>";
            endif;
            if(!empty($group_totals["Доход_руб"])) : echo "ДОХОД (руб) по группе == " . $group_totals["Доход_руб"] . " ₽<br>"; endif;
        ?>
        <br>
        <br>
        <a href="/ads/<?= $adGroups[0]["group"]["n_Кампании"] ?>/<?= $group["n_Группы"] ?>/<?= $table_name ?>"  target="_blank">Показать объявления</a>
        <br><br>======================================<br><br>
    </li>
<?php endforeach; ?>
</ul>