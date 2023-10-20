<h1>ПОИСКОВЫЕ ЗАПРОСЫ В ГРУППЕ: <?= $ads[0]["Группа"]; ?>  № ГРУППЫ : <?= $ads[0]["n_Группы"]; ?></h1>


<label for="itemsPerPage">Пагинировать по :</label>
<input type="number" id="itemsPerPage" min="1" value="50">
<button id="updatePerPage">применить</button>
<br>
<br>

<table id="reportTable">
    <thead>
        <tr>
            <?php
                $titles = array_keys($ads[0]);
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
        <?php foreach($ads as $row) :
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

<div id="pagination">
    <button id="firstPage">Первая</button>
    <button id="prevPage"><<</button>
    <button id="nextPage">>></button>
    <button id="lastPage">Последняя</button>
</div>

<script>const reportData = <?= json_encode($ads); ?>;</script>