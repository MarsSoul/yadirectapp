<h2 class="color_green">КАМПАНИЯ = <?php print_r($adGroup[0]["group"]["Кампания"]); ?></h2>
<h1 class="color_green">НОМЕР ГРУППЫ = <?php print_r($adGroup[0]["group"]["n_Группы"]); ?> ||| НАЗВАНИЕ ГРУППЫ = <?php print_r($adGroup[0]["group"]["Группа"]); ?></h1>

<?php

$group_totals = $adGroup[0]["totals"];
$all_search_queries = $adGroup[0]["searchQueries"];
$normal_search_queries = $adGroup[0]["listNormalAd"];
$count_search_queries = $adGroup[0]["groupeRows"];
$all_ads = $adGroup[0]["allAd"];
$count_ads = count($all_ads);

if ($adGroup[0]["haveNigativeAd"]) :
    echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНЫЕ ЗАПРОСЫ</p>";
    $nigative_search_queries = $adGroup[0]["listNigativeAd"];
//    var_dump($adGroup[0]["countNigativeAd"]);
    echo "Всего нигативных поисковых запросов : " . $adGroup[0]["countNigativeAd"] . "<br>";
endif;
?>
Всего поисковых запросов : <?php print_r($count_search_queries) ?><br>
Всего объявлений : <?php print_r($count_ads); ?><br>

