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
	<input type="button" onclick="location.href='pqr_view.php';" class="btn btn-primary" class="noprint" id="volver" value="Cancelar">
	<input type="button" onclick="window.print()" class="btn btn-primary" class="noprint" id="volver" value="Imprimir"></right></div>
 <div id="printable"><header><center><img src="rotulo.png" alt="" width="800" align="absmiddle"/></center></header>

	
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
	$conclusion = sqlValue("select conclusion from pqr where id=$pqr_id");
	$estado = sqlValue("select estado from pqr where id=$pqr_id");
	$condicion = sqlValue("select condicion from pqr where id=$pqr_id");
	$indicador = sqlValue("select indicador from pqr where id=$pqr_id");

	 
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
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="750" bgcolor="#E7E4E4" style="font-size: medium; color: #000000; text-align: center;"><p><strong>ACTA DE CIERRE PQR No. <?php echo "$consecutivo"?> &ensp;  &ensp; &ensp; &ensp;Fecha: <?php echo "$date"?></strong></p></td>
    </tr>
  </tbody>
</table><br>
<table width="100%" border="0">
  <tbody>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u style="color: #000000">DATOS  DEL USUARIO:</u></strong></p></td>
    </tr>
    <tr style="font-size: small">
      <td colspan="2"><p><span style="text-align: justify; color: #000000;"><strong>NOMBRE(S)</strong>: <?php echo "$nombres"?> &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> <?php echo "$apellidos"?><br>
          <strong>TIPO DE DOCUMENTO</strong>: <?php echo "$tipoid"?>   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> <?php echo "$documento"?></span><br>
    </tr>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u>GENERALIDADES  DE LA QUEJA</u></strong><u>:</u></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td colspan="2" style="text-align: justify"><p><strong>MOTIVO</strong> <?php echo "$motivo"?><br>
      <strong>FECHA </strong><?php echo "$fecha"?><strong></strong></p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u>DESCRIPCIÓN  DEL TRAMITE:</u></strong></p></td>
    </tr>
    <tr style="text-align: justify; color: #000000; font-size: small;">
      <td colspan="2"><p>Por medio de oficio de solicitud a la  entidad <strong><?php echo "$eps"?>,</strong> sobre la queja  presentada por el (la) Señor (a) mencionada anteriormente donde refiere que &ldquo;<strong><em><?php echo "$descripcion"?>&rdquo;.</em></strong><br>
      </p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u>CONCLUSIÓN  DEL TRAMITE:</u></strong></p></td>
    </tr>
    <tr style="text-align: justify; color: #000000; font-size: small;">
      <td colspan="2"><p>La entidad <strong><?php echo "$eps"?></strong> informo que &ldquo;<strong><?php echo "$conclusion"?>&rdquo;.</em></strong><br>
    </tr>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u>ESTADO:</u></strong></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td colspan="2"><p>Estado de la PQR: <strong><?php echo "$estado"?>.</strong><br>
        Condición de la PQR: <strong><?php echo "$condicion"?>.</strong><br>
      Indicador: <strong><?php echo "$indicador"?>.</strong></p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2"><p align="center"><strong><u>APROBACIÓN:</u></strong></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td width="50%" valign="top" style="text-align: left"><strong>Quejoso                                                                                </strong><br><br><br><br>
        <p>Firma  _____________________________________                          
      <br>CC. _______________________________________                       </td>
      <td width="50%" valign="top" style="text-align: left"><strong>Subsecretario de Aseguramiento y Control en  Salud</strong>      
		<br><br><br><br>
        <p>Firma _____________________________________
      <br><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="text-align: right; color: #000000; font-size: xx-small;"><p>&nbsp;</p>
      <p>Nombre y cargo del Funcionario de la SSM </p></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: right; font-size: xx-small; color: #000000;">Proyectó: <?php echo "$asignado"?> - <?php echo "$cargo"?>  <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>Correo E. <?php echo "$emailuser"?></td>
    </tr>
  </tbody>
</table>
<br>
<footer><center>
  <img src="footer.png" alt="" width="450" height="47" align="absmiddle"/>
</center></footer></div>
<?php
    include_once("$currDir/footer.php");
?>
	 
<?php
// Require composer autoload
require_once __DIR__ . '/MPDF/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Buffer the following html with PHP so we can store it to a variable later
ob_start();

