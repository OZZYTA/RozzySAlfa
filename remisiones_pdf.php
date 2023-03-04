<!DOCTYPE html>
<html>
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
	$otros_from=get_sql_from('otros');
	if(!$otros_from) exit(error_message("Acceso denegado!", false));
 ?>
	<div id="non-printable"><right style="text-align: right"><input type="button" onclick="history.back()" class="btn btn-primary" class="noprint" id="volver" value="Atrás">
	<input type="button" onclick="location.href='pqr_view.php';" class="btn btn-primary" class="noprint" id="volver" value="Cancelar">
	<input type="button" onclick="window.print()" class="btn btn-primary" class="noprint" id="volver" value="Imprimir"></right></div>
 <div id="printable"><header><center><img src="rotulo.png" alt="" width="940" align="absmiddle"/></center></header>

	
<?php
 /* get the DATA */
	$otros_id= intval($_REQUEST["SelectedID"]);
	$fecha = sqlValue("select fecha from otros where id=$otros_id");
	$tipodoc = sqlValue("select tipodoc from otros where id=$otros_id");
	$procedencia = sqlValue("select procedencia from otros where id=$otros_id");
	$asunto = sqlValue("select asunto from otros where id=$otros_id");
	$documento = sqlValue("select documento from otros where id=$otros_id");
	$nombres = sqlValue("select nombres from otros where id=$otros_id");
	$apellidos = sqlValue("select apellidos from otros where id=$otros_id");
	$nacimiento = sqlValue("select nacimiento from otros where id=$otros_id");
	$sexo = sqlValue("select sexo from otros where id=$otros_id");
	$edad = sqlValue("select edad from otros where id=$otros_id");	
	$telefono = sqlValue("select telefono from otros where id=$otros_id");
	$direccion = sqlValue("select direccion from otros where id=$otros_id");
	$barrio = sqlValue("select barrio from otros where id=$otros_id");
	$poblacion = sqlValue("select poblacion from otros where id=$otros_id");
	$regimen = sqlValue("select regimen from otros where id=$otros_id");
	$eapb = sqlValue("select eapb from otros where id=$otros_id");
	$gerente = sqlValue("select gerente from eps where razonsocial='$eapb'");
	$acudiente = sqlValue("select acudiente from otros where id=$otros_id");
	if ($acudiente==1){
		$nombreacu = sqlValue("select nombreacu from otros where id=$otros_id");
		$docacu = sqlValue("select docacu from otros where id=$otros_id");
	}else{
		$nombreacu = "";
		$docacu = "";
	}
	$asignado = sqlValue("select asignado from otros where id=$otros_id");
	$emailuser = sqlValue("select email from membership_users where custom1='$asignado'");
	$cargo = sqlValue("select custom2 from membership_users where custom1='$asignado'");
	$descripcion = sqlValue("select descripcion from otros where id=$otros_id");
	 function actual_date()  
	{  
		$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
		$year_now = date ("Y");  
		$month_now = date ("n");  
		$day_now = date ("j");    
		$date = $day_now . " de " . $months[$month_now] . " de " . $year_now;   
		return $date;    
	}  
	 
	$date=actual_date();

?>


<table width="100%" border="1">
  <tbody>
    <tr bgcolor="#B3ACAC">
      <td width="50%" bgcolor="#B3ACAC" height="24" valign="middle"><p><strong style="font-size: large; color: #000000;">Boleta de Remisión No. <?php echo "$otros_id"?></strong></p></td>
      <td width="50%" valign="middle"><p><strong style="font-size: large; color: #000000;">Fecha: <?php echo "$date"?></strong></p></td>
    </tr>
  </tbody>
</table><br>
<div class="logo" id="logo" style="text-align: center"><img src="remisioin.jpg" width="120" height="59" alt=""/><br>
	 
<br>

</div>
<table width="100%" border="1">

    <tr align="center" bgcolor="#E5E0E0">
      <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">USUARIO</strong></td>
  </tr>

