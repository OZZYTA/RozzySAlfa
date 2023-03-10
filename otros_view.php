<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/otros.php");
	include_once("{$currDir}/otros_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('otros');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'otros';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`otros`.`id`" => "id",
		"if(`otros`.`fecha`,date_format(`otros`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`otros`.`asunto`" => "asunto",
		"`otros`.`sexo`" => "sexo",
		"`otros`.`tipodoc`" => "tipodoc",
		"`otros`.`procedencia`" => "procedencia",
		"`otros`.`documento`" => "documento",
		"`otros`.`nombres`" => "nombres",
		"`otros`.`apellidos`" => "apellidos",
		"if(`otros`.`nacimiento`,date_format(`otros`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`otros`.`edad`" => "edad",
		"`otros`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`otros`.`comuna`" => "comuna",
		"`otros`.`telefono`" => "telefono",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EAPB */" => "eapb",
		"`otros`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente */" => "gerente",
		"`otros`.`poblacion`" => "poblacion",
		"concat('<i class=\"glyphicon glyphicon-', if(`otros`.`acudiente`, 'check', 'unchecked'), '\"></i>')" => "acudiente",
		"`otros`.`docacu`" => "docacu",
		"`otros`.`nombreacu`" => "nombreacu",
		"`otros`.`descripcion`" => "descripcion",
		"if(`otros`.`fechaentrega`,date_format(`otros`.`fechaentrega`,'%d/%m/%Y'),'')" => "fechaentrega",
		"`otros`.`soporte1`" => "soporte1",
		"`otros`.`soporte2`" => "soporte2",
		"`otros`.`soporte3`" => "soporte3",
		"`otros`.`asignado`" => "asignado",
		"`otros`.`cargo`" => "cargo",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`otros`.`id`',
		2 => '`otros`.`fecha`',
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => '`otros`.`nacimiento`',
		11 => 11,
		12 => 12,
		13 => '`barrios1`.`nombre`',
		14 => 14,
		15 => 15,
		16 => '`regimenes1`.`nombre`',
		17 => '`eps1`.`razonsocial`',
		18 => 18,
		19 => '`eps1`.`gerente`',
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
		24 => 24,
		25 => '`otros`.`fechaentrega`',
		26 => 26,
		27 => 27,
		28 => 28,
		29 => 29,
		30 => 30,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`otros`.`id`" => "id",
		"if(`otros`.`fecha`,date_format(`otros`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`otros`.`asunto`" => "asunto",
		"`otros`.`sexo`" => "sexo",
		"`otros`.`tipodoc`" => "tipodoc",
		"`otros`.`procedencia`" => "procedencia",
		"`otros`.`documento`" => "documento",
		"`otros`.`nombres`" => "nombres",
		"`otros`.`apellidos`" => "apellidos",
		"if(`otros`.`nacimiento`,date_format(`otros`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`otros`.`edad`" => "edad",
		"`otros`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`otros`.`comuna`" => "comuna",
		"`otros`.`telefono`" => "telefono",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EAPB */" => "eapb",
		"`otros`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente */" => "gerente",
		"`otros`.`poblacion`" => "poblacion",
		"`otros`.`acudiente`" => "acudiente",
		"`otros`.`docacu`" => "docacu",
		"`otros`.`nombreacu`" => "nombreacu",
		"`otros`.`descripcion`" => "descripcion",
		"if(`otros`.`fechaentrega`,date_format(`otros`.`fechaentrega`,'%d/%m/%Y'),'')" => "fechaentrega",
		"`otros`.`soporte1`" => "soporte1",
		"`otros`.`soporte2`" => "soporte2",
		"`otros`.`soporte3`" => "soporte3",
		"`otros`.`asignado`" => "asignado",
		"`otros`.`cargo`" => "cargo",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`otros`.`id`" => "ID",
		"`otros`.`fecha`" => "Fecha",
		"`otros`.`asunto`" => "Asunto",
		"`otros`.`sexo`" => "Sexo",
		"`otros`.`tipodoc`" => "Tipo de Documento",
		"`otros`.`procedencia`" => "Pa&#237;s de Procedencia",
		"`otros`.`documento`" => "No. de Documento",
		"`otros`.`nombres`" => "Nombre(s)",
		"`otros`.`apellidos`" => "Apellido(s)",
		"`otros`.`nacimiento`" => "Fecha de Nacimiento",
		"`otros`.`edad`" => "Edad",
		"`otros`.`direccion`" => "Direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "Barrio",
		"`otros`.`comuna`" => "Comuna",
		"`otros`.`telefono`" => "Telefono",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "Regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EAPB */" => "EAPB",
		"`otros`.`otraeps`" => "Otra EPS",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente */" => "Gerente",
		"`otros`.`poblacion`" => "Tipo de Poblaci&#243;n",
		"`otros`.`acudiente`" => "Tr&#225;mite solicitado por un acudiente?",
		"`otros`.`docacu`" => "No. de Documento del Acudiente",
		"`otros`.`nombreacu`" => "Nombre del Acudiente",
		"`otros`.`descripcion`" => "Descripcion",
		"`otros`.`fechaentrega`" => "Fecha de entrega del Documento",
		"`otros`.`soporte1`" => "Soporte1",
		"`otros`.`soporte2`" => "Soporte2",
		"`otros`.`soporte3`" => "Soporte3",
		"`otros`.`asignado`" => "Nombre del Funcionario SSM",
		"`otros`.`cargo`" => "Cargo del Funcionario SSM",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`otros`.`id`" => "id",
		"if(`otros`.`fecha`,date_format(`otros`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`otros`.`asunto`" => "asunto",
		"`otros`.`sexo`" => "sexo",
		"`otros`.`tipodoc`" => "tipodoc",
		"`otros`.`procedencia`" => "procedencia",
		"`otros`.`documento`" => "documento",
		"`otros`.`nombres`" => "nombres",
		"`otros`.`apellidos`" => "apellidos",
		"if(`otros`.`nacimiento`,date_format(`otros`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`otros`.`edad`" => "edad",
		"`otros`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`otros`.`comuna`" => "comuna",
		"`otros`.`telefono`" => "telefono",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EAPB */" => "eapb",
		"`otros`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente */" => "gerente",
		"`otros`.`poblacion`" => "poblacion",
		"concat('<i class=\"glyphicon glyphicon-', if(`otros`.`acudiente`, 'check', 'unchecked'), '\"></i>')" => "acudiente",
		"`otros`.`docacu`" => "docacu",
		"`otros`.`nombreacu`" => "nombreacu",
		"`otros`.`descripcion`" => "descripcion",
		"if(`otros`.`fechaentrega`,date_format(`otros`.`fechaentrega`,'%d/%m/%Y'),'')" => "fechaentrega",
		"`otros`.`soporte1`" => "soporte1",
		"`otros`.`soporte2`" => "soporte2",
		"`otros`.`soporte3`" => "soporte3",
		"`otros`.`asignado`" => "asignado",
		"`otros`.`cargo`" => "cargo",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['barrio' => 'Barrio', 'regimen' => 'Regimen', 'eapb' => 'EAPB', ];

	$x->QueryFrom = "`otros` LEFT JOIN `barrios` as barrios1 ON `barrios1`.`nombre`=`otros`.`barrio` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`otros`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`otros`.`eapb` ";
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
	$x->AllowPrinting = (getLoggedAdmin() !== false);
	$x->AllowPrintingDV = (getLoggedAdmin() !== false);
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'otros_view.php';
	$x->RedirectAfterInsert = 'otros_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Otros Tramites - SAC SSM';
	$x->TableIcon = 'resources/table_icons/motherboard.png';
	$x->PrimaryKey = '`otros`.`id`';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Fecha', 'Asunto', 'Sexo', 'Tipo de Documento', 'No. de Documento', 'Nombre(s)', 'Apellido(s)', 'Fecha de Nacimiento', 'Edad', 'Direccion', 'Barrio', 'Telefono', 'Regimen', 'EAPB', 'Otra EPS', 'Gerente', 'Tipo de Poblaci&#243;n', 'Nombre del Funcionario SSM', ];
	$x->ColFieldName = ['fecha', 'asunto', 'sexo', 'tipodoc', 'documento', 'nombres', 'apellidos', 'nacimiento', 'edad', 'direccion', 'barrio', 'telefono', 'regimen', 'eapb', 'otraeps', 'gerente', 'poblacion', 'asignado', ];
	$x->ColNumber  = [2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20, 29, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/otros_templateTV.html';
	$x->SelectedTemplate = 'templates/otros_templateTVS.html';
	$x->TemplateDV = 'templates/otros_templateDV.html';
	$x->TemplateDVP = 'templates/otros_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: otros_init
	$render = true;
	if(function_exists('otros_init')) {
		$args = [];
		$render = otros_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: otros_header
	$headerCode = '';
	if(function_exists('otros_header')) {
		$args = [];
		$headerCode = otros_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: otros_footer
	$footerCode = '';
	if(function_exists('otros_footer')) {
		$args = [];
		$footerCode = otros_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
