$j(function() {
	$j("#dvprint").hide();	
	$j("#selected_records_print_multiple_dv_sdv").hide();
	$j('#oficio').prop('readonly', true);
	$j('#consecutivo').prop('readonly', true);
	if ($j("#oficio").val()==""){
		$j('#oficio').parents('.form-group').hide();
		$j('#consecutivo').parents('.form-group').hide();
		$j("#sac").prop( "checked", false );
		$j('#sac').click(function(){
         if($j(this).prop('checked')){
			modal_window({
					message: '¿Está seguro?   Recuerde que si selecciona esta opción, se generará un numero de oficio y consecutivo, valores que no serán reversibles ni podrán ser corregidos en caso de error.',
					title: 'PQR SAC',
					footer: [{
						label: 'Cerrar',
						bs_class: 'default'
					}]
				});
            $j('#oficio').parents('.form-group').show();
		    $j('#consecutivo').parents('.form-group').show();
			$j.ajax({
				url: 'hooks/ajax-file.php',
				data: {},
				success: function(data){
				var ofi= data;
				$j('#consecutivo').val(ofi)
				var ofi=$j('#consecutivo').val();
				var today = new Date();
				var dd = String(today.getDate()).padStart(2, '0');
				var mm = String(today.getMonth() + 1).padStart(2, '0'); 
				var yyyy = today.getFullYear();
				today =yyyy+mm+dd;
				var num=today+"-"+ofi+"-SSM";
				$j('#oficio').val(num);
				}
				});
         }else{
             /* show some stuff */
			$j('#oficio').parents('.form-group').hide();
		    $j('#consecutivo').parents('.form-group').hide();
			$j("#oficio").val("");
			$j("#consecutivo").val("");
         }
    });
		
		
		
	}else{
		$j('#oficio').parents('.form-group').show();
		$j('#consecutivo').parents('.form-group').show();
	}
});




$j(function() {
if($j('[name=SelectedID]').val().length) {
$j('#fieldname').prop('readonly', true);
}

})



$j(function() { 
        var selected_id = $j('[name=SelectedID]').val();
	$j('#Item_dv_action_buttons .btn-toolbar').append(
		'<p></p><div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
			'<button type="button" class="btn btn-default btn-lg" onclick="create_pdf()">' +
			'<i class="glyphicon glyphicon-print"></i> Create PDF</button>' +
		'</div>'
	);
});

$j(function() { 
$j('#printcierre').hide();
if($j('#condicion').val()=='CERRADA'){
             /* hide some stuff */
			 $j('#printcierre').show();
         }else{
			 $j('#printcierre').hide();

         }
});


$j(function(){
	$j("label[for='s2id_autogen2']").parent().hide();
    $j('#tipoid').click(function(){
         if ($j('#tipoid').val()=="Extranjero"){
             /* hide some stuff */
             $j("label[for='s2id_autogen2']").parent().show();
			 $j("label[for='s2id_autogen2']").focus().select();
			 $j('#procedencia').val("")
         }else{
             /* show some stuff */
             $j("label[for='s2id_autogen2']").parent().hide();
			 $j('#procedencia').val("Colombia")
         }
    });
});


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

$j(function(){
$j('#otraeps').parents('.form-group').hide();
	$j('#eps-container').on('click',function(){
		if($j('#eps').val()=="OTRA (Otros Municipios)" || $j('#eps').val()=="OTRO (Otros Municipios)"){
			$j('#gerente').parents('.form-group').hide();
			$j('#otraeps').parents('.form-group').show();
			$j('#otraeps').focus().select();
			} 
			else if ($j('#eps').val()=="NINGUNA"){
				$j('#gerente').parents('.form-group').hide();
				$j('#otraeps').parents('.form-group').hide();
				$j('#regimen').parents('.form-group').hide();
			}
			else {
					$j('#gerente').parents('.form-group').show();
					$j('#otraeps').parents('.form-group').hide();
					$j('#regimen').parents('.form-group').show();
				}
			}
		);
	}
);


