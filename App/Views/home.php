<h1>HOME</h1>

<pre>=============================================================================================================</pre>

<?php if(!empty($lastReport)) : ?>
    Дата последнего отчета: <?php echo $lastReport['date_create_report']; ?> ===
    <strong>
        c <?php echo $lastReport['date_start_report']; ?>
        по <?php echo $lastReport['date_end_report']; ?>
    </strong>
    ===
    <a href="report/<?php echo $lastReport['id']; ?>" target="_blank">
        <?php echo "report name = ". $lastReport['name_table_report'];?>
    </a>
    |||||
    <a href="/campaigns/<?php echo $lastReport['id']; ?>" target="_blank">Показать кампании</a>

    <?php else: echo "Стоит загрузить первый отчет"; ?>
<?php endif; ?>

<pre>=============================================================================================================</pre>

<h1>Upload new report</h1>

<?php
    if(!empty($recommendedDate)) :
        echo "<p class='color_red'>(!)Рекомендую создать отчет : с " . $recommendedDate['recommendStart'] . " по " . $recommendedDate['recommendEnd'] . "</p>";
    endif;
?>
<br><br>
<form action="/uploadReport" method="POST" enctype="multipart/form-data">
    <input type="file" name="xlsx_file">
    <input type="submit" value="zagruzit">
</form>

<pre>=============================================================================================================</pre>

<h1>All reports</h1>

<?php if(!empty($reports)) : ?>
    <ul>
        <?php foreach($reports as $report) : ?>
            <li>
                <a href="report/<?php echo $report['id']; ?>" target="_blank">
                    <?php
                    echo $report['date_start_report'] ." - ". $report['date_end_report']
                        ." | report name = ". $report['name_table_report'] ." | date create report ". $report['date_create_report'];
                    ?>
                </a>
                |||||
                <a href="/campaigns/<?php echo $report['id']; ?>" target="_blank">Показать кампании</a>
                |||||
                <a href="/report/delete/<?php echo $report['id']; ?>/<?php echo $report['name_table_report']; ?>" class="color_red"> (!) Удалить отчет</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php else: echo "История отчетов пуста"; ?>
<?php endif; ?>