<?php
if(!empty($adGroup[0]["listExclusivelyNigativWordsGroup"])) :
?>
    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-header color_red">В группе найдены <strong>нигативные</strong> ключеввые слова: <strong>🢃показать🢃</strong></div>

            <div class="accordion-content">
                <div class="tabul">
                    <?php
                        foreach ($adGroup[0]["listExclusivelyNigativWordsGroup"] as $nigative_word) {
                                echo $nigative_word[0] .' - '. $nigative_word[1] . '<br>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
else: echo "<strong class='color_green'>Нигативных ключевых слов НЕ найдено</strong>";
endif;
?>
<?php
if(!empty($adGroup[0]["listSearchQueriesGroup"])) :
    ?>
    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-header color_green"><strong>Все</strong> ключеввые слова в группе: <strong>🢃показать🢃</strong></div>

            <div class="accordion-content">
                <div class="tabul">
                    <?php
                    foreach ($adGroup[0]["listSearchQueriesGroup"] as $word) {
                        echo $word[0] .' - '. $word[1] . '<br>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
?>


<br>
<br>

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

echo "<br>";

if(!empty($adGroup[0]["PPAGroupe"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по группе == " . $adGroup[0]["PPAGroupe"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
else : echo "<div class='color_yellow'>Нет конверсий/кликов - стоимость клиента не рассчитывается</div>";
endif;

if(!empty($adGroup[0]["PPCGroupe"])) : echo "Коэффициент конверсии PPC (%) по группе == " . $adGroup[0]["PPCGroupe"] . " % ( (кол-во конверсий разделенный на кол-во кликов)*100 )<br>";
else : echo "<div class='color_yellow'>Нет конверсий/кликов - PPC не рассчитывается</div>";
endif;


if(!empty($adGroup[0]["CTRGroupe"])) : echo "CTR (%) по группе == " . $adGroup[0]["CTRGroupe"] . " % ( кол-во клики разделенный на кол-во показов )<br>";
else : echo "<div class='color_yellow'>Нет показов/кликов - CTR не рассчитывается</div>";
endif;

if(!empty($adGroup[0]["wCTRGroupe"])) : echo "wCTR (%) по группе == " . $adGroup[0]["wCTRGroupe"] . " % ( кол-во клики разделенный на кол-во Взвешенных показов )<br>";
else : echo "<div class='color_yellow'>Нет взвешенных показов/кликов - wCTR не рассчитывается</div>";
endif;
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

<div class="tabul">


    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-header"><strong class='color_fiolet'>ОБЪЯВЛЕНИЯ И ИХ СТАТИСТИКА В ЭТОЙ ГРУППЕ: 🢃показать🢃</strong></div>

            <div class="accordion-content">
            СОРТИРОВКА ПО ОБЩИМ ЗНАЧЕНИЯМ СРЕДИ ОБЪЯВЛЕНИЙ В ЭТОЙ ГРУППЕ<br>
            <button data-sort="Показы" data-order="asc">Сортировать по <strong>показам</strong></button>
            <button data-sort="Клики" data-order="asc">Сортировать по <strong>кликам</strong></button>
            <button data-sort="Расход_руб" data-order="asc">Сортировать по <strong>расходу</strong></button>
            <button data-sort="Конверсии" data-order="asc">Сортировать по <strong>конверсии</strong></button>
            <button data-sort="Доход_руб" data-order="asc">Сортировать по <strong>доходу</strong></button>
            <br>
            СОРТИРОВКА ПО СРЕДНИМ ЗНАЧЕНИЯМ СРЕДИ ОБЪЯВЛЕНИЙ В ЭТОЙ ГРУППЕ<br>
            <button data-sort="Ср_позиция_кликов" data-order="asc">Сортировать по <strong>Ср. позиция кликов</strong></button>
            <button data-sort="Глубина_стр" data-order="asc">Сортировать по <strong>Глубине стр.</strong></button>
            <button data-sort="Ср_объём_трафика" data-order="asc">Сортировать по <strong>Ср. объёму трафика</strong></button>
            <button data-sort="Ср_позиция_показов" data-order="asc">Сортировать по <strong>Ср. позиции показов</strong></button>
            <button data-sort="Ср_цена_клика_руб" data-order="asc">Сортировать по <strong>Ср. цене клика руб.</strong></button>
                <div  class="ad-list"> <!-- ad-list sort-->

                <?php
                foreach ($all_ads as $nomber_ad => $ad) {
                    $search_queries_ad = $ad["rows"];
                    $totals_ad = $ad["totalAd"]["totals"];
                    $count_search_queries_ad = $ad["totalAd"]["groupeRows"];
//                    var_dump($search_queries_ad);
                    ?>
                    <div class="ad" data-показы="<?= $totals_ad['Расход_руб'] ?>"> <!-- ad sort-->
                        <?php
                        echo "<br>";
                        echo "<strong class='color_green'>Номер объявления: " . $nomber_ad . "</strong>";
                        echo "<br>";

                        echo "<div class='tabul'>";
                            if(!empty($ad['totalAd']['listSearchQueriesAd'])) :
                                ?>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="accordion-header color_green"><strong>Все</strong> ключеввые слова в объявлении: <strong>🢃показать🢃</strong></div>

                                        <div class="accordion-content">
                                            <div class="tabul">
                                                <?php
                                                foreach ($ad['totalAd']['listSearchQueriesAd'] as $word) {
                                                    echo $word[0] .' - '. $word[1] . '<br>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endif;

                            if(!empty($ad['totalAd']['listExclusivelyNigativWordsAd'])) :
                                ?>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="accordion-header color_red">В объявлении найдены <strong>нигативные</strong> ключеввые слова: <strong>🢃показать🢃</strong></div>

                                        <div class="accordion-content">
                                            <div class="tabul">
                                                <?php
                                                foreach ($ad['totalAd']['listExclusivelyNigativWordsAd'] as $nigative_word) {
                                                    echo $nigative_word[0] .' - '. $nigative_word[1] . '<br>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            else: echo "<strong class='color_green'>Нигативных ключевых слов НЕ найдено</strong>";
                            endif;
    //                        var_dump($ad["totalAd"]);
                            echo "<br><strong>ВСЕГО ПОИСКОВЫХ ЗАПРОСОВ В ОБЪЯВЛЕНИИ == " . $count_search_queries_ad . "</strong><br>";
                            ?>
                            <div class="tabul">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <div class="accordion-header"><strong class='color_fiolet'>ПОИСКОВЫЕ ЗАПРОСЫ В ОБЪЯВЛЕНИИ: 🢃показать🢃</strong></div>

                                        <div class="accordion-content">

                                            <?php
                                            foreach ($search_queries_ad as $search_queri_ad) {
//                                                print_r($search_queri_ad);
                                                $isNigativeSearchQueri = 'color_green';
                                                if ($search_queri_ad["Конверсии"] == '0' || $search_queri_ad["Конверсии"] == '-' || $search_queri_ad["Конверсии"] == 0) :
                                                    $isNigativeSearchQueri = 'color_red';
                                                endif;
                                                ?>
                                                <div class="accordion">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header">
                                                        <?php
                                                        echo "<div class='{$isNigativeSearchQueri}'>* строка в отчете: " . $search_queri_ad["id"] .
                                                            " - поисковый запрос: <strong>" . $search_queri_ad["Поисковый_запрос"] . "</strong>" .
                                                            " - номер объявления: " . $search_queri_ad["n_Объявления"] . "</div>";
                                                        ?>
                                                        </div>

                                                        <div class="accordion-content">
                                                            <table>
                                                                <thead>
                                                                <tr>
                                                                    <?php
                                                                    $titles = array_keys($search_queri_ad);
                                                                    $values = array_values($search_queri_ad);
                                                                    foreach ($titles as $title) {  echo "<th> {$title} </th>"; }
                                                                    ?>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php echo '<tr>';  foreach ($values as $value) { echo "<td>{$value}</td>"; } echo '</tr>'; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <strong><br>ОБЩИЕ ЗНАЧЕНИЯ ПО ОБЪЯВЛЕНИЮ</strong>
                            <?php
                            echo "<br><br>";
                            if(!empty($totals_ad["Показы"])) : echo "ПОКАЗОВ по объявлению == " . '<span data-field="Показы">' . $totals_ad["Показы"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Клики"])) : echo "КЛИКИ по объявлению == " . '<span data-field="Клики">' . $totals_ad["Клики"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Расход_руб"])) : echo "РАСХОД (руб) по объявлению == " . '<span data-field="Расход_руб">' . $totals_ad["Расход_руб"] . '</span>' . " ₽<br>"; endif;

                            if(!empty($totals_ad["Конверсии"])) :
                                echo "КОНВЕРСИИ по объявлению == " . '<span data-field="Конверсии">' . $totals_ad["Конверсии"] . '</span>' . "<br>";
                            else: echo "<strong class='color_red'>(!) ВСЕ ОБЪЯВЛЕНИЕ НИГАТИВНОЕ, 0 конверсий</strong>" . '<span data-field="Конверсии">' . "0" . '</span>';
                            endif;

                            if(!empty($totals_ad["Доход_руб"])) : echo "ДОХОД (руб) по объявлению == " . '<span data-field="Доход_руб">' . $totals_ad["Доход_руб"] . '</span>' . " ₽<br>"; endif;

                            echo "<br>";

                            if(!empty($ad["totalAd"]["PPAAd"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по объявлению == " . $ad["totalAd"]["PPAAd"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
                            else : echo "<div class='color_yellow'>Нет расходa/кликов - стоимость клиента не рассчитывается</div>";
                            endif;

                            if(!empty($ad["totalAd"]["PPCAd"])) : echo "Коэффициент конверсии PPC (%) по объявлению == " . $ad["totalAd"]["PPCAd"] . " % ( (кол-во конверсий разделенный на кол-во кликов)*100 )<br>";
                            else : echo "<div class='color_yellow'>Нет конверсий/кликов - PPC не рассчитывается</div>";
                            endif;

                            if(!empty($ad["totalAd"]["CTRAd"])) : echo "CTR (%) по объявлению == " . $ad["totalAd"]["CTRAd"] . " % ( кол-во клики разделенный на кол-во показов )<br>";
                            else : echo "<div class='color_yellow'>Нет показов/кликов - CTR не рассчитывается</div>";
                            endif;

                            if(!empty($ad["totalAd"]["wCTRAd"])) : echo "wCTR (%) по объявлению == " . $ad["totalAd"]["wCTRAd"] . " % ( кол-во клики разделенный на кол-во Взвешенных показов )<br>";
                            else : echo "<div class='color_yellow'>Нет взвешенных показов/кликов - wCTR не рассчитывается</div>";
                            endif;

                            echo "<br><br><strong>СРЕДНИЕ ЗНАЧЕНИЯ ПО ГРУППЕ</strong><br><br>";

                            if(!empty($totals_ad["Ср_позиция_кликов"])) : echo "Ср. позиция кликов ≈ " . '<span data-field="Ср_позиция_кликов">' . $totals_ad["Ср_позиция_кликов"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Глубина_стр"])) : echo "Глубина_стр ≈ " . '<span data-field="Глубина_стр">' . $totals_ad["Глубина_стр"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Ср_объём_трафика"])) : echo "Ср_объём_трафика ≈ " . '<span data-field="Ср_объём_трафика">' . $totals_ad["Ср_объём_трафика"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Ср_позиция_показов"])) : echo "Ср_позиция_показов ≈ " . '<span data-field="Ср_позиция_показов">' . $totals_ad["Ср_позиция_показов"] . '</span>' . "<br>"; endif;
                            if(!empty($totals_ad["Ср_цена_клика_руб"])) : echo "Ср_цена_клика_руб ≈ " . '<span data-field="Ср_цена_клика_руб">' . $totals_ad["Ср_цена_клика_руб"] . '</span>' . "<br>"; endif;

                        echo "</div>";
                    echo "<br>";
                echo "</div>"; // ad end sort

                }
                ?>
                </div>   <!-- ad-list end sort-->

            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="color_red"><strong>НИГАТИВНЫЕ ПОИСКОВЫЕ ЗАПРОСЫ</strong></strong></div> <br><br>

    <?php
    if($adGroup[0]["haveNigativeAd"] === true) :

        echo "<div class='tabul'>";
        ?>
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header"><p class='color_yellow'>СПИСОК НИГАТИВНЫХ ОБЪЯВЛЕНИЙ: 🢃показать🢃</p></div>

                <div class="accordion-content">
                    <?php
                    foreach ($nigative_search_queries as $adId => $negativeAds) {
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

    else: echo '<div class="color_green">Нет нигативных поисковых запросов</div>';
    endif;
    ?>

    <br>
    <br>

    <div class="color_green"><strong>НОРМАЛЬНЫЕ ПОИСКОВЫЕ ЗАПРОСЫ</strong></strong></div> <br><br>

    <?php
    if (!empty($normal_search_queries)) :

        echo "<div class='tabul'>";
        ?>
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header"><p class='color_yellow'>СПИСОК НОРМАЛЬНЫХ ОБЪЯВЛЕНИЙ: 🢃показать🢃</p></div>

                <div class="accordion-content">
                    <?php
                    foreach ($normal_search_queries as $adId => $normalAds) {
                        if (count($normalAds["rows"]) !== 0 ){
                            echo "<strong class='color_green'>Номер объявления: " . $normalAds["rows"][0]["n_Объявления"] . "</strong>";

                            echo "<br>";
                            echo "<br>";

                            echo "<div class='color_green'>";
                            echo "<div class='tabul'>";
                            ?>
                            <div class="accordion">
                                <div class="accordion-item">
                                    <div class="accordion-header"><p class='color_yellow'>СПИСОК НОРМАЛЬНЫХ ПОСИКОВЫХ ЗАПРОСОВ: 🢃показать🢃</p></div>

                                    <div class="accordion-content">

                                        <?php
                                        foreach ($normalAds["rows"] as $nigativeAd) {

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
                            echo "</div>"; // color green list search queries

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

    else: echo '<div class="color_red">(!) Нет поисковых запросов с конверсией</div>';
    endif;
    ?>

    <br>
    <br>

    <div class="accordion">
        <div class="accordion-item">
            <div class="accordion-header"><strong class='color_fiolet'>ВСЕ ПОИСКОВЫЕ ЗАПРОСЫ В ЭТОЙ ГРУППЕ: 🢃показать🢃</strong></div>

            <div class="accordion-content">
                <div id="loader" class="loader">
                    <div class="loader-text">
                        Идет прогрузка отчета в отчете <?php echo count($all_search_queries); ?> строки
                    </div>
                </div>

                <label for="itemsPerPage">Пагинировать по :</label>
                <input type="number" id="itemsPerPage" min="1" value="50">
                <button id="updatePerPage">применить</button>
                <br>
                <br>

                <table id="reportTable">
                    <thead>
                    <tr>
                        <?php
                        $titles = array_keys($all_search_queries[0]);
                        foreach ($titles as $title) {
                            echo "<th data-order='asc' class='sotr-titles'>
                            {$title}
                            <div class='sotr-titles-info'>sort me</div>
                        </th>";
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($all_search_queries as $row) :
                        echo '<tr>';
                            foreach ($row as $value) {
                                echo "<td>{$value}</td>";
                            }
                        echo '</tr>';
                    endforeach; ?>
                    </tbody>
                </table>

                <div id="pagination">
                    <button id="firstPage">Первая</button>
                    <button id="prevPage"><<</button>
                    <button id="nextPage">>></button>
                    <button id="lastPage">Последняя</button>
                </div>
<!--                <script>const reportData = --><?php //= json_encode($all_search_queries); ?><!--</script>-->
                <script>const reportData = <?= json_encode($all_search_queries); ?>;</script>
                <!--===-->
            </div>
        </div>
    </div>

</div> <!--tabul-->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

