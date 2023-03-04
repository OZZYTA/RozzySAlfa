$j(function(){
	$j('#edad').prop('readonly', true);

	$j('#fechanac-dd, #fechanac-mm, #fechanac').change(function(){
		var dob = get_date('fechanac');
		var today = new Date();
		var age = Math.floor((today - dob) / 1000 / 60 / 60 / 24 / 365.25);
		
		$j('#edad').val(age);
	});
	
	$j('#fechanac').change();
});