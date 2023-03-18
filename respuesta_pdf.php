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
 <div id="printable"><header><center><img src="rotulo.png" alt="" width="850" align="absmiddle"/></center></header>

	
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
	$oficio = sqlValue("select oficio from pqr where id=$pqr_id");
	if ($oficio==""){
		$oficio=$consecutivo;
	}
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
	$fecha = date_create($fecha);
	$fecha_format=date_format($fecha,"d-m-Y");

	 
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
	      <td width="750" style="font-size: x-small; color: #000000;"><p><br>
            <span style="color: #000000">San José de Cúcuta, <?php echo "$date"?></span></p>
          <p>&nbsp;</p>
          <p><strong>Señor (a)</strong><br>
              <strong><?php echo "$nombres"?> <?php echo "$apellidos"?></strong><br>
              <strong><?php echo "$direccion"?>                  </strong> <br>
              <strong>Cúcuta </strong></p></td>
        </tr>
	    <tr>
	      <td style="font-size: x-small; color: #000000;"><p align="right"><strong>Asunto: Repuesta  a Queja No. <?php echo "$oficio"?> </strong><br>
	        <strong>Peticionario:</strong> <strong><?php echo "$nombres"?> <?php echo "$apellidos"?></strong><br>
          <strong>Entidad  objeto de la Petición <?php echo "$eps"?></strong></td>
        </tr>
	    <tr>
	      <td style="text-align: justify; font-size: x-small; color: #000000;"> <p>&nbsp;</p>
	        <p>Respetado, Señor (a):&nbsp;<strong><?php echo "$nombres"?> <?php echo "$apellidos"?></strong></p>
          <p>La Secretaria de Salud Municipal de Cúcuta ha recibido su queja el día <strong><?php echo date_format($fecha,"d-m-Y") ?>, </strong> radicada en esta  entidad a través&nbsp;la Oficina Del Servicio de Atención a la Comunidad SAC.<br>
			Para mayor facilidad le informo que la misma&nbsp;quedó  radicada bajo el Número <strong> <?php echo "$oficio"?></strong> de fecha <strong><?php echo date_format($fecha,"d-m-Y") ?>, </strong>en la  cual manifiesta de manera libre y 
			voluntaria la posible vulneración  de&nbsp;sus&nbsp;derechos&nbsp;en&nbsp;salud&nbsp;por&nbsp;indebida&nbsp;atención&nbsp;y/o  por encontrar barreras en la prestación de los servicios de salud  por&nbsp;parte de la entidad objeto de la 
			comunicación.</p>
          <p>A su vez, la Secretaria de Salud Municipal de Cúcuta <strong><em>actuando </em></strong>en el marco de competencias  conferidas en la Ley 715 de 2001, articulo 44, numeral 44.1.3.&rdquo; gestionar  supervisar el acceso a la prestación de los servicios de salud de la población  de su jurisdicción&rdquo;.  Y de conformidad con  lo establecido en el Decreto 780 de 2016 &ldquo;…<strong><em>Sección 1.  Seguimiento y control Artículo 2.6.1.2.1.1 Seguimiento y control del régimen  
		  subsidiado.</em></strong><em> Las entidades territoriales vigilarán permanentemente que las EPS cumplan con  todas sus obligaciones frente a los usuarios. De evidenciarse fallas o incumplimientos  en las obligaciones de las EPS, estas serán objeto de requerimiento por parte  de las entidades territoriales para que subsanen los incumplimientos y de no  hacerlo, remitirán a la Superintendencia Nacional de Salud, los informes  correspondientes. Según lo previsto por la ley, la 
		  vigilancia incluirá el  seguimiento a los procesos de afiliación, el reporte de novedades, la garantía  del acceso a los servicios, la red contratada para la prestación de los  servicios de salud, el suministro de medicamentos, el pago a la red prestadora  de servicios, la satisfacción de los usuarios, la oportunidad en la prestación  de los servicios, la prestación de servicios de promoción y prevención, así  como otros que permitan mejorar la calidad en la atención al afiliado, 
		  sin  perjuicio de las demás obligaciones establecidas en las normas vigentes.</em></p>
          <p>Procede a realizar todas las acciones tendientes para restablecer sus derechos  conculcados; para lo cual le   informo  que su petición ha sido trasladada  a esa entidad, con la instrucción&nbsp;de&nbsp;ser&nbsp;atendida y resuelta  de manera efectiva y darle respuesta escrita, a la dirección física o electrónica aportada por usted, con la mayor inmediatez posible y en todo caso, sin exceder el término de  cinco (5) días hábiles a partir de su recibo.</p>
          <p>En&nbsp;el evento de que la entidad no atienda o no dé  respuesta a su solicitud en los términos indicados,  sírvase&nbsp;informar&nbsp;a esta Secretaria de Salud de Cúcuta citando el  número único de radicación dado a su comunicación.</p>
          <p>Con el traslado a la entidad, se agota el trámite inicial de  su reclamación, sin perjuicio que,  en&nbsp;ejercicio&nbsp;de&nbsp;sus&nbsp;competencias, este&nbsp;ente  territorial, realice las actividades de seguimiento sobre el cumplimiento de  los derechos en&nbsp;salud&nbsp;y la debida atención y protección  al usuario. </p>
          <p>Cordialmente,</p>
          <p>&nbsp;</p>
          <p><strong>&nbsp;</strong></p>
          <p><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong><br>
          Subsecretario de  Aseguramiento y Control en Salud </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
  </tbody>
</table>
<footer><center>
  <p>&nbsp;</p>
  <p><img src="footer.png" alt="" width="650" align="absmiddle"/></p>
