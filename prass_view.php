<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/prass.php");
	include_once("{$currDir}/prass_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('prass');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'prass';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`prass`.`id`" => "id",
		"if(`prass`.`fecha`,date_format(`prass`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`prass`.`documento`" => "documento",
		"`prass`.`nombrepaciente`" => "nombrepaciente",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* Eps */" => "eps",
		"`prass`.`direccion`" => "direccion",
		"`prass`.`telefono`" => "telefono",
		"`prass`.`consulta`" => "consulta",
		"if(`prass`.`fechaconsulta`,date_format(`prass`.`fechaconsulta`,'%d/%m/%Y'),'')" => "fechaconsulta",
		"`prass`.`prueba`" => "prueba",
		"if(`prass`.`fechaprueba`,date_format(`prass`.`fechaprueba`,'%d/%m/%Y'),'')" => "fechaprueba",
		"`prass`.`estado`" => "estado",
		"`prass`.`observacion`" => "observacion",
		"`prass`.`encargado`" => "encargado",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`prass`.`id`',
		2 => '`prass`.`fecha`',
		3 => 3,
		4 => 4,
		5 => '`regimenes1`.`nombre`',
		6 => '`eps1`.`razonsocial`',
		7 => 7,
		8 => 8,
		9 => 9,
		10 => '`prass`.`fechaconsulta`',
		11 => 11,
		12 => '`prass`.`fechaprueba`',
		13 => 13,
		14 => 14,
		15 => 15,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`prass`.`id`" => "id",
		"if(`prass`.`fecha`,date_format(`prass`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`prass`.`documento`" => "documento",
		"`prass`.`nombrepaciente`" => "nombrepaciente",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* Eps */" => "eps",
		"`prass`.`direccion`" => "direccion",
		"`prass`.`telefono`" => "telefono",
		"`prass`.`consulta`" => "consulta",
		"if(`prass`.`fechaconsulta`,date_format(`prass`.`fechaconsulta`,'%d/%m/%Y'),'')" => "fechaconsulta",
		"`prass`.`prueba`" => "prueba",
		"if(`prass`.`fechaprueba`,date_format(`prass`.`fechaprueba`,'%d/%m/%Y'),'')" => "fechaprueba",
		"`prass`.`estado`" => "estado",
		"`prass`.`observacion`" => "observacion",
		"`prass`.`encargado`" => "encargado",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`prass`.`id`" => "ID",
		"`prass`.`fecha`" => "Fecha",
		"`prass`.`documento`" => "Documento",
		"`prass`.`nombrepaciente`" => "Nombre del usuario",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "Regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* Eps */" => "Eps",
		"`prass`.`direccion`" => "Direccion",
		"`prass`.`telefono`" => "Telefono",
		"`prass`.`consulta`" => "Recibi&#243; Consulta para atenci&#243;n por sospecha o contagio del COVID?",
		"`prass`.`fechaconsulta`" => "En qu&#233; fecha fue dicha consulta?",
		"`prass`.`prueba`" => "Se realiz&#243; prueba confirmatoria para el COVID?",
		"`prass`.`fechaprueba`" => "En qu&#233; fecha se le realiz&#243; la prueba confirmatoria?",
		"`prass`.`estado`" => "Estado",
		"`prass`.`observacion`" => "Observacion",
		"`prass`.`encargado`" => "Encargado",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`prass`.`id`" => "id",
		"if(`prass`.`fecha`,date_format(`prass`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`prass`.`documento`" => "documento",
		"`prass`.`nombrepaciente`" => "nombrepaciente",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* Eps */" => "eps",
		"`prass`.`direccion`" => "direccion",
		"`prass`.`telefono`" => "telefono",
		"`prass`.`consulta`" => "consulta",
		"if(`prass`.`fechaconsulta`,date_format(`prass`.`fechaconsulta`,'%d/%m/%Y'),'')" => "fechaconsulta",
		"`prass`.`prueba`" => "prueba",
		"if(`prass`.`fechaprueba`,date_format(`prass`.`fechaprueba`,'%d/%m/%Y'),'')" => "fechaprueba",
		"`prass`.`estado`" => "estado",
		"`prass`.`observacion`" => "observacion",
		"`prass`.`encargado`" => "encargado",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['regimen' => 'Regimen', 'eps' => 'Eps', ];

	$x->QueryFrom = "`prass` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`prass`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`prass`.`eps` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'prass_view.php';
	$x->RedirectAfterInsert = 'prass_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Seguimiento PRASS';
	$x->TableIcon = 'resources/table_icons/vcard_add.png';
	$x->PrimaryKey = '`prass`.`id`';
	$x->DefaultSortField = '13';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Fecha', 'Documento', 'Nombre del usuario', 'Regimen', 'Eps', 'Direccion', 'Telefono', 'Recibi&#243; Consulta para atenci&#243;n por sospecha o contagio del COVID?', 'En qu&#233; fecha fue dicha consulta?', 'Se realiz&#243; prueba confirmatoria para el COVID?', 'En qu&#233; fecha se le realiz&#243; la prueba confirmatoria?', 'Estado', 'Observacion', 'Encargado', ];
	$x->ColFieldName = ['fecha', 'documento', 'nombrepaciente', 'regimen', 'eps', 'direccion', 'telefono', 'consulta', 'fechaconsulta', 'prueba', 'fechaprueba', 'estado', 'observacion', 'encargado', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/prass_templateTV.html';
	$x->SelectedTemplate = 'templates/prass_templateTVS.html';
	$x->TemplateDV = 'templates/prass_templateDV.html';
	$x->TemplateDVP = 'templates/prass_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: prass_init
	$render = true;
	if(function_exists('prass_init')) {
		$args = [];
		$render = prass_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: prass_header
	$headerCode = '';
	if(function_exists('prass_header')) {
		$args = [];
		$headerCode = prass_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: prass_footer
	$footerCode = '';
	if(function_exists('prass_footer')) {
		$args = [];
		$footerCode = prass_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}