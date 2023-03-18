function change_to_notcontacted(pqr, ids){

	var url = 'change-statuspqr.php?table=' + pqr + '&status=No Contactado';
	for(var i = 0; i < ids.length; i++){
		url = url + '&' 
			+ encodeURI('ids[]') + '=' 
			+ encodeURIComponent(ids[i]);
	}
	window.open(url,'_self');
}



