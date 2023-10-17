<h1 class="color_green">НОМЕР ГРУППЫ = <?php print_r($adGroup[0]["group"]["n_Группы"]); ?> ||| НАЗВАНИЕ ГРУППЫ = <?php print_r($adGroup[0]["group"]["Группа"]); ?></h1>

<?php
//var_dump($adGroup[0]["allAd"]);
$group_totals = $adGroup[0]["totals"];
$all_search_queries = $adGroup[0]["searchQueries"];
$normal_search_queries = $adGroup[0]["listNormalAd"];
$count_search_queries = $adGroup[0]["groupeRows"];
$all_ads = $adGroup[0]["allAd"];
$count_ads = count($all_ads);

if ($adGroup[0]["haveNigativeAd"]) :
    echo "<p class='color_yellow'>(!) В ЭТОЙ ГРУППЕ ЕСТЬ НИГАТИВНЫЕ ЗАПРОСЫ</p>";
    $nigative_search_queries = $adGroup[0]["listNigativeAd"];
endif;
?>
Всего поисковых запросов : <?php print_r($count_search_queries) ?><br>
Всего объявлений : <?php print_r($count_ads); ?><br>

<br>
<br>

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

if(!empty($adGroup[0]["PPAGroupe"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по группе == " . $adGroup[0]["PPAGroupe"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
else : echo "<div class='color_yellow'>Нет конверсий/кликов - стоимость клиента не рассчитывается</div>";
endif;
//var_dump($adGroup[0]);
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
if(!empty($group_totals["Ср_позиция_кликов"])) : echo "Ср. позиция кликов ≈ " . '<span data-field="Ср_позиция_кликов">' . $group_totals["Ср_позиция_кликов"] . '</span>' . "<br>"; endif;
if(!empty($group_totals["Глубина_стр"])) : echo "Глубина_стр ≈ " . '<span data-field="Глубина_стр">' . $group_totals["Глубина_стр"] . '</span>' . "<br>"; endif;
if(!empty($group_totals["Ср_объём_трафика"])) : echo "Ср_объём_трафика ≈ " . '<span data-field="Ср_объём_трафика">' . $group_totals["Ср_объём_трафика"] . '</span>' . "<br>"; endif;
if(!empty($group_totals["Ср_позиция_показов"])) : echo "Ср_позиция_показов ≈ " . '<span data-field="Ср_позиция_показов">' . $group_totals["Ср_позиция_показов"] . '</span>' . "<br>"; endif;

if(!empty($group_totals["Ср_цена_клика_руб"])) : echo "Ср_цена_клика_руб ≈ " . '<span data-field="Ср_цена_клика_руб">' . $group_totals["Ср_цена_клика_руб"] . '</span>' . "<br>"; endif;
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
<!--СОРТИРОВКА ПО СРЕДНИМ ЗНАЧЕНИЯМ СРЕДИ ОБЪЯВЛЕНИЙ В ЭТОЙ ГРУППЕ<br>-->
<!--<button data-sort="Ср_позиция_кликов" data-order="asc">Сортировать по <strong>Ср. позиция кликов</strong></button>-->
<!--<button data-sort="Глубина_стр" data-order="asc">Сортировать по <strong>Глубине стр.</strong></button>-->
<!--<button data-sort="Ср_объём_трафика" data-order="asc">Сортировать по <strong>Ср. объёму трафика</strong></button>-->
<!--<button data-sort="Ср_позиция_показов" data-order="asc">Сортировать по <strong>Ср. позиции показов</strong></button>-->
<!--<button data-sort="Ср_цена_клика_руб" data-order="asc">Сортировать по <strong>Ср. цене клика руб.</strong></button>-->
                <div  class="ad-list"> <!-- ad-list sort-->

                <?php
                foreach ($all_ads as $nomber_ad => $ad) {
                    $search_queries_ad = $ad["rows"];
                    $totals_ad = $ad["totalAd"]["totals"];
                    $count_search_queries_ad = $ad["totalAd"]["groupeRows"];
//                    var_dump($nomber_ad);
                    ?>
                    <div class="ad" data-показы="<?= $totals_ad['Расход_руб'] ?>"> <!-- ad sort-->
                        <?php
                        echo "<br>";
                        echo "<strong class='color_green'>Номер объявления: " . $nomber_ad . "</strong>";
                        echo "<br>";

                        echo "<div class='tabul'>";
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
                            //                    print_r($search_queri_ad);
                                                echo "* строка в отчете: " . $search_queri_ad["id"] .
                                                    " - поисковый запрос: <strong>" . $search_queri_ad["Поисковый_запрос"] . "</strong>" .
                                                    " - номер объявления: " . $search_queri_ad["n_Объявления"] . "<br>";
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

// TODO  add in ad PPA PPC CTR wCTR

//    if(!empty($totals_ad[0]["PPAGroupe"])) : echo "СТОИМОСТЬ КЛИЕНТА (руб) по группе == " . $totals_ad[0]["PPAGroupe"] . " ₽ (расход разделенный на кол-во конверсий)<br>";
//    else : echo "<div class='color_yellow'>Нет конверсий/кликов - стоимость клиента не рассчитывается</div>";
//    endif;
//
//    if(!empty($totals_ad[0]["PPCGroupe"])) : echo "Коэффициент конверсии PPC (%) по группе == " . $adGroup[0]["PPCGroupe"] . " % ( (кол-во конверсий разделенный на кол-во кликов)*100 )<br>";
//    else : echo "<div class='color_yellow'>Нет конверсий/кликов - PPC не рассчитывается</div>";
//    endif;
//
//
//    if(!empty($totals_ad[0]["CTRGroupe"])) : echo "CTR (%) по группе == " . $totals_ad[0]["CTRGroupe"] . " % ( кол-во клики разделенный на кол-во показов )<br>";
//    else : echo "<div class='color_yellow'>Нет показов/кликов - CTR не рассчитывается</div>";
//    endif;
//
//    if(!empty($totals_ad[0]["wCTRGroupe"])) : echo "wCTR (%) по группе == " . $totals_ad[0]["wCTRGroupe"] . " % ( кол-во клики разделенный на кол-во Взвешенных показов )<br>";
//    else : echo "<div class='color_yellow'>Нет взвешенных показов/кликов - wCTR не рассчитывается</div>";
//    endif;




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
                <!--            --><?php
                //            foreach ($all_search_queries as $searchQuery) {
                //                var_dump($searchQuery);
                //                echo "<br><br>";
                //            }
                //            ?>
                <!--===-->
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
                        //            var_dump($report_data);
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
                <script>const reportData = <?= json_encode($all_search_queries); ?>//;</script>
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

