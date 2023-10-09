<h1>CAMPAIGN</h1>
<h2>
    <?php
        echo $report['date_start_report'] ." - ". $report['date_end_report']
        ." | report name = ". $report['name_table_report'] ." | date create report ". $report['date_create_report'];
    ?>
</h2>
<?php
//var_dump($campaigns);
?>


<ul>
    <?php foreach($campaigns as $campaign_row) :
        $campaign = $campaign_row["campaign"];
        $campaign_totals = $campaign_row["totals"];
        ?>
        <li>
            <?php var_dump($campaign["n_Кампании"]); ?><br><br>
            <?php var_dump($campaign["Кампания"]); ?><br><br>

<!--            --><?php
//            if($campaign_row["nigative"] === true) : echo "<p class='color_red'>(!) ВСЯ КАМПАНИЯ НИГАТИНАЯ, 0 конверсий</p>"; endif;
//            ?>
            <?php
            if($campaign_row["haveNigativeGroup"] === true) : echo "<p class='color_yellow'>(!) В КАМПАНИИ ЕСТЬ НИГАТИВНЫЕ ОБЪЯВЛЕНИЯ</p>"; endif;
            ?>

            <?php
            echo "<br><br>";
            echo "Общая информация по кампании:<br>";
            if(!empty($campaign_totals["Показы"])) : echo "ПОКАЗОВ по кампании == " . $campaign_totals["Показы"] . "<br>"; endif;
            if(!empty($campaign_totals["Клики"])) : echo "КЛИКИ по кампании == " . $campaign_totals["Клики"] . "<br>"; endif;
            if(!empty($campaign_totals["Расход_руб"])) : echo "РАСХОД (руб) по кампании == " . $campaign_totals["Расход_руб"] . " ₽<br>"; endif;
            if(!empty($campaign_totals["Конверсии"])) :
                echo "КОНВЕРСИИ по кампании == " . $campaign_totals["Конверсии"] . "<br>";
                else: echo "<p class='color_red'>(!) ВСЯ КАМПАНИЯ НИГАТИНАЯ, 0 конверсий</p>";
            endif;
            if(!empty($campaign_totals["Доход_руб"])) : echo "ДОХОД (руб) по кампании == " . $campaign_totals["Доход_руб"] . " ₽<br>"; endif;

            ?>
            <a href="/adGroups/<?= $campaign['n_Кампании']?>/<?= $report['name_table_report']?>">Получить группы</a>
            <br><br>======================================<br><br>

        </li>
    <?php endforeach; ?>
</ul>