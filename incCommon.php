<?php

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		getTableList() -- returns an associative array (tableName => tableData, tableData is array(tableCaption, tableDescription, tableIcon)) of tables accessible by current user
		get_table_groups() -- returns an associative array (table_group => tables_array)
		logInMember() -- checks POST login. If not valid, redirects to index.php, else returns TRUE
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true, [, false]]) -- returns the FROM part of the table view query, with full joins (unless third paramaeter is set to true), optionally skipping permissions if true passed as 2nd param.
		get_joined_record($table, $id[, true]) -- returns assoc array of record values for given PK value of given table, with full joins, optionally skipping permissions if true passed as 3rd param.
		get_defaults($table) -- returns assoc array of table fields as array keys and default values (or empty), excluding automatic values as array values
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) -- applies cascading drop-downs for a lookup field, returns js code to be inserted into the page
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		htmlspecialchars_decode($text) -- inverse of htmlspecialchars()
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
		toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format)
		reIndex(&$arr) -- returns a copy of the given array, with keys replaced by 1-based numeric indices, and values replaced by original keys
		get_embed($provider, $url[, $width, $height, $retrieve]) -- returns embed code for a given url (supported providers: youtube, googlemap)
		check_record_permission($table, $id, $perm = 'view') -- returns true if current user has the specified permission $perm ('view', 'edit' or 'delete') for the given recors, false otherwise
		NavMenus($options) -- returns the HTML code for the top navigation menus. $options is not implemented currently.
		StyleSheet() -- returns the HTML code for included style sheet files to be placed in the <head> section.
		getUploadDir($dir) -- if dir is empty, returns upload dir configured in defaultLang.php, else returns $dir.
		PrepareUploadedFile($FieldName, $MaxSize, $FileTypes='jpg|jpeg|gif|png', $NoRename=false, $dir="") -- validates and moves uploaded file for given $FieldName into the given $dir (or the default one if empty)
		get_home_links($homeLinks, $default_classes, $tgroup) -- process $homeLinks array and return custom links for homepage. Applies $default_classes to links if links have classes defined, and filters links by $tgroup (using '*' matches all table_group values)
		quick_search_html($search_term, $label, $separate_dv = true) -- returns HTML code for the quick search box.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/

	#########################################################

	function getTableList($skip_authentication = false) {
		$arrAccessTables = [];
		$arrTables = [
			/* 'table_name' => ['table caption', 'homepage description', 'icon', 'table group name'] */   
			'pqr' => ['PQR', 'Radique, Consulte y verifique el estado de las PQR', 'resources/table_icons/user_comment.png', 'PQR'],
			'Encuesta' => ['Encuestas de Satisfacci&#243;n', 'Responda una breve encuesta de satisfacci&#243;n para determinar su nivel de satisfacci&#243;n con su EPS', 'resources/table_icons/statistics.png', 'Encuestas'],
			'barrios' => ['Barrios', '', 'resources/table_icons/home_page.png', 'Parametros'],
			'soportes' => ['Soportes', '', 'resources/table_icons/file_extension_dat.png', 'Parametros'],
			'eps' => ['Entidades', '', 'resources/table_icons/building.png', 'Parametros'],
			'motivos' => ['Motivos', '', 'resources/table_icons/color_adjustment.png', 'Parametros'],
			'obmotivos' => ['Observaciones a Motivo', '', 'resources/table_icons/google_custom_search.png', 'Parametros'],
			'cie10' => ['CIE10', '', 'resources/table_icons/pill_go.png', 'Parametros'],
			'ips' => ['IPS', '', 'resources/table_icons/application_home.png', 'Parametros'],
			'mails' => ['Correos Enviados', '', 'resources/table_icons/documents_email.png', 'Parametros'],
			'covid' => ['Encuesta 521', 'Encuesta para evaluaci&#243;n del comportamiento de las EPS en cuanto a la atenci&#243;n brindada a los pacientes pertencientes a los 4 grupos poblaci&#243;n de control segun la Resolucion 521 en su numeral 4, durante el Periodo de Aislamiento preventivo obligatorio.', 'resources/table_icons/health.png', 'Encuestas'],
			'regimenes' => ['Regimenes', '', 'resources/table_icons/shape_ungroup.png', 'Parametros'],
			'otros' => ['Otros Tramites - SAC SSM', '', 'resources/table_icons/motherboard.png', 'Otros Tramites'],
			'prass' => ['Seguimiento PRASS', '', 'resources/table_icons/vcard_add.png', 'Encuestas'],
			'oportunidad' => ['Oportunidad', 'Encuesta para verificaci&#243;n de oportunidad en atenci&#243;n', 'resources/table_icons/time.png', 'Encuestas'],
		];
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				$arrPerm = getTablePermissions($tn);
				if($arrPerm['access']) $arrAccessTables[$tn] = $tc;
			}
		}

		return $arrAccessTables;
	}

	#########################################################

	function get_table_groups($skip_authentication = false) {
		$tables = getTableList($skip_authentication);
		$all_groups = ['PQR', 'Otros Tramites', 'Encuestas', 'Parametros'];

		$groups = [];
		foreach($all_groups as $grp) {
			foreach($tables as $tn => $td) {
				if($td[3] && $td[3] == $grp) $groups[$grp][] = $tn;
				if(!$td[3]) $groups[0][] = $tn;
			}
		}

		return $groups;
	}

	#########################################################

	function getTablePermissions($tn) {
		static $table_permissions = [];
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_grouppermissions` WHERE `groupID`='{$groupID}'", $eo);
		$res_user  = sql("SELECT `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete` FROM `membership_userpermissions`  WHERE LCASE(`memberID`)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)) {
			$table_permissions[$row['tableName']] = [
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			];
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p) {
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']) {
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################

	function get_sql_fields($table_name) {
		$sql_fields = [
			'pqr' => "`pqr`.`id` as 'id', `pqr`.`consecutivo` as 'consecutivo', `pqr`.`oficio` as 'oficio', if(`pqr`.`fecha`,date_format(`pqr`.`fecha`,'%d/%m/%Y'),'') as 'fecha', `pqr`.`tipoid` as 'tipoid', `pqr`.`procedencia` as 'procedencia', `pqr`.`doc` as 'doc', `pqr`.`nombres` as 'nombres', `pqr`.`apellidos` as 'apellidos', `pqr`.`genero` as 'genero', if(`pqr`.`nacimiento`,date_format(`pqr`.`nacimiento`,'%d/%m/%Y'),'') as 'nacimiento', `pqr`.`edad` as 'edad', `pqr`.`direccion` as 'direccion', IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') as 'barrio', `pqr`.`comuna` as 'comuna', `pqr`.`telefono` as 'telefono', `pqr`.`notel` as 'notel', `pqr`.`correo` as 'correo', `pqr`.`nocorreo` as 'nocorreo', `pqr`.`sac` as 'sac', `pqr`.`tipopqr` as 'tipopqr', `pqr`.`poblacion` as 'poblacion', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eps', `pqr`.`otraeps` as 'otraeps', IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') as 'gerente', IF(    CHAR_LENGTH(`eps1`.`telefono`), CONCAT_WS('',   `eps1`.`telefono`), '') as 'teleps', IF(    CHAR_LENGTH(`eps1`.`correo`), CONCAT_WS('',   `eps1`.`correo`), '') as 'maileps', IF(    CHAR_LENGTH(`eps2`.`correo2`), CONCAT_WS('',   `eps2`.`correo2`), '') as 'cc2', IF(    CHAR_LENGTH(`eps3`.`correo3`), CONCAT_WS('',   `eps3`.`correo3`), '') as 'cc3', `pqr`.`acudiente` as 'acudiente', `pqr`.`nombreacu` as 'nombreacu', `pqr`.`docacudiente` as 'docacudiente', `pqr`.`ref` as 'ref', IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') as 'motivo', IF(    CHAR_LENGTH(`obmotivos1`.`observacion`), CONCAT_WS('',   `obmotivos1`.`observacion`), '') as 'obmotivo', if(`pqr`.`fechainc`,date_format(`pqr`.`fechainc`,'%d/%m/%Y'),'') as 'fechainc', IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') as 'servicio', IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') as 'enfermedad', `pqr`.`descripcie10` as 'descripcie10', `pqr`.`descripcion` as 'descripcion', `pqr`.`estado` as 'estado', `pqr`.`condicion` as 'condicion', if(`pqr`.`cierre`,date_format(`pqr`.`cierre`,'%d/%m/%Y'),'') as 'cierre', `pqr`.`conclusion` as 'conclusion', `pqr`.`dias` as 'dias', `pqr`.`diascierre` as 'diascierre', `pqr`.`indicador` as 'indicador', `pqr`.`detalle1` as 'detalle1', `pqr`.`fecha1` as 'fecha1', `pqr`.`detalle2` as 'detalle2', `pqr`.`fecha2` as 'fecha2', `pqr`.`detalle3` as 'detalle3', `pqr`.`fecha3` as 'fecha3', `pqr`.`detalle4` as 'detalle4', `pqr`.`fallecido` as 'fallecido', `pqr`.`status` as 'status', `pqr`.`periodo` as 'periodo', `pqr`.`asignado` as 'asignado', `pqr`.`ingresada` as 'ingresada', `pqr`.`cargada` as 'cargada', `pqr`.`emailuser` as 'emailuser', `pqr`.`observaciones` as 'observaciones'",
			'Encuesta' => "`Encuesta`.`id` as 'id', if(`Encuesta`.`fecha`,date_format(`Encuesta`.`fecha`,'%d/%m/%Y'),'') as 'fecha', `Encuesta`.`tipoid` as 'tipoid', `Encuesta`.`doc` as 'doc', `Encuesta`.`nombres` as 'nombres', `Encuesta`.`apellidos` as 'apellidos', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eps', IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') as 'ipsprim', `Encuesta`.`tratoser` as 'tratoser', `Encuesta`.`cita` as 'cita', `Encuesta`.`tratoasis` as 'tratoasis', `Encuesta`.`expprof` as 'expprof', `Encuesta`.`bioser` as 'bioser', `Encuesta`.`area` as 'area', `Encuesta`.`pyp` as 'pyp', `Encuesta`.`prenatal` as 'prenatal', `Encuesta`.`cyd` as 'cyd', `Encuesta`.`vacunas` as 'vacunas', `Encuesta`.`pfm` as 'pfm', `Encuesta`.`citologia` as 'citologia', `Encuesta`.`sservicio` as 'sservicio', `Encuesta`.`incomodo` as 'incomodo', `Encuesta`.`otro` as 'otro', `Encuesta`.`why` as 'why', `Encuesta`.`urgencia` as 'urgencia', `Encuesta`.`citaoportuna` as 'citaoportuna', `Encuesta`.`aspectoeps` as 'aspectoeps', `Encuesta`.`fisicas` as 'fisicas', `Encuesta`.`aseo` as 'aseo', `Encuesta`.`capacitacion` as 'capacitacion', `Encuesta`.`autorizaciones` as 'autorizaciones', `Encuesta`.`general` as 'general', `Encuesta`.`horario` as 'horario', `Encuesta`.`formulario` as 'formulario', `Encuesta`.`farmacia` as 'farmacia', `Encuesta`.`fisicasfarma` as 'fisicasfarma', `Encuesta`.`oporfarmacia` as 'oporfarmacia', `Encuesta`.`totalidad` as 'totalidad', `Encuesta`.`cambio` as 'cambio', `Encuesta`.`volver` as 'volver', `Encuesta`.`orientacion` as 'orientacion', `Encuesta`.`embalaje` as 'embalaje', `Encuesta`.`revision` as 'revision', `Encuesta`.`observaciones` as 'observaciones', `Encuesta`.`user` as 'user'",
			'barrios' => "`barrios`.`nombre` as 'nombre', `barrios`.`comuna` as 'comuna'",
			'soportes' => "`soportes`.`id` as 'id', IF(    CHAR_LENGTH(`pqr1`.`doc`), CONCAT_WS('',   `pqr1`.`doc`), '') as 'doc', `soportes`.`soporte1` as 'soporte1', `soportes`.`soporte2` as 'soporte2', `soportes`.`soporte3` as 'soporte3', `soportes`.`soporte4` as 'soporte4'",
			'eps' => "`eps`.`razonsocial` as 'razonsocial', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', `eps`.`gerente` as 'gerente', `eps`.`telefono` as 'telefono', `eps`.`correo` as 'correo', `eps`.`correo2` as 'correo2', `eps`.`correo3` as 'correo3'",
			'motivos' => "`motivos`.`motivo` as 'motivo'",
			'obmotivos' => "IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') as 'motivo', `obmotivos`.`observacion` as 'observacion'",
			'cie10' => "`cie10`.`cie10` as 'cie10', `cie10`.`descripcion` as 'descripcion'",
			'ips' => "`ips`.`nombre` as 'nombre', `ips`.`municipio` as 'municipio', `ips`.`correo` as 'correo', `ips`.`direccion` as 'direccion', `ips`.`telefono` as 'telefono', `ips`.`gerente` as 'gerente'",
			'mails' => "`mails`.`id` as 'id', `mails`.`idpqr` as 'idpqr', `mails`.`fecha` as 'fecha', `mails`.`eps` as 'eps', `mails`.`correo` as 'correo', `mails`.`asunto` as 'asunto', `mails`.`cuerpo` as 'cuerpo', `mails`.`user` as 'user', `mails`.`groupID` as 'groupID'",
			'covid' => "`covid`.`id` as 'id', if(`covid`.`fecha`,date_format(`covid`.`fecha`,'%d/%m/%Y'),'') as 'fecha', `covid`.`tipodoc` as 'tipodoc', `covid`.`doc` as 'doc', `covid`.`nombre` as 'nombre', `covid`.`genero` as 'genero', if(`covid`.`nacimiento`,date_format(`covid`.`nacimiento`,'%d/%m/%Y'),'') as 'nacimiento', `covid`.`edad` as 'edad', `covid`.`telefono` as 'telefono', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eps', `covid`.`embarazo` as 'embarazo', `covid`.`patologia` as 'patologia', `covid`.`fallecido` as 'fallecido', IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') as 'cual', `covid`.`atencion` as 'atencion', `covid`.`tratamiento` as 'tratamiento', `covid`.`medicamentos` as 'medicamentos', `covid`.`vigilancia` as 'vigilancia', `covid`.`percepcion` as 'percepcion', `covid`.`medicinageneral` as 'medicinageneral', `covid`.`oportunidad` as 'oportunidad', `covid`.`observacion` as 'observacion', `covid`.`status` as 'status', `covid`.`responsable` as 'responsable', `covid`.`periodo` as 'periodo', `covid`.`asignado` as 'asignado'",
			'regimenes' => "`regimenes`.`nombre` as 'nombre'",
			'otros' => "`otros`.`id` as 'id', if(`otros`.`fecha`,date_format(`otros`.`fecha`,'%d/%m/%Y'),'') as 'fecha', `otros`.`asunto` as 'asunto', `otros`.`sexo` as 'sexo', `otros`.`tipodoc` as 'tipodoc', `otros`.`procedencia` as 'procedencia', `otros`.`documento` as 'documento', `otros`.`nombres` as 'nombres', `otros`.`apellidos` as 'apellidos', if(`otros`.`nacimiento`,date_format(`otros`.`nacimiento`,'%d/%m/%Y'),'') as 'nacimiento', `otros`.`edad` as 'edad', `otros`.`direccion` as 'direccion', IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') as 'barrio', `otros`.`comuna` as 'comuna', `otros`.`telefono` as 'telefono', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eapb', `otros`.`otraeps` as 'otraeps', IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') as 'gerente', `otros`.`poblacion` as 'poblacion', `otros`.`acudiente` as 'acudiente', `otros`.`docacu` as 'docacu', `otros`.`nombreacu` as 'nombreacu', `otros`.`descripcion` as 'descripcion', if(`otros`.`fechaentrega`,date_format(`otros`.`fechaentrega`,'%d/%m/%Y'),'') as 'fechaentrega', `otros`.`soporte1` as 'soporte1', `otros`.`soporte2` as 'soporte2', `otros`.`soporte3` as 'soporte3', `otros`.`asignado` as 'asignado', `otros`.`cargo` as 'cargo'",
			'prass' => "`prass`.`id` as 'id', if(`prass`.`fecha`,date_format(`prass`.`fecha`,'%d/%m/%Y'),'') as 'fecha', `prass`.`documento` as 'documento', `prass`.`nombrepaciente` as 'nombrepaciente', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eps', `prass`.`direccion` as 'direccion', `prass`.`telefono` as 'telefono', `prass`.`consulta` as 'consulta', if(`prass`.`fechaconsulta`,date_format(`prass`.`fechaconsulta`,'%d/%m/%Y'),'') as 'fechaconsulta', `prass`.`prueba` as 'prueba', if(`prass`.`fechaprueba`,date_format(`prass`.`fechaprueba`,'%d/%m/%Y'),'') as 'fechaprueba', `prass`.`estado` as 'estado', `prass`.`observacion` as 'observacion', `prass`.`encargado` as 'encargado'",
			'oportunidad' => "`oportunidad`.`id` as 'id', `oportunidad`.`tipodoc` as 'tipodoc', `oportunidad`.`doc` as 'doc', `oportunidad`.`nombres` as 'nombres', `oportunidad`.`apellidos` as 'apellidos', IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') as 'regimen', IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') as 'eps', if(`oportunidad`.`fechanac`,date_format(`oportunidad`.`fechanac`,'%d/%m/%Y'),'') as 'fechanac', `oportunidad`.`edad` as 'edad', `oportunidad`.`atencionreq` as 'atencionreq', if(`oportunidad`.`fechaorden`,date_format(`oportunidad`.`fechaorden`,'%d/%m/%Y'),'') as 'fechaorden', if(`oportunidad`.`fechacita`,date_format(`oportunidad`.`fechacita`,'%d/%m/%Y'),'') as 'fechacita', `oportunidad`.`calificacion` as 'calificacion', `oportunidad`.`observaciones` as 'observaciones', `oportunidad`.`asignado` as 'asignado'",
		];

		if(isset($sql_fields[$table_name])) return $sql_fields[$table_name];

		return false;
	}

	#########################################################

	function get_sql_from($table_name, $skip_permissions = false, $skip_joins = false, $lower_permissions = false) {
		$sql_from = [
			'pqr' => "`pqr` LEFT JOIN `barrios` as barrios1 ON `barrios1`.`nombre`=`pqr`.`barrio` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`pqr`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`pqr`.`eps` LEFT JOIN `eps` as eps2 ON `eps2`.`razonsocial`=`pqr`.`cc2` LEFT JOIN `eps` as eps3 ON `eps3`.`razonsocial`=`pqr`.`cc3` LEFT JOIN `motivos` as motivos1 ON `motivos1`.`motivo`=`pqr`.`motivo` LEFT JOIN `obmotivos` as obmotivos1 ON `obmotivos1`.`observacion`=`pqr`.`obmotivo` LEFT JOIN `ips` as ips1 ON `ips1`.`nombre`=`pqr`.`servicio` LEFT JOIN `cie10` as cie101 ON `cie101`.`cie10`=`pqr`.`enfermedad` ",
			'Encuesta' => "`Encuesta` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`Encuesta`.`eps` LEFT JOIN `ips` as ips1 ON `ips1`.`nombre`=`Encuesta`.`ipsprim` ",
			'barrios' => "`barrios` ",
			'soportes' => "`soportes` LEFT JOIN `pqr` as pqr1 ON `pqr1`.`id`=`soportes`.`doc` ",
			'eps' => "`eps` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`eps`.`regimen` ",
			'motivos' => "`motivos` ",
			'obmotivos' => "`obmotivos` LEFT JOIN `motivos` as motivos1 ON `motivos1`.`motivo`=`obmotivos`.`motivo` ",
			'cie10' => "`cie10` ",
			'ips' => "`ips` ",
			'mails' => "`mails` ",
			'covid' => "`covid` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`covid`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`covid`.`eps` LEFT JOIN `cie10` as cie101 ON `cie101`.`cie10`=`covid`.`cual` ",
			'regimenes' => "`regimenes` ",
			'otros' => "`otros` LEFT JOIN `barrios` as barrios1 ON `barrios1`.`nombre`=`otros`.`barrio` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`otros`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`otros`.`eapb` ",
			'prass' => "`prass` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`prass`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`prass`.`eps` ",
			'oportunidad' => "`oportunidad` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`oportunidad`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`oportunidad`.`eps` ",
		];

		$pkey = [
			'pqr' => 'id',
			'Encuesta' => 'id',
			'barrios' => 'nombre',
			'soportes' => 'id',
			'eps' => 'razonsocial',
			'motivos' => 'motivo',
			'obmotivos' => 'observacion',
			'cie10' => 'cie10',
			'ips' => 'nombre',
			'mails' => 'id',
			'covid' => 'id',
			'regimenes' => 'nombre',
			'otros' => 'id',
			'prass' => 'id',
			'oportunidad' => 'id',
		];

		if(!isset($sql_from[$table_name])) return false;

		$from = ($skip_joins ? "`{$table_name}`" : $sql_from[$table_name]);

		if($skip_permissions) return $from . ' WHERE 1=1';

		// mm: build the query based on current member's permissions
		// allowing lower permissions if $lower_permissions set to 'user' or 'group'
		$perm = getTablePermissions($table_name);
		if($perm['view'] == 1 || ($perm['view'] > 1 && $lower_permissions == 'user')) { // view owner only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND LCASE(`membership_userrecords`.`memberID`)='" . getLoggedMemberID() . "'";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $lower_permissions == 'group')) { // view group only
			$from .= ", `membership_userrecords` WHERE `{$table_name}`.`{$pkey[$table_name]}`=`membership_userrecords`.`pkValue` AND `membership_userrecords`.`tableName`='{$table_name}' AND `membership_userrecords`.`groupID`='" . getLoggedGroupID() . "'";
		} elseif($perm['view'] == 3) { // view all
			$from .= ' WHERE 1=1';
		} else { // view none
			return false;
		}

		return $from;
	}

	#########################################################

	function get_joined_record($table, $id, $skip_permissions = false) {
		$sql_fields = get_sql_fields($table);
		$sql_from = get_sql_from($table, $skip_permissions);

		if(!$sql_fields || !$sql_from) return false;

		$pk = getPKFieldName($table);
		if(!$pk) return false;

		$safe_id = makeSafe($id, false);
		$sql = "SELECT {$sql_fields} FROM {$sql_from} AND `{$table}`.`{$pk}`='{$safe_id}'";
		$eo['silentErrors'] = true;
		$res = sql($sql, $eo);
		if($row = db_fetch_assoc($res)) return $row;

		return false;
	}

	#########################################################

	function get_defaults($table) {
		/* array of tables and their fields, with default values (or empty), excluding automatic values */
		$defaults = [
			'pqr' => [
				'id' => '',
				'consecutivo' => '',
				'oficio' => '',
				'fecha' => '',
				'tipoid' => '',
				'procedencia' => '',
				'doc' => '',
				'nombres' => '',
				'apellidos' => '',
				'genero' => '',
				'nacimiento' => '',
				'edad' => '',
				'direccion' => '',
				'barrio' => '',
				'comuna' => '',
				'telefono' => '',
				'notel' => '',
				'correo' => '',
				'nocorreo' => '',
				'sac' => '',
				'tipopqr' => '',
				'poblacion' => '',
				'regimen' => '',
				'eps' => '',
				'otraeps' => '',
				'gerente' => '',
				'teleps' => '',
				'maileps' => '',
				'cc2' => '',
				'cc3' => '',
				'acudiente' => '',
				'nombreacu' => '',
				'docacudiente' => '',
				'ref' => '',
				'motivo' => '',
				'obmotivo' => '',
				'fechainc' => '',
				'servicio' => '',
				'enfermedad' => '',
				'descripcie10' => '',
				'descripcion' => '',
				'estado' => '',
				'condicion' => '',
				'cierre' => '',
				'conclusion' => '',
				'dias' => '',
				'diascierre' => '',
				'indicador' => '',
				'detalle1' => '',
				'fecha1' => '',
				'detalle2' => '',
				'fecha2' => '',
				'detalle3' => '',
				'fecha3' => '',
				'detalle4' => '',
				'fallecido' => '',
				'status' => '',
				'periodo' => '',
				'asignado' => '',
				'ingresada' => '1',
				'cargada' => '',
				'emailuser' => '',
				'observaciones' => '',
			],
			'Encuesta' => [
				'id' => '',
				'fecha' => '',
				'tipoid' => '',
				'doc' => '',
				'nombres' => '',
				'apellidos' => '',
				'eps' => '',
				'ipsprim' => '',
				'tratoser' => '',
				'cita' => '',
				'tratoasis' => '',
				'expprof' => '',
				'bioser' => '',
				'area' => '',
				'pyp' => '',
				'prenatal' => '',
				'cyd' => '',
				'vacunas' => '',
				'pfm' => '',
				'citologia' => '',
				'sservicio' => '',
				'incomodo' => '',
				'otro' => '',
				'why' => '',
				'urgencia' => '',
				'citaoportuna' => '',
				'aspectoeps' => '',
				'fisicas' => '',
				'aseo' => '',
				'capacitacion' => '',
				'autorizaciones' => '',
				'general' => '',
				'horario' => '',
				'formulario' => '',
				'farmacia' => '',
				'fisicasfarma' => '',
				'oporfarmacia' => '',
				'totalidad' => '',
				'cambio' => '',
				'volver' => '',
				'orientacion' => '',
				'embalaje' => '',
				'revision' => '',
				'observaciones' => 'NINGUNA',
				'user' => '',
			],
			'barrios' => [
				'nombre' => '',
				'comuna' => '',
			],
			'soportes' => [
				'id' => '',
				'doc' => '',
				'soporte1' => '',
				'soporte2' => '',
				'soporte3' => '',
				'soporte4' => '',
			],
			'eps' => [
				'razonsocial' => '',
				'regimen' => '',
				'gerente' => '',
				'telefono' => '',
				'correo' => '',
				'correo2' => '',
				'correo3' => '',
			],
			'motivos' => [
				'motivo' => '',
			],
			'obmotivos' => [
				'motivo' => '',
				'observacion' => '',
			],
			'cie10' => [
				'cie10' => '',
				'descripcion' => '',
			],
			'ips' => [
				'nombre' => '',
				'municipio' => '',
				'correo' => '',
				'direccion' => '',
				'telefono' => '',
				'gerente' => '',
			],
			'mails' => [
				'id' => '',
				'idpqr' => '',
				'fecha' => '',
				'eps' => '',
				'correo' => '',
				'asunto' => '',
				'cuerpo' => '',
				'user' => '',
				'groupID' => '',
			],
			'covid' => [
				'id' => '',
				'fecha' => '',
				'tipodoc' => '',
				'doc' => '',
				'nombre' => '',
				'genero' => '',
				'nacimiento' => '',
				'edad' => 'Edad',
				'telefono' => '',
				'regimen' => '',
				'eps' => '',
				'embarazo' => '',
				'patologia' => '0',
				'fallecido' => '',
				'cual' => '',
				'atencion' => '',
				'tratamiento' => '',
				'medicamentos' => '',
				'vigilancia' => '',
				'percepcion' => '',
				'medicinageneral' => '',
				'oportunidad' => '',
				'observacion' => 'SIN OBSERVACION',
				'status' => '',
				'responsable' => '',
				'periodo' => '',
				'asignado' => '',
			],
			'regimenes' => [
				'nombre' => '',
			],
			'otros' => [
				'id' => '',
				'fecha' => '',
				'asunto' => '',
				'sexo' => '',
				'tipodoc' => '',
				'procedencia' => '',
				'documento' => '',
				'nombres' => '',
				'apellidos' => '',
				'nacimiento' => '',
				'edad' => '',
				'direccion' => '',
				'barrio' => '',
				'comuna' => '',
				'telefono' => '',
				'regimen' => '',
				'eapb' => '',
				'otraeps' => '',
				'gerente' => '',
				'poblacion' => '',
				'acudiente' => '',
				'docacu' => '',
				'nombreacu' => '',
				'descripcion' => '',
				'fechaentrega' => '',
				'soporte1' => '',
				'soporte2' => '',
				'soporte3' => '',
				'asignado' => '',
				'cargo' => '',
			],
			'prass' => [
				'id' => '',
				'fecha' => '',
				'documento' => '',
				'nombrepaciente' => '',
				'regimen' => '',
				'eps' => '',
				'direccion' => '',
				'telefono' => '',
				'consulta' => '',
				'fechaconsulta' => '',
				'prueba' => '',
				'fechaprueba' => '',
				'estado' => '',
				'observacion' => '',
				'encargado' => '',
			],
			'oportunidad' => [
				'id' => '',
				'tipodoc' => '',
				'doc' => '',
				'nombres' => '',
				'apellidos' => '',
				'regimen' => '',
				'eps' => '',
				'fechanac' => '',
				'edad' => '',
				'atencionreq' => '',
				'fechaorden' => '',
				'fechacita' => '',
				'calificacion' => '',
				'observaciones' => '',
				'asignado' => '',
			],
		];

		return isset($defaults[$table]) ? $defaults[$table] : [];
	}

	#########################################################

	function logInMember() {
		$redir = 'index.php';
		if($_POST['signIn'] != '') {
			if($_POST['username'] != '' && $_POST['password'] != '') {
				$username = makeSafe(strtolower($_POST['username']));
				$hash = sqlValue("select passMD5 from membership_users where lcase(memberID)='{$username}' and isApproved=1 and isBanned=0");
				$password = $_POST['password'];

				if(password_match($password, $hash)) {
					$_SESSION['memberID'] = $username;
					$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");

					if($_POST['rememberMe'] == 1) {
						RememberMe::login($username);
					} else {
						RememberMe::delete();
					}

					// harden user's password hash
					password_harden($username, $password, $hash);

					// hook: login_ok
					if(function_exists('login_ok')) {
						$args = [];
						if(!$redir = login_ok(getMemberInfo(), $args)) {
							$redir = 'index.php';
						}
					}

					redirect($redir);
					exit;
				}
			}

			// hook: login_failed
			if(function_exists('login_failed')) {
				$args = [];
				login_failed([
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'IP' => $_SERVER['REMOTE_ADDR']
				], $args);
			}

			if(!headers_sent()) header('HTTP/1.0 403 Forbidden');
			redirect("index.php?loginFailed=1");
			exit;
		}

		/* do we have a JWT auth header? */
		jwt_check_login();

		if(!empty($_SESSION['memberID']) && !empty($_SESSION['memberGroupID'])) return;

		/* check if a rememberMe cookie exists and sign in user if so */
		if(RememberMe::check()) {
			$username = makeSafe(strtolower(RememberMe::user()));
			$_SESSION['memberID'] = $username;
			$_SESSION['memberGroupID'] = sqlValue("SELECT `groupID` FROM `membership_users` WHERE LCASE(`memberID`)='{$username}'");
		}
	}

	#########################################################

	function htmlUserBar() {
		global $Translation;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		$mi = getMemberInfo();
		$adminConfig = config('adminConfig');
		$home_page = (basename($_SERVER['PHP_SELF']) == 'index.php');
		ob_start();

		?>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<a class="navbar-brand" href="<?php echo PREPEND_PATH; ?>index.php"><i class="glyphicon glyphicon-home"></i> RozzyS</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav"><?php echo ($home_page ? '' : NavMenus()); ?></ul>

				<?php if(userCanImport()){ ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn hidden-xs btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> <?php echo $Translation['import CSV']; ?></a>
						<a href="<?php echo PREPEND_PATH; ?>import-csv.php" class="btn btn-default navbar-btn visible-xs btn-lg btn-import-csv" title="<?php echo html_attr($Translation['import csv file']); ?>"><i class="glyphicon glyphicon-th"></i> <?php echo $Translation['import CSV']; ?></a>
					</ul>
				<?php } ?>

				<?php if(getLoggedAdmin() !== false) { ?>
					<ul class="nav navbar-nav">
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn hidden-xs" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
						<a href="<?php echo PREPEND_PATH; ?>admin/pageHome.php" class="btn btn-danger navbar-btn visible-xs btn-lg" title="<?php echo html_attr($Translation['admin area']); ?>"><i class="glyphicon glyphicon-cog"></i> <?php echo $Translation['admin area']; ?></a>
					</ul>
				<?php } ?>

				<?php if(!$_GET['signIn'] && !$_GET['loginFailed']) { ?>
					<?php if(!$mi['username'] || $mi['username'] == $adminConfig['anonymousMember']) { ?>
						<p class="navbar-text navbar-right">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php } else { ?>
						<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
							<a class="btn navbar-btn btn-default" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>

							<p class="navbar-text signed-in-as">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link username"><?php echo $mi['username']; ?></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center signed-in-as">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link username"><?php echo $mi['username']; ?></a></strong>
							</p>
						</ul>
						<script>
							/* periodically check if user is still signed in */
							setInterval(function() {
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username) {
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>

				<p class="navbar-text navbar-right help-shortcuts-launcher-container hidden-xs">
					<img
						class="help-shortcuts-launcher" 
						src="<?php echo PREPEND_PATH; ?>resources/images/keyboard.png" 
						title="<?php echo html_attr($Translation['keyboard shortcuts']); ?>">
				</p>
			</div>
		</nav>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function showNotifications($msg = '', $class = '', $fadeout = true) {
		global $Translation;
		if($error_message = strip_tags($_REQUEST['error_message']))
			$error_message = '<div class="text-bold">' . $error_message . '</div>';

		if(!$msg) { // if no msg, use url to detect message to display
			if($_REQUEST['record-added-ok'] != '') {
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-added-error'] != '') {
				$msg = $Translation['Couldn\'t save the new record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif($_REQUEST['record-updated-ok'] != '') {
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-updated-error'] != '') {
				$msg = $Translation['Couldn\'t save changes to the record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} elseif($_REQUEST['record-deleted-ok'] != '') {
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
			} elseif($_REQUEST['record-deleted-error'] != '') {
				$msg = $Translation['Couldn\'t delete this record'] . $error_message;
				$class = 'alert-danger';
				$fadeout = false;
			} else {
				return '';
			}
		}
		$id = 'notification-' . rand();

		ob_start();
		// notification template
		?>
		<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="opacity: 1; padding-top: 6px; padding-bottom: 6px; animation: fadeIn 1.5s ease-out;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			%%MSG%%
		</div>
		<script>
			$j(function() {
				var autoDismiss = <?php echo $fadeout ? 'true' : 'false'; ?>,
					embedded = !$j('nav').length,
					messageDelay = 10, fadeDelay = 1.5;

				if(!autoDismiss) {
					if(embedded)
						$j('#%%ID%%').before('<div style="height: 2rem;"></div>');
					else
						$j('#%%ID%%').css({ margin: '0 0 1rem' });

					return;
				}

				// below code runs only in case of autoDismiss

				if(embedded)
					$j('#%%ID%%').css({ margin: '1rem 0 -1rem' });
				else
					$j('#%%ID%%').css({ margin: '-15px 0 -20px' });

				setTimeout(function() {
					$j('#%%ID%%').css({    animation: 'fadeOut ' + fadeDelay + 's ease-out' });
				}, messageDelay * 1000);

				setTimeout(function() {
					$j('#%%ID%%').css({    visibility: 'hidden' });
				}, (messageDelay + fadeDelay) * 1000);
			})
		</script>
		<style>
			@keyframes fadeIn {
				0%   { opacity: 0; }
				100% { opacity: 1; }
			}
			@keyframes fadeOut {
				0%   { opacity: 1; }
				100% { opacity: 0; }
			}
		</style>

		<?php
		$out = ob_get_clean();

		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}

	#########################################################

	function parseMySQLDate($date, $altDate) {
		// is $date valid?
		if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($date))) {
			return trim($date);
		}

		if($date != '--' && preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($altDate))) {
			return trim($altDate);
		}

		if($date != '--' && $altDate && intval($altDate)==$altDate) {
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);
		}

		return '';
	}

	#########################################################

	function parseCode($code, $isInsert = true, $rawData = false) {
		if($isInsert) {
			$arrCodes = [
				'<%%creatorusername%%>' => $_SESSION['memberID'],
				'<%%creatorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => sqlValue("SELECT `name` FROM `membership_groups` WHERE `groupID`='{$_SESSION['memberGroupID']}'"),

				'<%%creationdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%creationtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%creationdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%creationtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			];
		} else {
			$arrCodes = [
				'<%%editorusername%%>' => $_SESSION['memberID'],
				'<%%editorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => sqlValue("SELECT `name` FROM `membership_groups` WHERE `groupID`='{$_SESSION['memberGroupID']}'"),

				'<%%editingdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%editingtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%editingdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%editingtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			];
		}

		$pc = str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}

	#########################################################

	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue) {
		// validate input
		if($index < 1 || $index > 80 || !is_int($index)) return false;
		if($filterAnd != 'or')   $filterAnd = 'and';
		$filterField = intval($filterField);

		/* backward compatibility */
		if(in_array($filterOperator, $GLOBALS['filter_operators'])) {
			$filterOperator = array_search($filterOperator, $GLOBALS['filter_operators']);
		}

		if(!in_array($filterOperator, array_keys($GLOBALS['filter_operators']))) {
			$filterOperator = 'like';
		}

		if(!$filterField) {
			$filterOperator = '';
			$filterValue = '';
		}

		$_REQUEST['FilterAnd'][$index] = $filterAnd;
		$_REQUEST['FilterField'][$index] = $filterField;
		$_REQUEST['FilterOperator'][$index] = $filterOperator;
		$_REQUEST['FilterValue'][$index] = $filterValue;

		return true;
	}

	#########################################################

	function clearFilters() {
		for($i=1; $i<=80; $i++) {
			addFilter($i, '', 0, '', '');
		}
	}

	#########################################################

	if(!function_exists('str_ireplace')) {
		function str_ireplace($search, $replace, $subject) {
			$ret=$subject;
			if(is_array($search)) {
				for($i=0; $i<count($search); $i++) {
					$ret=str_ireplace($search[$i], $replace[$i], $ret);
				}
			} else {
				$ret=preg_replace('/'.preg_quote($search, '/').'/i', $replace, $ret);
			}

			return $ret;
		} 
	} 

	#########################################################

	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view=false) {
		global $Translation;

		$view = dirname(__FILE__)."/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)) {
			foreach($the_data_to_pass_to_the_view as $k => $v)
				$$k = $v;
		}
		unset($the_data_to_pass_to_the_view, $k, $v);

		ob_start();
		@include($view);
		$out=ob_get_contents();
		ob_end_clean();

		return $out;
	}

	#########################################################

	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = []) {
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header) {
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))) {
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer) {
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))) {
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}

	#########################################################

	function filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) {
		$filterersArray = explode(',', $filterers);
		$parentFilterersArray = explode(',', $parentFilterers);
		$parentFiltererList = '`' . implode('`, `', $parentFilterersArray) . '`';
		$res=sql("SELECT `$parentPKField`, $parentCaption, $parentFiltererList FROM `$parentTable` ORDER BY 2", $eo);
		$filterableData = [];
		while($row=db_fetch_row($res)) {
			$filterableData[$row[0]] = $row[1];
			$filtererIndex = 0;
			foreach($filterersArray as $filterer) {
				$filterableDataByFilterer[$filterer][$row[$filtererIndex + 2]][$row[0]] = $row[1];
				$filtererIndex++;
			}
			$row[0] = addslashes($row[0]);
			$row[1] = addslashes($row[1]);
			$jsonFilterableData .= "\"{$row[0]}\":\"{$row[1]}\",";
		}
		$jsonFilterableData .= '}';
		$jsonFilterableData = '{'.str_replace(',}', '}', $jsonFilterableData);     
		$filterJS = "\nvar {$filterable}_data = $jsonFilterableData;";

		foreach($filterersArray as $filterer) {
			if(is_array($filterableDataByFilterer[$filterer])) foreach($filterableDataByFilterer[$filterer] as $filtererItem => $filterableItem) {
				$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filtererItem).'":{';
				foreach($filterableItem as $filterableItemID => $filterableItemData) {
					$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filterableItemID).'":"'.addslashes($filterableItemData).'",';
				}
				$jsonFilterableDataByFilterer[$filterer] .= '},';
			}
			$jsonFilterableDataByFilterer[$filterer] .= '}';
			$jsonFilterableDataByFilterer[$filterer] = '{'.str_replace(',}', '}', $jsonFilterableDataByFilterer[$filterer]);

			$filterJS.="\n\n// code for filtering {$filterable} by {$filterer}\n";
			$filterJS.="\nvar {$filterable}_data_by_{$filterer} = {$jsonFilterableDataByFilterer[$filterer]}; ";
			$filterJS.="\nvar selected_{$filterable} = \$j('#{$filterable}').val();";
			$filterJS.="\nvar {$filterable}_change_by_{$filterer} = function() {";
			$filterJS.="\n\t$('{$filterable}').options.length=0;";
			$filterJS.="\n\t$('{$filterable}').options[0] = new Option();";
			$filterJS.="\n\tif(\$j('#{$filterer}').val()) {";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()]) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data_by_{$filterer}[\$j('#{$filterer}').val()][{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t} else {";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data) {";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data[{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t\tif(selected_{$filterable} && selected_{$filterable} == \$j('#{$filterable}').val()) {";
			$filterJS.="\n\t\t\tfor({$filterer}_item in {$filterable}_data_by_{$filterer}) {";
			$filterJS.="\n\t\t\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[{$filterer}_item]) {";
			$filterJS.="\n\t\t\t\t\tif({$filterable}_item == selected_{$filterable}) {";
			$filterJS.="\n\t\t\t\t\t\t$('{$filterer}').value = {$filterer}_item;";
			$filterJS.="\n\t\t\t\t\t\tbreak;";
			$filterJS.="\n\t\t\t\t\t}";
			$filterJS.="\n\t\t\t\t}";
			$filterJS.="\n\t\t\t\tif({$filterable}_item == selected_{$filterable}) break;";
			$filterJS.="\n\t\t\t}";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}";
			$filterJS.="\n\t$('{$filterable}').highlight();";
			$filterJS.="\n};";
			$filterJS.="\n$('{$filterer}').observe('change', function() { window.setTimeout({$filterable}_change_by_{$filterer}, 25); });";
			$filterJS.="\n";
		}

		$filterableCombo = new Combo;
		$filterableCombo->ListType = 0;
		$filterableCombo->ListItem = array_slice(array_values($filterableData), 0, 10);
		$filterableCombo->ListData = array_slice(array_keys($filterableData), 0, 10);
		$filterableCombo->SelectName = $filterable;
		$filterableCombo->AllowNull = true;

		return $filterJS;
	}

	#########################################################
	function br2nl($text) {
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################

	if(!function_exists('htmlspecialchars_decode')) {
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

	#########################################################

	function entitiesToUTF8($input) {
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m) {
		if(function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		} else {
			return $m[1];
		}
	}

	#########################################################

	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################

	function permissions_sql($table, $level = 'all') {
		if(!in_array($level, ['user', 'group'])) { $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm['view'] == 1 || ($perm['view'] > 1 && $level == 'user')) { // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "')";
		} elseif($perm['view'] == 2 || ($perm['view'] > 2 && $level == 'group')) { // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='" . getLoggedGroupID() . "')";
		} elseif($perm['view'] == 3) { // view all
			// no further action
		} elseif($perm['view'] == 0) { // view none
			return false;
		}

		return ['where' => $where, 'from' => $from, 0 => $where, 1 => $from];
	}

	#########################################################

	function error_message($msg, $back_url = '', $full_page = true) {
		$curr_dir = dirname(__FILE__);
		global $Translation;

		ob_start();

		if($full_page) include($curr_dir . '/header.php');

		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false) { // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url) {
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				} else {
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';

		if($full_page) include($curr_dir . '/footer.php');

		return ob_get_clean();
	}

	#########################################################

	function toMySQLDate($formattedDate, $sep = datalist_date_separator, $ord = datalist_date_format) {
		// extract date elements
		$de=explode($sep, $formattedDate);
		$mySQLDate=intval($de[strpos($ord, 'Y')]).'-'.intval($de[strpos($ord, 'm')]).'-'.intval($de[strpos($ord, 'd')]);
		return $mySQLDate;
	}

	#########################################################

	function reIndex(&$arr) {
		$i=1;
		foreach($arr as $n=>$v) {
			$arr2[$i]=$n;
			$i++;
		}
		return $arr2;
	}

	#########################################################

	function get_embed($provider, $url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		if(!$url) return '';

		$providers = [
			'youtube' => ['oembed' => 'https://www.youtube.com/oembed?'],
			'googlemap' => ['oembed' => '', 'regex' => '/^http.*\.google\..*maps/i'],
		];

		if(!isset($providers[$provider])) {
			return '<div class="text-danger">' . $Translation['invalid provider'] . '</div>';
		}

		if(isset($providers[$provider]['regex']) && !preg_match($providers[$provider]['regex'], $url)) {
			return '<div class="text-danger">' . $Translation['invalid url'] . '</div>';
		}

		if($providers[$provider]['oembed']) {
			$oembed = $providers[$provider]['oembed'] . 'url=' . urlencode($url) . "&amp;maxwidth={$max_width}&amp;maxheight={$max_height}&amp;format=json";
			$data_json = request_cache($oembed);

			$data = json_decode($data_json, true);
			if($data === null) {
				/* an error was returned rather than a json string */
				if($retrieve == 'html') return "<div class=\"text-danger\">{$data_json}\n<!-- {$oembed} --></div>";
				return '';
			}

			return (isset($data[$retrieve]) ? $data[$retrieve] : $data['html']);
		}

		/* special cases (where there is no oEmbed provider) */
		if($provider == 'googlemap') return get_embed_googlemap($url, $max_width, $max_height, $retrieve);

		return '<div class="text-danger">Invalid provider!</div>';
	}

	#########################################################

	function get_embed_googlemap($url, $max_width = '', $max_height = '', $retrieve = 'html') {
		global $Translation;
		$url_parts = parse_url($url);
		$coords_regex = '/-?\d+(\.\d+)?[,+]-?\d+(\.\d+)?(,\d{1,2}z)?/'; /* https://stackoverflow.com/questions/2660201 */

		if(preg_match($coords_regex, $url_parts['path'] . '?' . $url_parts['query'], $m)) {
			list($lat, $long, $zoom) = explode(',', $m[0]);
			$zoom = intval($zoom);
			if(!$zoom) $zoom = 10; /* default zoom */
			if(!$max_height) $max_height = 360;
			if(!$max_width) $max_width = 480;

			$api_key = config('adminConfig')['googleAPIKey'];
			$embed_url = "https://www.google.com/maps/embed/v1/view?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap";
			$thumbnail_url = "https://maps.googleapis.com/maps/api/staticmap?key={$api_key}&amp;center={$lat},{$long}&amp;zoom={$zoom}&amp;maptype=roadmap&amp;size={$max_width}x{$max_height}";

			if($retrieve == 'html') {
				return "<iframe width=\"{$max_width}\" height=\"{$max_height}\" frameborder=\"0\" style=\"border:0\" src=\"{$embed_url}\"></iframe>";
			} else {
				return $thumbnail_url;
			}
		} else {
			return '<div class="text-danger">' . $Translation['cant retrieve coordinates from url'] . '</div>';
		}
	}

	#########################################################

	function request_cache($request, $force_fetch = false) {
		$max_cache_lifetime = 7 * 86400; /* max cache lifetime in seconds before refreshing from source */

		/* membership_cache table exists? if not, create it */
		static $cache_table_exists = false;
		if(!$cache_table_exists && !$force_fetch) {
			$te = sqlValue("show tables like 'membership_cache'");
			if(!$te) {
				if(!sql("CREATE TABLE `membership_cache` (`request` VARCHAR(100) NOT NULL, `request_ts` INT, `response` TEXT NOT NULL, PRIMARY KEY (`request`))", $eo)) {
					/* table can't be created, so force fetching request */
					return request_cache($request, true);
				}
			}
			$cache_table_exists = true;
		}

		/* retrieve response from cache if exists */
		if(!$force_fetch) {
			$res = sql("select response, request_ts from membership_cache where request='" . md5($request) . "'", $eo);
			if(!$row = db_fetch_array($res)) return request_cache($request, true);

			$response = $row[0];
			$response_ts = $row[1];
			if($response_ts < time() - $max_cache_lifetime) return request_cache($request, true);
		}

		/* if no response in cache, issue a request */
		if(!$response || $force_fetch) {
			$response = @file_get_contents($request);
			if($response === false) {
				$error = error_get_last();
				$error_message = preg_replace('/.*: (.*)/', '$1', $error['message']);
				return $error_message;
			} elseif($cache_table_exists) {
				/* store response in cache */
				$ts = time();
				sql("replace into membership_cache set request='" . md5($request) . "', request_ts='{$ts}', response='" . makeSafe($response, false) . "'", $eo);
			}
		}

		return $response;
	}

	#########################################################

	function check_record_permission($table, $id, $perm = 'view') {
		if($perm != 'edit' && $perm != 'delete') $perm = 'view';

		$perms = getTablePermissions($table);
		if(!$perms[$perm]) return false;

		$safe_id = makeSafe($id);
		$safe_table = makeSafe($table);

		if($perms[$perm] == 1) { // own records only
			$username = getLoggedMemberID();
			$owner = sqlValue("select memberID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner == $username) return true;
		} elseif($perms[$perm] == 2) { // group records
			$group_id = getLoggedGroupID();
			$owner_group_id = sqlValue("select groupID from membership_userrecords where tableName='{$safe_table}' and pkValue='{$safe_id}'");
			if($owner_group_id == $group_id) return true;
		} elseif($perms[$perm] == 3) { // all records
			return true;
		}

		return false;
	}

	#########################################################

	function NavMenus($options = []) {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		global $Translation;
		$prepend_path = PREPEND_PATH;

		/* default options */
		if(empty($options)) {
			$options = ['tabs' => 7];
		}

		$table_group_name = array_keys(get_table_groups()); /* 0 => group1, 1 => group2 .. */
		/* if only one group named 'None', set to translation of 'select a table' */
		if((count($table_group_name) == 1 && $table_group_name[0] == 'None') || count($table_group_name) < 1) $table_group_name[0] = $Translation['select a table'];
		$table_group_index = array_flip($table_group_name); /* group1 => 0, group2 => 1 .. */
		$menu = array_fill(0, count($table_group_name), '');

		$t = time();
		$arrTables = getTableList();
		if(is_array($arrTables)) {
			foreach($arrTables as $tn => $tc) {
				/* ---- list of tables where hide link in nav menu is set ---- */
				$tChkHL = array_search($tn, ['pqr','soportes']);

				/* ---- list of tables where filter first is set ---- */
				$tChkFF = array_search($tn, []);
				if($tChkFF !== false && $tChkFF !== null) {
					$searchFirst = '&Filter_x=1';
				} else {
					$searchFirst = '';
				}

				/* when no groups defined, $table_group_index['None'] is NULL, so $menu_index is still set to 0 */
				$menu_index = intval($table_group_index[$tc[3]]);
				if(!$tChkHL && $tChkHL !== 0) $menu[$menu_index] .= "<li><a href=\"{$prepend_path}{$tn}_view.php?t={$t}{$searchFirst}\"><img src=\"{$prepend_path}" . ($tc[2] ? $tc[2] : 'blank.gif') . "\" height=\"32\"> {$tc[0]}</a></li>";
			}
		}

		// custom nav links, as defined in "hooks/links-navmenu.php" 
		global $navLinks;
		if(is_array($navLinks)) {
			$memberInfo = getMemberInfo();
			$links_added = [];
			foreach($navLinks as $link) {
				if(!isset($link['url']) || !isset($link['title'])) continue;
				if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
					$menu_index = intval($link['table_group']);
					if(!$links_added[$menu_index]) $menu[$menu_index] .= '<li class="divider"></li>';

					/* add prepend_path to custom links if they aren't absolute links */
					if(!preg_match('/^(http|\/\/)/i', $link['url'])) $link['url'] = $prepend_path . $link['url'];
					if(!preg_match('/^(http|\/\/)/i', $link['icon']) && $link['icon']) $link['icon'] = $prepend_path . $link['icon'];

					$menu[$menu_index] .= "<li><a href=\"{$link['url']}\"><img src=\"" . ($link['icon'] ? $link['icon'] : "{$prepend_path}blank.gif") . "\" height=\"32\"> {$link['title']}</a></li>";
					$links_added[$menu_index]++;
				}
			}
		}

		$menu_wrapper = '';
		for($i = 0; $i < count($menu); $i++) {
			$menu_wrapper .= <<<EOT
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{$table_group_name[$i]} <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">{$menu[$i]}</ul>
				</li>
EOT;
		}

		return $menu_wrapper;
	}

	#########################################################

	function StyleSheet() {
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
		$prepend_path = PREPEND_PATH;

		$css_links = <<<EOT

			<link rel="stylesheet" href="{$prepend_path}resources/initializr/css/flatly.css">
			<link rel="stylesheet" href="{$prepend_path}resources/lightbox/css/lightbox.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/select2/select2.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}resources/timepicker/bootstrap-timepicker.min.css" media="screen">
			<link rel="stylesheet" href="{$prepend_path}dynamic.css">
EOT;

		return $css_links;
	}

	#########################################################

	function PrepareUploadedFile($FieldName, $MaxSize, $FileTypes = 'jpg|jpeg|gif|png', $NoRename = false, $dir = '') {
		global $Translation;
		$f = $_FILES[$FieldName];
		if($f['error'] == 4 || !$f['name']) return '';

		$dir = getUploadDir($dir);

		/* get php.ini upload_max_filesize in bytes */
		$php_upload_size_limit = trim(ini_get('upload_max_filesize'));
		$last = strtolower($php_upload_size_limit[strlen($php_upload_size_limit) - 1]);
		switch($last) {
			case 'g':
				$php_upload_size_limit *= 1024;
			case 'm':
				$php_upload_size_limit *= 1024;
			case 'k':
				$php_upload_size_limit *= 1024;
		}

		$MaxSize = min($MaxSize, $php_upload_size_limit);

		if($f['size'] > $MaxSize || $f['error']) {
			echo error_message(str_replace(['<MaxSize>', '{MaxSize}'], intval($MaxSize / 1024), $Translation['file too large']));
			exit;
		}
		if(!preg_match('/\.(' . $FileTypes . ')$/i', $f['name'], $ft)) {
			echo error_message(str_replace(['<FileTypes>', '{FileTypes}'], str_replace('|', ', ', $FileTypes), $Translation['invalid file type']));
			exit;
		}

		$name = str_replace(' ', '_', $f['name']);
		if(!$NoRename) $name = substr(md5(microtime() . rand(0, 100000)), -17) . $ft[0];

		if(!file_exists($dir)) @mkdir($dir, 0777);

		if(!@move_uploaded_file($f['tmp_name'], $dir . $name)) {
			echo error_message("Couldn't save the uploaded file. Try chmoding the upload folder '{$dir}' to 777.");
			exit;
		}

		@chmod($dir . $name, 0666);
		return $name;
	}

	#########################################################

	function get_home_links($homeLinks, $default_classes, $tgroup = '') {
		if(!is_array($homeLinks) || !count($homeLinks)) return '';

		$memberInfo = getMemberInfo();

		ob_start();
		foreach($homeLinks as $link) {
			if(!isset($link['url']) || !isset($link['title'])) continue;
			if($tgroup != $link['table_group'] && $tgroup != '*') continue;

			/* fall-back classes if none defined */
			if(!$link['grid_column_classes']) $link['grid_column_classes'] = $default_classes['grid_column'];
			if(!$link['panel_classes']) $link['panel_classes'] = $default_classes['panel'];
			if(!$link['link_classes']) $link['link_classes'] = $default_classes['link'];

			if(getLoggedAdmin() !== false || @in_array($memberInfo['group'], $link['groups']) || @in_array('*', $link['groups'])) {
				?>
				<div class="col-xs-12 <?php echo $link['grid_column_classes']; ?>">
					<div class="panel <?php echo $link['panel_classes']; ?>">
						<div class="panel-body">
							<a class="btn btn-block btn-lg <?php echo $link['link_classes']; ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($link['description']))); ?>" href="<?php echo $link['url']; ?>"><?php echo ($link['icon'] ? '<img src="' . $link['icon'] . '">' : ''); ?><strong><?php echo $link['title']; ?></strong></a>
							<div class="panel-body-description"><?php echo $link['description']; ?></div>
						</div>
					</div>
				</div>
				<?php
			}
		}

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}

	#########################################################

	function quick_search_html($search_term, $label, $separate_dv = true) {
		global $Translation;

		$safe_search = html_attr($search_term);
		$safe_label = html_attr($label);
		$safe_clear_label = html_attr($Translation['Reset Filters']);

		if($separate_dv) {
			$reset_selection = "document.myform.SelectedID.value = '';";
		} else {
			$reset_selection = "document.myform.writeAttribute('novalidate', 'novalidate');";
		}
		$reset_selection .= ' document.myform.NoDV.value=1; return true;';

		$html = <<<EOT
		<div class="input-group" id="quick-search">
			<input type="text" id="SearchString" name="SearchString" value="{$safe_search}" class="form-control" placeholder="{$safe_label}">
			<span class="input-group-btn">
				<button name="Search_x" value="1" id="Search" type="submit" onClick="{$reset_selection}" class="btn btn-default" title="{$safe_label}"><i class="glyphicon glyphicon-search"></i></button>
				<button name="ClearQuickSearch" value="1" id="ClearQuickSearch" type="submit" onClick="\$j('#SearchString').val(''); {$reset_selection}" class="btn btn-default" title="{$safe_clear_label}"><i class="glyphicon glyphicon-remove-circle"></i></button>
			</span>
		</div>
EOT;
		return $html;
	}

	#########################################################

