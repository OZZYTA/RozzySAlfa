<script>
$j(function(){
	$j('.page-header > h1').find('a').contents().unwrap()	;
	$j('#deselect').hide();
	$j('#soportes_link').hide();
})
</script>
<script>
function get_date(date_field){
	var y = $j('#' + date_field).val();
	var m = $j('#' + date_field + '-mm').val();
	var d = $j('#' + date_field + '-dd').val();
	
	var date_object = new Date(y, m - 1, d);
	
	if(!y) return false;
	
	return date_object;
}
</script>
<script>
		$j('.pqr-dias').each(function(){
			var dias =$j(this).text()
				if(dias>6){
				$j(this).parents('tr').addClass('danger');	
					}
				});
			 ;
		

		
</script>

<script>
		$j('.pqr-condicion').ready(function(){
			if($j('.pqr-dias').parents('tr').hasClass( "danger" )){
				modal_window({
					message: 'Cuenta con PQR abiertas resaltadas en rojo, esto quiere decir que han superado su tiempo reglamentario para resolucion, por favor dar prioridad en gestion.',
					title: 'PQR Abiertas resaltadas',
					footer: [{
						label: 'Cerrar',
						bs_class: 'default'
					}]
				});
			} ;
		
		}) 
		
</script>


<script>_noShortcutsReference = true;</script>