$html = ' <div id="printable"><header><center><img src="rotulo.png" alt="" width="800" align="absmiddle"/></center></header>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="750" bgcolor="#E7E4E4" style="font-size: medium; color: #000000; text-align: center;"><p><strong>ACTA DE CIERRE PQR No. ' . $consecutivo . ' &ensp;  &ensp; &ensp; &ensp;Fecha: ' . $date . '</strong></p></td>
    </tr>
  </tbody>
</table><br>
<table width="100%" border="0">
  <tbody>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u style="color: #000000;">DATOS  DEL USUARIO:</u></strong></p></td>
    </tr>
    <tr style="font-size: small">
      <td colspan="2" style="font-size: x-small"><p><span style="text-align: justify; color: #000000;"><strong>NOMBRE(S)</strong>: ' . $nombres . ' &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> ' . $apellidos . '<br>
          <strong>TIPO DE DOCUMENTO</strong>: ' . $tipoid . '   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> ' . $documento . '</span>      
        <p><br>
    </tr>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>GENERALIDADES  DE LA QUEJA</u></strong><u>:</u></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td colspan="2" style="font-size: x-small"><p><strong>MOTIVO</strong> ' . $motivo . ' <br>
      <strong>FECHA </strong>' . $fecha . ' <strong></strong></p>
      <p>&nbsp;</p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>DESCRIPCIÓN  DEL TRAMITE:</u></strong></p></td>
    </tr>
    <tr style="text-align: justify; color: #000000; font-size: small;"> 
      <td colspan="2" style="font-size: x-small; text-align: justify"><p>Por medio de oficio de solicitud a la  entidad <strong>' . $eps . ' ,</strong> sobre la queja  presentada por el (la) Señor (a) mencionada anteriormente donde refiere que &ldquo;<strong><em>' . $descripcion . ' &rdquo;.</em><br></strong></p>
        <p><br>
      </p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center">&nbsp;</p>
      <p align="center"><strong><u>CONCLUSIÓN  DEL TRAMITE:</u></strong></p></td>
    </tr>
    <tr style="text-align: justify; color: #000000; font-size: small;">
      <td colspan="2" style="font-size: x-small"><p>La entidad <strong>' . $eps . ' </strong> informo que &ldquo;<strong>' . $conclusion . ' &rdquo;.</em></strong>      
        <p><br>
    </tr>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>ESTADO:</u></strong></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td colspan="2" style="font-size: x-small"><p>Estado de la PQR: <strong>' . $estado . ' .</strong><br>
        Condición de la PQR: <strong>' . $condicion . ' .</strong><br>
      Indicador: <strong>' . $indicador . ' .</strong></p>
      <p>&nbsp;</p></td>
    </tr>
    <tr style="color: #000000">
      <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>APROBACIÓN:</u></strong></p></td>
    </tr>
    <tr style="font-size: small; color: #000000;">
      <td width="50%" valign="top" style="font-size: x-small"><p><strong>Quejoso <br><br>                                                                         </strong><br><br>
      </p>
        <p><br>
          <br>
        </p>
        <p>Firma  _____________________________________                          
      <br>CC. _______________________________________                       </td>
      <td width="50%" valign="top" style="font-size: x-small"><p><strong>Subsecretario de Aseguramiento y Control en  Salud</strong>     <br> <br> 
        <br>
      </p>
        <p><br>
          <br><br>
        </p>
        <p>Firma _____________________________________
      <br><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong></td>
    </tr>
    <tr>
      <td style="font-size: x-small">&nbsp;</td>
      <td style="font-size: x-small">&nbsp;</td>
    </tr>
    <tr>
      <td height="85" colspan="2" style="font-size: xx-small; text-align: right;"><p>Nombre y cargo del Funcionario de la SSM:</p>
        <p>&nbsp; </p>
      <p>Proyectó: ' . $asignado . '  - ' . $cargo . '   <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>
      Correo E. ' . $emailuser . ' </p></td>
    </tr>
	
  </tbody>
</table>

<br>
<footer><center>
  <p><span style="text-align: center"></span>&ensp;  &ensp; &ensp; &ensp;&ensp;  &ensp; &ensp; &ensp;<img src="footer.png" alt="" width="550" align="center"></p>
</center></footer>
</div>



';

		// send the captured HTML from the output buffer to the mPDF class for processing
		$mpdf->WriteHTML($html);
		$pdfFilePath = "ActaDeCierre_PQR_No.$consecutivo.pdf";
		$mpdf->Output("./documentos/ACTAS_CIERRE/".$pdfFilePath, "F");



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
