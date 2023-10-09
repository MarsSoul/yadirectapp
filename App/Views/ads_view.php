<h1>ADS IN GRPUPE: <?= $ads[0]["Группа"]; ?>  № GROUPE : <?= $ads[0]["n_Группы"]; ?></h1>


<table>
    <thead>
        <tr>
            <?php
                $titles = array_keys($ads[0]);
                foreach ($titles as $title) { echo "<th>{$title}</th>"; }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ads as $row) :
            echo '<tr>';
                foreach ($row as $value) {
                    echo "<td>{$value}</td>";
                }
            echo '</tr>';
        endforeach; ?>
    </tbody>
</table>