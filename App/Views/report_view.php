<h1><?= $report["date_start_report"] ;?> - <?= $report["date_end_report"] ;?></h1>
<h1><?= $report["name_table_report"] ;?></h1>

<a href="/campaigns/<?php echo $report['id']; ?>" target="_blank">Показать кампании</a>
<br>
<br>

<!--<div>-->
<!--    <a href="/report/--><?php //= $report["id"] ?><!--/all">ВЫВЕСТИ БЕЗ ПАГИНАЦИИ</a>-->
<!--</div>-->
<!--<br>-->
<!--<br>-->


<table>
    <thead>
        <tr>
            <?php
//            var_dump($report_data);
                $titles = array_keys($report_data[0]);
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
        <?php foreach($report_data as $row) :
            echo '<tr>';
                foreach ($row as $value) {
                    echo "<td>{$value}</td>";
                }
            echo '</tr>';
        endforeach; ?>

    </tbody>
</table>

<!--pagg start-->
<?php
////print_r($total_pages);
//?>
<?php
//if ($total_pages > 1) :
//    for ($i = 1; $i <= $total_pages; $i++) : ?>
<!--        <div class="page-item--><?php //= ($current_page == $i) ? ' active' : '' ?><!--">-->
<!--            <a class="page-link" href="/report/--><?php //= $report["id"] ?><!--/--><?php //= $i-1 ?><!--">--><?php //= $i ?><!--</a>-->
<!--        </div>-->
<?php
//    endfor;
//endif;
//?>

<!--pad end-->