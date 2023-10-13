<h1><?= $report["date_start_report"] ;?> - <?= $report["date_end_report"] ;?></h1>
<h1><?= $report["name_table_report"] ;?></h1>

<a href="/campaigns/<?php echo $report['id']; ?>" target="_blank">Показать кампании</a>
<br>
<br>

<div id="loader" class="loader">
    <div class="loader-text">
        Идет прогрузка отчета в отчете <?php echo count($report_data); ?> строки
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

<div id="pagination">
    <button id="firstPage">Первая</button>
    <button id="prevPage"><<</button>
    <button id="nextPage">>></button>
    <button id="lastPage">Последняя</button>
</div>
<script>const reportData = <?= json_encode($report_data); ?>;</script>