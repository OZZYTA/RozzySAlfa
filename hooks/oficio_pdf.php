<head>
    <style type="text/css">

    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
    </style>
</head>
<form>
<?php

    $currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	
	include_once("$currDir/header.php");
	 /* grant access to all logged users */
	$pqr_from=get_sql_from('pqr');
	if(!$pqr_from) exit(error_message("Acceso denegado!", false));
 ?>
	<div id="non-printable"><right style="text-align: right"><input type="button" onclick="history.back()" class="btn btn-primary" class="noprint" id="volver" value="Atrás">
	<input type="button" onclick="location.href='pqr_view.php';" class="btn btn-primary" class="noprint" id="volver" value="Cancelar"></right></div>
 <div id="printable"><header><center><img src="rotulo.png" alt="" width="940" align="absmiddle"/></center></header>

	
<?php
 /* get the DATA */
	$pqr_id= intval($_REQUEST["SelectedID"]);
	$consecutivo = sqlValue("select consecutivo from pqr where id=$pqr_id");
if ($consecutivo==""){
	$consecutivo=$pqr_id;
}else{
	$consecutivo = sqlValue("select consecutivo from pqr where id=$pqr_id");
}
	$fecha = sqlValue("select fecha from pqr where id=$pqr_id");
	$tipoid = sqlValue("select tipoid from pqr where id=$pqr_id");
	$documento = sqlValue("select doc from pqr where id=$pqr_id");
	$nombres = sqlValue("select nombres from pqr where id=$pqr_id");
	$apellidos = sqlValue("select apellidos from pqr where id=$pqr_id");
	$sexo = sqlValue("select genero from pqr where id=$pqr_id");
	$edad = sqlValue("select edad from pqr where id=$pqr_id");	
	$telefono = sqlValue("select telefono from pqr where id=$pqr_id");
	$direccion = sqlValue("select direccion from pqr where id=$pqr_id");
	$barrio = sqlValue("select barrio from pqr where id=$pqr_id");
	$poblacion = sqlValue("select poblacion from pqr where id=$pqr_id");
	$regimen = sqlValue("select regimen from pqr where id=$pqr_id");
	$cie10 = sqlValue("select enfermedad from pqr where id=$pqr_id");
	$enfermedad = sqlValue("select descripcion from cie10 where cie10=$cie10");
	$eps = sqlValue("select eps from pqr where id=$pqr_id");
	$acudiente = sqlValue("select acudiente from pqr where id=$pqr_id");
	if ($acudiente==1){
		$nombreacu = sqlValue("select nombreacu from pqr where id=$pqr_id");
		$docacudiente = sqlValue("select docacudiente from pqr where id=$pqr_id");
	}else{
		$nombreacu = "";
		$docacudiente = "";
	}
	$ips = sqlValue("select servicio from pqr where id=$pqr_id");
	$referencia = sqlValue("select tipopqr from pqr where id=$pqr_id");
	$descripcion = sqlValue("select descripcion from pqr where id=$pqr_id");
	$motivo = sqlValue("select motivo from pqr where id=$pqr_id");
	$obmotivo = sqlValue("select obmotivo from pqr where id=$pqr_id");
	$asignado = sqlValue("select asignado from pqr where id=$pqr_id");
	$emailuser = sqlValue("select emailuser from pqr where id=$pqr_id");

?>


<table width="100%" border="1">
  <tbody>
    <tr bgcolor="#B3ACAC">
      <td width="50%" bgcolor="#B3ACAC" height="24" valign="middle"><p><strong style="font-size: large; color: #000000;">Queja No. <?php echo "$consecutivo"?></strong></p></td>
      <td width="50%" valign="middle"><p><strong style="font-size: large; color: #000000;">Fecha: <?php echo "$fecha"?></strong></p></td>
    </tr>
  </tbody>
</table><br>

<table width="100%" border="1">

    <tr align="center" bgcolor="#E5E0E0">
      <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">USUARIO</strong></td>
  </tr>

</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="100%" height="173" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>TIPO DE DOCUMENTO</strong>: <?php echo "$tipoid"?>   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> <?php echo "$documento"?><br>
		  				<strong>NOMBRE(S)</strong>: <?php echo "$nombres"?> &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> <?php echo "$apellidos"?><br>
		  				<strong>SEXO</strong>: <?php echo "$sexo"?>&ensp;  &ensp; &ensp; &ensp;<strong>EDAD</strong>:</strong> <?php echo "$edad"?>&ensp;  &ensp; &ensp; &ensp;<strong>TELEFONO:</strong> </strong><?php echo "$telefono"?>
		  				<br><strong>DIRECCION</strong>: <?php echo "$direccion"?>&ensp;  &ensp; &ensp; &ensp;<strong>BARRIO</strong>:</strong> <?php echo "$barrio"?><br>
		  				<strong>TIPO DE REGIMEN</strong>: <?php echo "$regimen"?>&ensp;  &ensp; &ensp; &ensp;<strong>TIPO DE POBLACION</strong>:</strong> <?php echo "$poblacion"?><br>
		  				<strong>ENFERMEDAD</strong>: <?php echo "$enfermedad"?><br>
		  				<strong>ENTIDAD ADMINISTRADORA DEL PLAN DE BENEFICIOS EAPB</strong>: <?php echo "$eps"?><br>
		  				<strong>Nombre del Acudiente (si es diferente al usuario)</strong>: <?php echo "$nombreacu"?><br>
		  				<strong>Cedula del acudiente</strong>: <?php echo "$docacudiente"?></span>
      </p>
    </tr>
  </tbody>
</table>
<br>
<table width="100%" border="1">
  <tr align="center" bgcolor="#E5E0E0">
    <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">GENERALIDADES DE LA QUEJA</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td colspan="2" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>IPS O DROGUERIA QUE PRESTA EL SERVICIO</strong>: <?php echo "$ips"?> <strong> &ensp;  &ensp; &ensp; &ensp;</strong><br>
          <strong>REFERENCIA DE LA QUEJA(S)</strong>: <?php echo "$referencia"?> &ensp;&ensp;&ensp;&ensp;<br>
          <strong>DESCRIPCION</strong>: <?php echo "$descripcion"?>&ensp;<br>
          <strong>MOTIVO</strong>: <?php echo "$motivo"?><br>
          <strong>OBSERVACION A MOTIVO</strong>: <?php echo "$obmotivo"?>&ensp;</span>  &ensp;
        </p>
      </tr>
    <tr>
      <td width="50%" valign="top"><p><strong style="color: #000000; font-size: small;">Firma del Usuario:</strong></p>
        <p>&nbsp;</p>
        <p><span style="color: #000000"><strong> __________________________________________ </strong><br>
    <strong>C.C ______________________________________</strong></span></p>          
      <td width="50%" valign="bottom" style="text-align: right; font-size: x-small; color: #000000;">Nombre del Funcionario de la SSM             
    </tr>
    <tr>
      <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><p>Proyectó: <?php echo "$asignado"?>  <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>Correo E. <?php echo "$emailuser"?></p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>  
      </tr>
  </tbody>
</table>
<footer><center><img src="footer.png" alt="" width="598" height="63" align="absmiddle"/></center></footer>
</form>
</div>
<?php
    include_once("$currDir/footer.php");
?>

<script>
var is_chrome = function () { return Boolean(window.chrome); }
if(is_chrome) 
{
   window.print();
   setTimeout(function(){window.close();}, 10000); 
   //give them 10 seconds to print, then close
}
else
{
   window.print();
   window.close();
}
</script>

<body onLoad="loadHandler();">
	