</center></footer>
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

$html = ' <div id="printable"><header><center><img src="rotulo.png" alt="" width="850" align="absmiddle"/></center></header>
<table width="100%" border="0">
	  <tbody>
	    <tr>
	      <td width="750" style="font-size: x-small; color: #000000;"><p><br>
            <span style="color: #000000">San José de Cúcuta, ' . $date . '</span></p>
          <p>&nbsp;</p><br><br>
          <p><strong>Señor (a)</strong><br>
              <strong>' . $nombres . ' ' . $apellidos . '</strong><br>
              <strong>' . $direccion . '                  </strong> <br>
              <strong>Cúcuta </strong></p></td><br><br>
        </tr>
	     <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><p></p></tr><tr>
			    <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><strong>Asunto: Repuesta  a Queja No. ' . $oficio . '</strong><br>
                  <strong>Peticionario:</strong> <strong>' . $nombres . ' ' . $apellidos . '</strong><br>
                <strong>Entidad  objeto de la Petición ' . $eps . '</strong>                 
  </tr>
	    <tr>
	      <td style="text-align: justify; font-size: x-small; color: #000000;"> <p>&nbsp;</p>
	        <p>Respetado, Señor (a):&nbsp;<strong>' . $nombres . ' ' . $apellidos . ',</strong></p><br><br>
          <p>La Secretaria de Salud Municipal de Cúcuta ha recibido su queja el día <strong>' . $fecha_format . ', </strong> radicada en esta  entidad a través&nbsp;la Oficina Del Servicio de Atención a la Comunidad SAC.<br><br>
Para mayor facilidad le informo que la misma&nbsp;quedó  radicada bajo el Número <strong> ' . $oficio . '</strong> de fecha <strong>' . $fecha_format . ', </strong>en la  cual manifiesta de manera libre y voluntaria la posible vulneración  de&nbsp;sus&nbsp;derechos&nbsp;en&nbsp;salud&nbsp;por&nbsp;indebida&nbsp;atención&nbsp;y/o  por encontrar barreras en la prestación de los servicios de salud  por&nbsp;parte de la entidad objeto de la comunicación.</p><br>
          <p>A su vez, la Secretaria de Salud Municipal de Cúcuta <strong><em>actuando </em></strong>en el marco de competencias  conferidas en la Ley 715 de 2001, articulo 44, numeral 44.1.3.&rdquo; gestionar  supervisar el acceso a la prestación de los servicios de salud de la población  de su jurisdicción&rdquo;.  Y de conformidad con  lo establecido en el Decreto 780 de 2016 &ldquo;…<strong><em>Sección 1.  Seguimiento y control Artículo 2.6.1.2.1.1 Seguimiento y control del 
		  régimen  subsidiado.</em></strong><em> Las entidades territoriales vigilarán permanentemente que las EPS cumplan con  todas sus obligaciones frente a los usuarios. De evidenciarse fallas o incumplimientos  en las obligaciones de las EPS, estas serán objeto de requerimiento por parte  de las entidades territoriales para que subsanen los incumplimientos y de no  hacerlo, remitirán a la Superintendencia Nacional de Salud, los informes  correspondientes. Según lo previsto por la ley, 
		  la vigilancia incluirá el  seguimiento a los procesos de afiliación, el reporte de novedades, la garantía  del acceso a los servicios, la red contratada para la prestación de los  servicios de salud, el suministro de medicamentos, el pago a la red prestadora  de servicios, la satisfacción de los usuarios, la oportunidad en la prestación  de los servicios, la prestación de servicios de promoción y prevención, así  como otros que permitan mejorar la calidad en la atención al afiliado, 
		  sin  perjuicio de las demás obligaciones establecidas en las normas vigentes.</em></p><br>
          <p>Procede a realizar todas las acciones tendientes para restablecer sus derechos  conculcados; para lo cual le   informo  que su petición ha sido trasladada  a esa entidad, con la instrucción&nbsp;de&nbsp;ser&nbsp;atendida y resuelta  de manera efectiva y darle respuesta escrita, a la dirección física o electrónica aportada por usted, con la mayor inmediatez posible y en todo caso, sin exceder el término de  cinco (5) días hábiles a partir de su recibo.</p><br>
          <p>En&nbsp;el evento de que la entidad no atienda o no dé  respuesta a su solicitud en los términos indicados,  sírvase&nbsp;informar&nbsp;a esta Secretaria de Salud de Cúcuta citando el  número único de radicación dado a su comunicación.</p><br>
          <p>Con el traslado a la entidad, se agota el trámite inicial de  su reclamación, sin perjuicio que,  en&nbsp;ejercicio&nbsp;de&nbsp;sus&nbsp;competencias, este&nbsp;ente  territorial, realice las actividades de seguimiento sobre el cumplimiento de  los derechos en&nbsp;salud&nbsp;y la debida atención y protección  al usuario. </p>
          <br><br><p>Cordialmente,</p>
          <p>&nbsp;</p>
          <p><strong>&nbsp;</strong></p>
          <br><br><p><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong><br>
          Subsecretario de  Aseguramiento y Control en Salud </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
  </tbody>
</table>
<footer><center>
  <p>&nbsp;</p>
  <p><img src="footer.png" alt="" width="650" align="absmiddle"/></p>
</center></footer>
</div>



';

		// send the captured HTML from the output buffer to the mPDF class for processing
		$mpdf->WriteHTML($html);
		$pdfFilePath = "Respuesta_PQR_No.$consecutivo.pdf";
		$mpdf->Output("./documentos/RESPUESTAS/".$pdfFilePath, "F");



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


<tr>
			 