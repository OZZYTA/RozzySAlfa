<?php
	$currDir = dirname(__FILE__) . '/..'; // assuming file inside hooks folder
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	$con = mysqli_connect($dbServer, $dbUsername, $dbPassword);
	mysqli_select_db($con,$dbDatabase);

	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$sql = "SELECT *  FROM pqr where fecha BETWEEN '$fecha1' AND '$fecha2' ORDER BY id";
	$data_returning = sqlValue($sql);
	if (!$data_returning){
	echo "Error: " . $sql;}
	else{
	echo $data_returning
	}

?>