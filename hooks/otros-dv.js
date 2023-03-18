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
	$j("#printremi").parent().hide();
    $j('#asunto').click(function(){
		if ( $j('#asunto').val()=="Remisión"){
			$j("#printremi").parent().show();
		}
		else{
			$j("#printremi").parent().hide();
		}
	});
});


$j(function(){
$j('#otraeps').parents('.form-group').hide();
	$j('#eapb-container').on('click',function(){
		if($j('#eapb').val()=="OTRA (Otros Municipios)" || $j('#eapb').val()=="OTRO (Otros Municipios)"){
			$j('#otraeps').parents('.form-group').show();
			$j('#otraeps').focus().select();
			} 
			else if ($j('#eps').val()=="NINGUNA"){
				$j('#otraeps').parents('.form-group').hide();
				$j('#regimen').parents('.form-group').hide();
			}
			else {
					$j('#otraeps').parents('.form-group').hide();
					$j('#regimen').parents('.form-group').show();
				}
			}
		);
	}
);


$j(function(){
	$j("label[for='s2id_autogen4']").parent().hide();
    $j('#tipodoc').click(function(){
         if ($j('#tipodoc').val()=="RC"  || $j('#tipodoc').val()=="CC" || $j('#tipodoc').val()=="TI"){
             /* hide some stuff */
              $j("label[for='s2id_autogen4']").parent().hide();
			 $j('#procedencia').val("Colombia");
         }else{
             /* show some stuff */            
			 $j("label[for='s2id_autogen4']").parent().show();
			 $j('#procedencia').val("");
			 $j("label[for='s2id_autogen4']").focus().select();
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
	$j('#docacu').prop('readonly', true);
	$j('#nombreacu').prop('readonly', true);
    $j('#acudiente').click(function(){
         if($j(this).prop('checked')){
             $j('#docacu').prop('readonly', false);
			 $j('#nombreacu').prop('readonly', false);
			 $j('#nombreacu').val('');
			 $j('#docacu').val('');
         }else{
             /* show some stuff */
             $j('#docacu').prop('readonly', true);
			 $j('#nombreacu').prop('readonly', true);
			 $j('#nombreacu').val('');
			 $j('#docacu').val('');
         }
    });
});










$j(function(){
	$j('#update, #insert').click(function(){
	var nombre= $j('#nombres').val();
	var apellido= $j('#apellidos').val();
	var completo=nombre.concat(' ', apellido);
	var documento = $j('#doc').val();
		
		
		
		
	var tipodoc=$j('#tipodoc').val();
	var procedencia=$j('#procedencia').val();
	if(tipodoc=="CE" || tipodoc=="PAS" || tipodoc=="PEP" || tipodoc=="AS" || tipodoc=="SC" || tipodoc=="Otro"){
		if (procedencia==""){	
			return show_error('procedencia', 'RECUERDE DETERMINAR EL PAIS DE PROCEDENCIA.');
	}}
	else if ($j('#acudiente').prop('checked') && $j('#nombreacu').val()=='')
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NOMBRE DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if ($j('#acudiente').prop('checked') && $j('#nombreacu').val()==completo)
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NOMBRE DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if ($j('#acudiente').prop('checked') && $j('#docacu').val()=='')
	{
	return show_error('nombreacu', 'RECUERDE QUE SI LA OPCION "PQR PRESENTADA POR ACUDIENTE" ESTA SELECCIONADA, DEBE DILIGENCIAR UN NUMERO DE IDENTIFICACION DE ACUDIENTE EL CUAL NO DEBE SER IGUAL AL NOMBRE DEL USUARIO QUEJOSO');
	}
	else if (!$j('#acudiente').prop('checked'))
	{
	$j('#nombreacu').val('');
	$j('#nombreacu').val(completo);
	$j('#docacu').val(documento);
	}
	
	});
	
	
	
		$j('#update, #insert').click(function(){
		/* Make sure shipped date is today or older, but not older than order date */
		var closedate = get_date('fechaentrega');
		var hoy = new Date();
		var nacimiento = get_date('nacimiento');
		
		if(closedate && (closedate > hoy)){
			return show_error('cierre', 'LA FECHA DE ENTREGA DEL DOCUMENTO NO DEBE SER FUTURA');
		}
		else if(nacimiento && (nacimiento > hoy)){
			return show_error('nacimiento', 'LA FECHA DEL NACIMIENTO DEL USUARIO NO DEBE SER FUTURA');
		}
	
		
	});
	
	
});