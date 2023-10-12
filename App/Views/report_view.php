<h1><?= $report["date_start_report"] ;?> - <?= $report["date_end_report"] ;?></h1>
<h1><?= $report["name_table_report"] ;?></h1>

<table>
    <thead>
        <tr>
            <?php
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