$j(function(){
	$j('#docacudiente').prop('readonly', true);
	$j('#nombreacu').prop('readonly', true);
    $j('#acudiente').click(function(){
         if($j(this).prop('checked')){
             $j('#docacudiente').prop('readonly', false);
			 $j('#nombreacu').prop('readonly', false);
			 $j('#nombreacu').val('');
			 $j('#docacudiente').val('');
         }else{
             /* show some stuff */
             $j('#docacudiente').prop('readonly', true);
			 $j('#nombreacu').prop('readonly', true);
			 $j('#nombreacu').val('');
			 $j('#docacudiente').val('');
         }
    });
});

$j(function(){
    $j('#notel').click(function(){
         if($j(this).prop('checked')){
			 var tel="NO TIENE";
			 $j('#telefono').val(tel);
             $j('#telefono').prop('readonly', true);
         }else{
             /* show some stuff */
			 var tel="";
			 $j('#telefono').val(tel);
             $j('#telefono').prop('readonly', false);
         }
    });
});



$j(function(){
    $j('#nocorreo').click(function(){
         if($j(this).prop('checked')){
			 var correo="NO TIENE";
			 $j('#correo').val(correo);
             $j('#correo').prop('readonly', true);
         }else{
             /* show some stuff */
			 var correo="";
			 $j('#correo').val(correo);
             $j('#correo').prop('readonly', false);
         }
    });
});


$j(function(){
	$j("label[for='s2id_autogen6']").parent().hide();
    $j('#patologia').click(function(){
         if($j(this).prop('checked')){
             /* hide some stuff */
             $j("label[for='s2id_autogen6']").parent().show();
         }else{
             /* show some stuff */
             $j("label[for='s2id_autogen6']").parent().hide();
         }
    });
});

$j(function(){
	$j('#edad').prop('readonly', true);

	$j('#naciemiento-dd, #nacimiento-mm, #nacimiento').change(function(){
		var dob = get_date('nacimiento');
		var today = new Date();
		var age = Math.floor((today - dob) / 1000 / 60 / 60 / 24 / 365.25);
		
		$j('#edad').val(age);
	});
	
	$j('#nacimiento').change();
});

$j(function(){
$j('#fecha1').prop('readonly', true);
$j('#fecha1').parents('.form-group').hide();
$j('#fecha2').prop('readonly', true);
$j('#fecha2').parents('.form-group').hide();
$j('#fecha3').prop('readonly', true);
$j('#fecha3').parents('.form-group').hide();
$j('#conclusion').parents('.form-group').hide();
    $j('#condicion').click(function(){
		if($j('#condicion').val()=='CERRADA'){
             /* hide some stuff */
			 $j('#printcierre').show();
			 $j('#conclusion').parents('.form-group').show();
			 $j('#conclusion').focus().select();
         }else{
             /* show some stuff */
             $j('#conclusion').parents('.form-group').hide();
			 $j('#printcierre').hide()

         }
    });

});

$j(function(){
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = mm + '/' + dd + '/' + yyyy;
	$j("#detalle1").change(function(){
          $j('#fecha1').parents('.form-group').show();
          $j('#fecha1').val(today);
	});
	$j("#detalle2").change(function(){
          $j('#fecha2').parents('.form-group').show();
          $j('#fecha2').val(today);
	});
	$j("#detalle3").change(function(){
          $j('#fecha3').parents('.form-group').show();
          $j('#fecha3').val(today);
	});
});



