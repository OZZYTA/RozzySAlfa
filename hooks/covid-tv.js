function change_to_notplayable(covid, ids){

	var url = 'change-status.php?table=' + covid + '&status=No Encuestado';
	for(var i = 0; i < ids.length; i++){
		url = url + '&' 
			+ encodeURI('ids[]') + '=' 
			+ encodeURIComponent(ids[i]);
	}
		window.open(url,'_self');

}


