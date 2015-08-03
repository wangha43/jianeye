<?php
	header('Content-Type:text/html;charset=utf-8');
	// error_reporting(E_ALL);
	date_default_timezone_set('PRC');
	
    $conn=mysqli_connect('localhost','jianeye','wxcjianeye','jianeye');
	 mysqli_set_charset($conn,'utf8');	