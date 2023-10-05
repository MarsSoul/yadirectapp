<h1>HOME</h1>
<pre>=============================================================================================================</pre>

<h1>Upload new report</h1>

<form action="/uploadReport" method="POST" enctype="multipart/form-data">
    <input type="file" name="xlsx_file">
    <input type="submit" value="zagruzit">
</form>

<pre>=============================================================================================================</pre>

<h1>All reports</h1>

<?php
//var_dump($reports);
?>

<ul>
    <?php foreach($reports as $report) : ?>
        <li>
            <a href="report/<?php echo $report['id']; ?>">
                <?php
                echo $report['date_start_report'] ." - ". $report['date_end_report']
                    ." | report name = ". $report['name_table_report'] ." | date create report ". $report['date_create_report'];
                ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>


