<?php
require "../db_api.php";
$type = $_POST["type"];
$date = $_POST["date"];
$id = $_POST['id'];
$getdate = explode("至", $date);
$date1 = $getdate[0];
$date2 = $getdate[1];
$data = driver_percent($type, $date1, $date2, $id);
echo json_encode($data);
?>