function create_pdf() {
	var template = option.toLowerCase().replace(/\s/g, '_') + ".php";
	window.location = "hooks/includes/pdf/pdf.php?id=" + selected_id;
}

$j(function() { 
        var selected_id = $j('[name=SelectedID]').val();
        
	$j('#Item_dv_action_buttons .btn-toolbar').append(
		'<p></p><div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
			'<button type="button" class="btn btn-default btn-lg" onclick="create_pdf()">' +
			'<i class="glyphicon glyphicon-print"></i> Create PDF</button>' +
		'</div>'
	);
});