

$j(function(){
	$j("label[for='cual']").parent().hide();
    $j('#patologia').click(function(){
         if($j(this).prop('checked')){
             /* hide some stuff */
             $j("label[for='cual']").parent().show();
         }else{
             /* show some stuff */
             $j("label[for='cual']").parent().hide();
         }
    });
});


$j(function(){
$j('#oportunidad').parents('.form-group').hide();
    $j('#medicinageneral').click(function(){
         if($j(this).prop('checked')){
			 $j('#oportunidad').parents('.form-group').show();
         }else{
             /* show some stuff */
			 $j('#oportunidad').parents('.form-group').hide();
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

function get_date(date_field){
	var y = $j('#' + date_field).val();
	var m = $j('#' + date_field + '-mm').val();
	var d = $j('#' + date_field + '-dd').val();
	
	var date_object = new Date(y, m - 1, d);
	
	if(!y) return false;
	
	return date_object;
}

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


	$j('#update, #insert').click(function(){
		/* Make sure shipped date is today or older, but not older than order date */
		var dateaislamiento = get_date('inicioasilamiento');
		var hoy = new Date();
		
		if(dateaislamiento && (dateaislamiento > hoy)){
			return show_error('fechainc', 'LA FECHA DE INICIO DEL AISLAMIENTO NO PUEDE SER FUTURA');
		}
	});

	
	

