<?php
	/*
	  Including the following files allows us to use many shortcut
	  functions provided by AppGini. Here, we'll be using the
	  following functions:
	    makeSafe()
			protect against malicious SQL injection attacks
		sql()
			connect to the database and execute a SQL query
		db_fetch_assoc()
			same as PHP built-in mysqli_fetch_assoc() function
	*/
	$curr_dir = dirname(__FILE__);
	include("{$curr_dir}/defaultLang.php");
	include("{$curr_dir}/language.php");
	include("{$curr_dir}/lib.php");
	
	/* receive calling parameters */
	$table = $_REQUEST['table'];
	$status = $_REQUEST['status'];
	$ids = $_REQUEST['ids']; /* this is an array of IDs */
	$date=date("Y-m-d");
	$mensaje=" Se realiza llamada el $date pero no se logró contacto con el usuario, telefono erroneo o apagado";
	
	/* a comma-separated list of IDs to use in the query */
	$cs_ids = '';
	foreach($ids as $id){
		$cs_ids .= "'" . makeSafe($id) . "',";
	}
	$cs_ids = substr($cs_ids, 0, -1); /* remove last comma */
	
	/* update records and display a message.  Assume ID is primary key, and status is field to be updated in files table*/
	sql("UPDATE covid SET status ='$status', fecha='$date', observacion='$mensaje' WHERE id in ({$cs_ids}) ", $eo);
	header('Location:' . getenv('HTTP_REFERER'));
    ?>