<?php
require "includelib/fun.php";
require "includelib/header.php";

function addz($para) {
	if ($para < 10) {
		return "0" . $para;
	} else {
		return $para;
	}
}
function getfour() {
	$a = "";
	for ($i = 0; $i < 4; $i++) {
		$a .= mt_rand(0, 9);
	}
	return $a;
}

for ($i = 0; $i < 500; $i++) {
	$bdy = mt_rand(70, 99);
	$bdm = mt_rand(1, 12);
	$bdd = mt_rand(1, 28);
	$identi_card = '44' . getfour() . "19" . $bdy . addz($bdm) . addz($bdd) . getfour();
	$data["identity_card"] = $identi_card;
	$data["birth_date"] = "19" . $bdy . "-" . addz($bdm) . "-" . addz($bdd);
	$res = insert("jianeye_driver", $data, $conn);
	if (isset($res)) {
		echo "插入成功\n";
	} else {
		echo "失败\n";
	}
}