</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="100%" height="173" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>TIPO DE DOCUMENTO</strong>: <?php echo "$tipodoc"?>   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> <?php echo "$documento"?><br>
		  				<strong>NOMBRE(S)</strong>: <?php echo "$nombres"?> &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> <?php echo "$apellidos"?><br>
		  				<strong>SEXO</strong>: <?php echo "$sexo"?>&ensp;  &ensp; &ensp; &ensp;<strong>EDAD</strong>:</strong> <?php echo "$edad"?>&ensp;  &ensp; &ensp; &ensp;<strong>TELEFONO:</strong> </strong><?php echo "$telefono"?>
		  				<br><strong>DIRECCION</strong>: <?php echo "$direccion"?>&ensp;  &ensp; &ensp; &ensp;<strong>BARRIO</strong>:</strong> <?php echo "$barrio"?><br>
		  				<strong>TIPO DE REGIMEN</strong>: <?php echo "$regimen"?>&ensp;  &ensp; &ensp; &ensp;<strong>TIPO DE POBLACION</strong>:</strong> <?php echo "$poblacion"?><br>
		  				<strong>ENTIDAD ADMINISTRADORA DEL PLAN DE BENEFICIOS EAPB</strong>: <?php echo "$eapb"?><br>
		  				<strong>Nombre del Acudiente (si es diferente al usuario)</strong>: <?php echo "$nombreacu"?><br>
		  				<strong>Cedula del acudiente</strong>: <?php echo "$docacu"?></span>
      </p>
    </tr>
  </tbody>
</table>
<br>
<table width="100%" border="1">
  <tr align="center" bgcolor="#E5E0E0">
    <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">GENERALIDADES DE LA REMISIÓN</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td colspan="2" valign="top" style="text-align: justify; color: #000000;"><p><span style="color: #000000; font-size: small;"><strong>DOCTORA</strong>:<br> <?php echo "$gerente"?> <strong> &ensp;  &ensp; &ensp; &ensp;</strong><br>
          <strong>GERENTE</strong>: <?php echo "$eapb"?> &ensp;&ensp;&ensp;&ensp;<br>
          <strong>Cúcuta</strong></span></p>
        <p>Me permito Remitir a este usuario (a) ya  que no se le ha prestado la atención necesaria.<br>
El día <?php echo "$fecha"?>, (la) usuario (a) manifiestó requerir <strong><?php echo "$asunto"?>. Con el siguiente detalle: <?php echo "$descripcion"?>.</strong></p>
        <p>Por tal razón agradezco hacer efectiva  la intervención de la oficina que usted dirige y garantizar el derecho a la  salud.<br>
      Por favor comunicar de lo actuado al  correo electrónico <a href="mailto:saludcucuta.sac@gmail.com">saludcucuta.sac@gmail.com</a> y <a href="mailto:pasocucuta@gmail.com">pasocucuta@gmail.com</a> citando el nombre del usuario.      </p></tr>
    <tr>
      <td width="50%" valign="top"><p><strong style="color: #000000; font-size: small;">Firma del Usuario:</strong></p>
        <p>&nbsp;</p>
        <p><span style="color: #000000"><strong> __________________________________________ </strong><br>
    <strong>C.C ______________________________________</strong></span></p>          
      <td width="50%" valign="bottom" style="text-align: right; font-size: x-small; color: #000000;">Nombre y cargo del Funcionario de la SSM             
    </tr>
    <tr>
      <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><p>Proyectó: <?php echo "$asignado"?> - <?php echo "$cargo"?>  <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>Correo E. <?php echo "$emailuser"?></p>
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

<?php
// Require composer autoload
require_once __DIR__ . '/MPDF/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Buffer the following html with PHP so we can store it to a variable later
ob_start();

$html = '<div id="printable"><header><center><img src="rotulo.png" alt="" width="940" align="absmiddle"/></center></header>
		
		<table width="100%" border="1">
  <tbody>
    <tr bgcolor="#B3ACAC">
      <td width="50%" bgcolor="#B3ACAC" height="24" valign="middle"><p><strong style="font-size: large; color: #000000;">Boleta de Remisión No. ' . $otros_id . '</strong></p></td>
      <td width="50%" valign="middle"><p><strong style="font-size: large; color: #000000;">Fecha: ' . $date . '</strong></p></td>
    </tr>
  </tbody>
