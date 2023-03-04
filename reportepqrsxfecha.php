<?php

    $currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	
	include_once("$currDir/header.php");
	 /* grant access to all logged users */
	$pqr_from=get_sql_from('pqr');
	if(!$pqr_from) exit(error_message("Acceso denegado!", false));
 
 
 
$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

//Create our SQL query.
$sql = "SELECT *  FROM pqr where fecha BETWEEN '$fecha1' AND '$fecha2' ORDER BY id";

 
//Fetch all of the rows from our MySQL table.
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
 
 
//Setup the filename that our CSV will have when it is downloaded.
$fileName = 'Reporte PQRS por fechas.csv';
 
//Set the Content-Type and Content-Disposition headers to force the download.
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
 
//Open up a file pointer
$fp = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
fputcsv($fp, $columnNames);
 
//Then, loop through the rows and write them to the CSV file.
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
 
//Close the file pointer.
fclose($fp);

if(isset($_POST['generar_reporte']))
{
	//Create our SQL query.
$sql = "SELECT *  FROM pqrs where fecha BETWEEN '$fecha1' AND '$fecha2' ORDER BY id";
 
//Prepare our SQL query.
$statement = $pdo->prepare($sql);
 
//Executre our SQL query.
$statement->execute();
 
//Fetch all of the rows from our MySQL table.
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNames = array();
if(!empty($rows)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}
 
$fileName = 'Reporte PQRS por fechas.csv';
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
 
//Open up a file pointer
$fp = fopen('php://output', 'w');
 

 
//Close the file pointer.
fclose($fp);
}

?>
