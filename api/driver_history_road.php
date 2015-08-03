<?php
require "../db_api.php";
$type = $_POST["type"];
$date = $_POST["date"];
$category = $_POST["category"];
$id = $_POST["id"];
$getdate = explode("至", $date);
$date1 = $getdate[0];
$date2 = $getdate[1];
$data = type_list($type, $date1, $date2, $category, $id);
echo json_encode($data);