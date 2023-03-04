<?php

$memberID=$_POST['memberID'];
$passMD5=$_POST['passMD5'];
session_start();
$_SESSION['memberID']=$memberID;

include('db.php');
$consulta= "SELECT * FROM membership_users WHERE memberID='$memberID' and passMD5=md5('$passMD5')";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
	header("location:home.php");
}else{
	?>
	<?php	
	include("index.php");
		?>
	<h1>ERROR DE LOGUEO</h1>;
	<?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
