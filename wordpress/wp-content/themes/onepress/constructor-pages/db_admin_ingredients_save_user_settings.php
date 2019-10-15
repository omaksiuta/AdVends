<?php


require ('../constructor-configurations/db_config.php');


$position = $_POST['position'];


$i = 1;
foreach ($position as $k => $v) {
    $sql = "Update sorting_items SET position_order=" . $i . " WHERE id=" . $v;
    $mysqli->query($sql);

    $i++;
}


?>