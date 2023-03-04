function change_to_notcontacted(prass, ids){
	var url = 'change-statusprass.php?table=' + prass + '&estado=No Contactado';
	for(var i = 0; i < ids.length; i++){
		url = url + '&' 
			+ encodeURI('ids[]') + '=' 
			+ encodeURIComponent(ids[i]);
	}
	window.open(url,'_self');
}



