<?php

echo 'im view - home<br><br><br>';

echo $homecont;
echo $basecont;

?>

<form action="/uploadReport" method="POST" enctype="multipart/form-data">
    <input type="file" name="xlsx_file">
    <input type="submit" value="zagruzit">
</form>

