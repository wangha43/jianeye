<?php
require "includelib/fun.php";
require "includelib/header.php";

$colors = array("黑", "红", "白", "银", "蓝", "绿", "金");
$fuels = array(0, 92, 95);
$tyre_sizes = array("14", "15", "17");
$outputs = array(1.6, 1.8, 2.0, 2.4, 3.0);
$guests = array(5, 7, 12);
$az = range('A', 'Z');
$data["car_type"] = "benz";
$prev = "粤";

$return = array();
while ($count < 500) {
	$num = "";
	for ($i = 0; $i < 5; $i++) {
		$num .= mt_rand(0, 9);
	}
	$return[] = $num;
	$return = array_unique($return);
	$count = count($return);
}
//
$car_id = array();
$count = 0;
while ($count < 500) {
	$num = "";
	for ($i = 0; $i < 13; $i++) {
		$num .= mt_rand(0, 9);
	}
	$car_id[] = $num;
	$car_id = array_unique($car_id);
	$count = count($car_id);
}
//
$identify = array();
$count = 0;
while ($count < 500) {
	$num = "";
	for ($i = 0; $i < 14; $i++) {
		$num .= mt_rand(0, 9);
	}
	$identify[] = $num;
	$identify = array_unique($identify);
	$count = count($identify);
}

echo $count;
foreach ($return as $key => $value) {
	$data["identify_id"] = "KJH" . array_pop($car_id);
	$data["terminal_id"] = array_pop($identify);
	$data["carry_quality"] = mt_rand(1400, 2000);
	$data["weight"] = mt_rand(1400, 2000);
	$data["init_miles"] = mt_rand(1000, 100000);
	$prevnum = mt_rand(0, 25);
	$data["car_color"] = $colors[mt_rand(0, 6)];
	$data["superior_number"] = mt_rand(7, 11);
	$data["fuel"] = $fuels[mt_rand(0, 2)];
	$data['tyre_style'] = $tyre_style[mt_rand(0, 2)];
	$data['output_power'] = $outputs[mt_rand(0, 4)];
	$data['guest_carry'] = $guests[mt_rand(0, 2)];
	$data["car_license"] = $prev . $az[$prevnum] . $value;
	$res = insert("jianeye_car", $data, $conn);
	if (isset($res)) {
		echo "插入成功\n";
	} else {
		echo "失败\n";
	}
}
/*
核定质量	1400-2000
总质量		1400-2000
初始公里数	1000-100000
 */
// if(isset($res)){
// 	echo "插入成功";
// }else{
// 	echo "失败";
// }