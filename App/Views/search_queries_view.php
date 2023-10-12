<h1>ПОИСКОВЫЕ ЗАПРОСЫ IN GRPUPE: <?= $ads[0]["Группа"]; ?>  № GROUPE : <?= $ads[0]["n_Группы"]; ?></h1>

<table>
    <thead>
        <tr>
            <?php
                $titles = array_keys($ads[0]);
                foreach ($titles as $title) {
//                    echo "<th>{$title}</th>";
                    echo "<th data-order='asc' class='sotr-titles'>
                        {$title}
                        <div class='sotr-titles-info'>sort me</div>
                    </th>";
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ads as $row) :
//            var_dump($row["Конверсии"]);
            $backgroundNigativeConverion = '';

            if ($row["Конверсии"] == "0" || $row["Конверсии"] == "-") {
                $backgroundNigativeConverion = 'backgrn_color_red';
            }
            echo '<tr class="' . $backgroundNigativeConverion . '">';
            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }
            echo '</tr>';


        endforeach; ?>
    </tbody>
</table>