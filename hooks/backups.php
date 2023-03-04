<?php

    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
	
	include_once("$currDir/header.php");
	 /* grant access to all logged users */
	$pqr_from=get_sql_from('pqr');
	$otros_from=get_sql_from('otros');
	$correos_from=get_sql_from('correos');
	if(!$pqr_from) exit(error_message("Acceso denegado!", false));	
 ?>
 
 
 
 
<script>
function show_error(field, msg){
	modal_window({
		message: '<div class="alert alert-danger">' + msg + '</div>',
		title: 'Error en ' + field,
		close: function(){
			$j('#' + field).focus();
			$j('#' + field).parents('.form-group').addClass('has-error');
		}
	});
	
	return false;
}


$j(function() {
$j( "#resConsecutivo" ).click(function() {
  alert( "Aqui eliminaremos todo" );
})    
})


$j(function() {
$j( "#resPQR" ).click(function() {
var fecha1=$j("#fecha1").val();
var fecha2=$j("#fecha2").val();
if (fecha1=="" || fecha2==""){
modal_window({
					message: 'Debe seleccionar una fecha inicial y una fecha final.',
					title: 'Respaldo de PQR',
					footer: [{
						label: 'Cerrar',
						bs_class: 'default'
					}]
				});

}
   else{}
})     
})


$j(function() {
$j( "#resOtros" ).click(function() {
  alert( "Aqui respaldaremos Otros" );
})    
})

$j(function() {
$j( "#resCorreos" ).click(function() {
  alert( "Aqui respaldaremos Correos" );
})    
})


$j(function() {
$j( "#resTotal" ).click(function() {
  alert( "Estas seguro de esto?" );
})    
})
</script>
 
 
 
 
 
 
<html>
<head>
<meta charset="utf-8">
<title>Respaldos y Reinicio</title>
</head>

<body>
<p><h1>RESLPADOS Y REINICIO (Usar con Precaución)</h1></p>
<p>A continuacion encontrará las opciones a respaldar. Cada opción permitira la selección del periodo a descargar en formato .xslx (Excel) asi como los contenidos que se han desarrollado hasta la fecha en formato .pdf.</p>
<table width="100%" border="0" align="center">
  <tbody>
    <tr>
      <td width="50%" bgcolor="#D1D1D1"><h2>PQR</h2></td>
      <td width="50%" bgcolor="#D1D1D1"><h2>OTROS TRAMITES</h2></td>
    </tr>
    <tr valign="middle">
      <td><p>
	  <form class="form-horizontal" action="functions.php" method="post" name="export_pqr"   
                      enctype="multipart/form-data">
        <label for="date">Seleccione Fecha de Inicio:</label>
        <input type="date" name="fecha1" id="fecha1">
      </p>
      <p>
        <label for="date2">Seleccione Fecha Final:</label>
        <input type="date" name="fecha2" id="fecha2">
      </p>
      <p>
        <label for="select">Formato:</label>
        <select name="formato1" id="formato1">
          <option>xlsx</option>
          <option>csv</option>
          <option>sql</option>
        </select>
      </p>
      <p>
        <input type="button" name="export" id="export" value="Descargar" >
      </p>
	   </form>
      <p>Descargar actas, oficios y respuestas generadas en .pdf 
        <input type="button" name="pdfPQR" id="pdfPQR" value="Descargar">
      </p>
      <p>&nbsp;</p></td>
      <td valign="middle"><p>
        <label for="date5">Seleccione Fecha de Inicio:</label>
        <input type="date" name="date4" id="date5">
      </p>
        <p>
          <label for="date6">Seleccione Fecha Final:</label>
          <input type="date" name="date4" id="date6">
        </p>
        <p>
          <label for="select">Formato:</label>
          <select name="select2" id="select">
            <option>xlsx</option>
            <option>csv</option>
            <option>sql</option>
          </select>
        </p>
        <p>
          <input type="button" name="resOtros" id="resOtros" value="Descargar">
      </p>
      <p>Descargar remisiones generadas en .pdf 
        <input type="button" name="pdfOtros" id="pdfOtros" value="Descargar">
      </p>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td bgcolor="#D1D1D1"><h2>CORREOS ENVIADOS</h2></td>
      <td bgcolor="#D1D1D1"><h2>REINICIO CONSECUTIVOS - ANUAL</h2></td>
    </tr>
    <tr valign="middle">
      <td><p>
        <label for="date3">Seleccione Fecha de Inicio:</label>
        <input type="date" name="date3" id="date3">
      </p>
        <p>
          <label for="date4">Seleccione Fecha Final:</label>
          <input type="date" name="date3" id="date4">
        </p>
        <p>
          <label for="select">Formato:</label>
          <select name="select3" id="select">
            <option>xlsx</option>
            <option>csv</option>
            <option>sql</option>
          </select>
        </p>
        <p>
          <input type="button" name="resCorreos" id="resCorreos" value="Descargar">
      </p>
      <p>&nbsp;</p></td>
      <td><p>Terminada la vigencia anual y bajo la necesidad de reiniciar consecutivos, se sugiere hacer respaldos a toda la informacion registrada y reiniciar los numeros de consecutivos en el siguiente botón:</p>
      <p>
        <input type="button" name="resConsecutivo" id="resConsecutivo" value="Reiniciar Consecutivos" >
      </p>
      <p>&nbsp;</p></td>
    </tr>
    <tr bgcolor="#D1D1D1" style="text-align: center">
      <td colspan="2"><p style="text-align: center"><h2>RENICIO TOTAL:</h2><span style="text-align: center"></span></p>
      <p>Esta opción borrará toda la información almacenada en las áreas de PQR, Otros Trámites y Correos enviados. Se sugiere hacer un respaldo previamente.</p>
      <p style="text-align: center">
        <input type="button" name="resTotal" id="resTotal" value="REINICIAR">
      </p>
      <p style="text-align: center">&nbsp;</p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
</html>



<?php
	
include_once("$hooks_dir/../footer.php");?>
