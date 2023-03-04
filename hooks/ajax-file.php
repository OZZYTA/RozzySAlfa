<?php
	$currDir = dirname(__FILE__) . '/..'; // assuming file inside hooks folder
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	$con = mysqli_connect($dbServer, $dbUsername, $dbPassword);
	mysqli_select_db($con,$dbDatabase);


	$sql = "SELECT id FROM `consecutivos` ORDER BY id DESC limit 1";
	$data_returning = sqlValue($sql);
	$data_returning =$data_returning +1;
	echo $data_returning;


?>