</table><br>
<div class="logo" id="logo" style="text-align: center"><img src="remisioin.jpg" width="120" height="59" alt=""/><br>

<table width="100%" border="1">

    <tr align="center" bgcolor="#E5E0E0">
      <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">USUARIO</strong></td>
  </tr>

</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="100%" height="173" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>TIPO DE DOCUMENTO</strong>: ' . $tipodoc . '  <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> ' . $documento . '<br>
		  				<strong>NOMBRE(S)</strong>: ' . $nombres . ' &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> ' . $apellidos . '<br>
		  				<strong>SEXO</strong>: ' . $sexo . '&ensp;  &ensp; &ensp; &ensp;<strong>EDAD</strong>:</strong> ' . $edad . '&ensp;  &ensp; &ensp; &ensp;<strong>TELEFONO:</strong> </strong>' . $telefono . '
		  				<br><strong>DIRECCION</strong>: ' . $direccion . '&ensp;  &ensp; &ensp; &ensp;<strong>BARRIO</strong>:</strong> ' . $barrio . '<br>
		  				<strong>TIPO DE REGIMEN</strong>: ' . $regimen . '&ensp;  &ensp; &ensp; &ensp;<strong>TIPO DE POBLACION</strong>:</strong> ' . $poblacion . '<br>
		  				<strong>ENTIDAD ADMINISTRADORA DEL PLAN DE BENEFICIOS EAPB</strong>: ' . $eapb . '<br>
		  				<strong>Nombre del Acudiente (si es diferente al usuario)</strong>: ' . $nombreacu . '<br>
		  				<strong>Cedula del acudiente</strong>: ' . $docacu . '</span>
      </p>
    </tr>
  </tbody>
</table>
<table width="100%" border="1">
  <tr align="center" bgcolor="#E5E0E0">
    <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">GENERALIDADES DE LA REMISIÓN</strong></td>
  </tr>
</table>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td colspan="2" valign="top" style="text-align: justify; color: #000000;"><p><span style="color: #000000; font-size: small;"><strong>DOCTORA</strong>:<br> ' . $gerente . ' <strong> &ensp;  &ensp; &ensp; &ensp;</strong><br>
          <strong>GERENTE</strong>: ' . $eapb . ' &ensp;&ensp;&ensp;&ensp;<br>
          <strong>Cúcuta</strong></span></p><br>
        <p>Me permito Remitir a este usuario (a) ya  que no se le ha prestado la atención necesaria.<br>
El día ' . $fecha . ', (la) usuario (a) manifiestó requerir <strong>' . $asunto . '. Con el siguiente detalle: ' . $descripcion . '.</strong></p><br>
        <p>Por tal razón agradezco hacer efectiva  la intervención de la oficina que usted dirige y garantizar el derecho a la  salud.<br><br>
      Por favor comunicar de lo actuado al  correo electrónico <a href="mailto:saludcucuta.sac@gmail.com">saludcucuta.sac@gmail.com</a> y <a href="mailto:pasocucuta@gmail.com">pasocucuta@gmail.com</a> citando el nombre del usuario.      </p></tr><br>
    <tr>
      <td width="50%" valign="top"><p><strong style="color: #000000; font-size: small;">Firma del Usuario:</strong></p><br><br>
        <p>&nbsp;</p>
        <p><span style="color: #000000"><strong> __________________________________________ </strong><br>
    <strong>C.C ______________________________________</strong></span></p>          
      <td width="50%" valign="bottom" style="text-align: right; font-size: x-small; color: #000000;">Nombre y cargo del Funcionario de la SSM             
    </tr>
    <tr>
      <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><p>Proyectó: ' . $asignado . ' - ' . $cargo . '  <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>Correo E. ' . $emailuser . '</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>  
      </tr>
  </tbody>
</table>

<footer><div class="logo" id="logo" style="text-align: center"><img src="footer.png" width="598" alt=""/></div><br></footer>
</form>
</div>';

		// send the captured HTML from the output buffer to the mPDF class for processing
		$mpdf->WriteHTML($html);
		$pdfFilePath = "Remision_No.$otros_id.pdf";
		$mpdf->Output("./documentos/REMISIONES/".$pdfFilePath, "F");



?>