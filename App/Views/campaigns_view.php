<h1>CAMPAIGN</h1>

<h2>
    <?php
        echo $report['date_start_report'] ." - ". $report['date_end_report']
        ." | report name = ". $report['name_table_report'] ." | date create report ". $report['date_create_report'];
    ?>
</h2>

<ul>
    <?php
//    var_dump($campaigns);
    ?>
    <?php foreach($campaigns as $campaign_row) :
        $campaign = $campaign_row["campaign"];
        $campaign_totals = $campaign_row["totals"];
        ?>
        <li>
            <h2>
                <?php var_dump($campaign["n_Кампании"]); ?><br><br>
                <?php var_dump($campaign["Кампания"]); ?><br><br>
            </h2>

            <?php
            if($campaign_row["haveNigativeGroup"] === true) : echo "<p class='color_yellow'>(!) В КАМПАНИИ ЕСТЬ НИГАТИВНЫЕ ЗАПРОСЫ</p>"; endif;
            ?>
            <strong>ОБЩИЕ ЗНАЧЕНИЯ ПО КАМПАНИИ</strong>
            <?php
            echo "<br><br>";
            if(!empty($campaign_totals["Показы"])) : echo "ПОКАЗОВ по кампании == " . $campaign_totals["Показы"] . "<br>"; endif;
            if(!empty($campaign_totals["Клики"])) : echo "КЛИКИ по кампании == " . $campaign_totals["Клики"] . "<br>"; endif;
            if(!empty($campaign_totals["Расход_руб"])) : echo "РАСХОД (руб) по кампании == " . $campaign_totals["Расход_руб"] . " ₽<br>"; endif;

            if(!empty($campaign_totals["Конверсии"])):
                if($campaign_totals["Конверсии"] === "0.00") :
                    echo "<strong class='color_red'>(!) ВСЯ КАМПАНИЯ НИГАТИНАЯ, 0 конверсий</strong><br>";
                    else: echo "КОНВЕРСИИ по кампании == " . $campaign_totals["Конверсии"] . "<br>";
                endif;
            else: echo "<strong class='color_red'>(!) ВСЯ КАМПАНИЯ НИГАТИНАЯ, 0 конверсий</strong><br>";
            endif;

            if(!empty($campaign_totals["Доход_руб"])) : echo "ДОХОД (руб) по кампании == " . $campaign_totals["Доход_руб"] . " ₽<br>"; endif;

            if(!empty($campaign_row["PPACampaign"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по кампании == " . $campaign_row["PPACampaign"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
                else : echo "<div class='color_yellow'>Нет конверсий - стоимость клиента не рассчитывается</div>";
            endif;

//            var_dump($campaign_row["PPA"]);
            ?>

            <br><br><strong>СРЕДНИЕ ЗНАЧЕНИЯ ПО КАМПАНИИ</strong><br><br>
            <?php
            if(!empty($campaign_totals["Ср_позиция_кликов"])) : echo "Ср. позиция кликов ≈ " . $campaign_totals["Ср_позиция_кликов"] . "<br>"; endif;
            if(!empty($campaign_totals["Глубина_стр"])) : echo "Глубина_стр ≈ " . $campaign_totals["Глубина_стр"] . "<br>"; endif;
            if(!empty($campaign_totals["Ср_объём_трафика"])) : echo "Ср_объём_трафика ≈ " . $campaign_totals["Ср_объём_трафика"] . "<br>"; endif;
            if(!empty($campaign_totals["Ср_позиция_показов"])) : echo "Ср_позиция_показов ≈ " . $campaign_totals["Ср_позиция_показов"] . "<br>"; endif;
            if(!empty($campaign_totals["Ср_цена_клика_руб"])) : echo "Ср_цена_клика_руб ≈ " . $campaign_totals["Ср_цена_клика_руб"] . "<br>"; endif;
            ?>

            <br>
            <br>
            <a href="/adGroups/<?= $campaign['n_Кампании']?>/<?= $report['name_table_report']?>" target="_blank">Получить группы</a>
            <br><br>======================================<br><br>

        </li>
    <?php endforeach; ?>
</ul>