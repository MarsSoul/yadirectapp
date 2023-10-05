<?php
// TODO add report name, dates
?>
<h1>REPORT</h1>

<table>
    <thead>
        <tr>
            <?php
                $titles = array_keys($report_data[0]);
//                var_dump($titles);
                foreach ($titles as $title) { echo "<th>{$title}</th>"; }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($report_data as $row) {
            echo '<tr>';
                foreach ($row as $value) {
                    echo "<td>{$value}</td>";
                }
            echo '</tr>';
        }
        ?>
    </tbody>
</table>