$j(function(){
	$j('#update, #insert').click(function(){
	var nombre= $j('#nombres').val();
	var apellido= $j('#apellidos').val();
	var completo=nombre.concat(' ', apellido);
	var documento = $j('#doc').val();
	
	if($j('#condicion').val()=='ABIERTA' && $j('#estado').val()=='RESUELTA' || $j('#condicion').val()=='ABIERTA' && $j('#estado').val()=='NO RESUELTA'){
    return show_error('estado', 'SI LA CONDICION DE LA PQR SIGUE SIENDO ABIERTA, SU ESTADO AUN NO PUEDE CONSIDERARSE RESUELTA O NO RESUELTA');
		}
	else if($j('#tipoid').val()=="Extranjero" && $j('#procedencia').val()=="Colombia" )
	{	
	return show_error('procedencia', 'SI EL TIPO DE DOCUMENTO ES EXTRANJERO LA PROCEDENCIA NO PUEDE SER COLOMBIA.');
	}
	else if($j('#tipoid').val()=="Extranjero" && $j('#procedencia').val()=="" )
	{	
	return show_error('procedencia', 'SI EL TIPO DE DOCUMENTO ES EXTRANJERO EL CAMPO PROCEDENCIA NO PUEDE ESTAR EN BLANCO.');
	}
	else if ($j('#condicion').val()=='CERRADA' && ($j('#estado').val()=='RECEPCIONADA' || $j('#estado').val()=='EN TRAMITE' || $j('#estado').val()=='REMITIDA A EPS' || $j('#estado').val()=='REMITIDA A SUPERSALUD'))
	{
	return show_error('estado', 'RECUERDE QUE SI LA CONDICION DE LA PQR ES CERRADA, SU ESTADO SOLO PUEDE SER RESUELTA O NO RESUELTA');
	}
	else if ($j('#condicion').val()=='CERRADA' && $j('#indicador').val()==='')
	{
	return show_error('indicador', 'RECUERDE QUE SI LA CONDICION DE LA PQR ES CERRADA, DEBE EXISTIR UN INDICADOR DE SATISFACCION');
	}
	else if ($j('#condicion').val()=='ABIERTA' && $j('#indicador').val()!=='')
	{
	return show_error('indicador', 'RECUERDE QUE SI LA CONDICION DE LA PQR ES ABIERTA, AUN NO DEBE EXISTIR UN INDICADOR DE SATISFACCION');
	}
	else if ($j('#acudiente').prop('checked') && $j('#nombreacu').val()=='')
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NOMBRE DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if ($j('#acudiente').prop('checked') && $j('#nombreacu').val()==completo)
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NOMBRE DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if ($j('#acudiente').prop('checked') && $j('#docacudiente').val()=='')
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NUMERO DE IDENTIFICACION DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if (!$j('#acudiente').prop('checked'))
	{
	$j('#nombreacu').val('');
	$j('#nombreacu').val(completo);
	$j('#docacudiente').val(documento);
	}
	
	});

	$j('#update, #insert').click(function(){
		/* Make sure shipped date is today or older, but not older than order date */
		var closedate = get_date('cierre');
		var hoy = new Date();
		var pqrdate = get_date('fechainc');
		var nacimiento = get_date('nacimiento');
		
		if(pqrdate && (pqrdate > hoy)){
			return show_error('fechainc', 'LA FECHA DEL INCIDENTE O SOLICITUD NO DEBE SER FUTURA');
		}
		else if(closedate && (closedate > hoy)){
			return show_error('cierre', 'LA FECHA DE CIERRE DE LA PQR NO DEBE SER FUTURA');
		}
		else if(closedate && (closedate < pqrdate)){
			return show_error('cierre', 'LA FECHA DE CIERRE DE LA PQR NO DEBE SER ANTERIOR A LA FECHA DEL INCIDENTE O SOLICITUD');
		}
		else if($j('#condicion').val()=='CERRADA' && (closedate===false)){
			return show_error('cierre', 'RECUERDE QUE SI LA CONDICION DE LA PQR ES CERRADA, DEBE TENER UNA FECHA DE CIERRE');
		}
		else if($j('#condicion').val()=='ABIERTA' && (closedate!==false)){
			return show_error('cierre', 'RECUERDE QUE SI LA CONDICION DE LA PQR ES ABIERTA, AUN NO DEBE TENER UNA FECHA DE CIERRE');
		}
		else if(nacimiento && (nacimiento > hoy)){
			return show_error('nacimiento', 'LA FECHA DEL NACIMIENTO DEL USUARIO NO DEBE SER FUTURA');
		}
		
		
	});
	
	
	
});
