<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/regimenes.php");
	include_once("{$currDir}/regimenes_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('regimenes');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'regimenes';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`regimenes`.`nombre`" => "nombre",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => 1,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`regimenes`.`nombre`" => "nombre",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`regimenes`.`nombre`" => "Raz&#243;n Social",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`regimenes`.`nombre`" => "nombre",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`regimenes` ";
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
	$x->ScriptFileName = 'regimenes_view.php';
	$x->RedirectAfterInsert = 'regimenes_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Regimenes';
	$x->TableIcon = 'resources/table_icons/shape_ungroup.png';
	$x->PrimaryKey = '`regimenes`.`nombre`';

	$x->ColWidth = [150, ];
	$x->ColCaption = ['Raz&#243;n Social', ];
	$x->ColFieldName = ['nombre', ];
	$x->ColNumber  = [1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/regimenes_templateTV.html';
	$x->SelectedTemplate = 'templates/regimenes_templateTVS.html';
	$x->TemplateDV = 'templates/regimenes_templateDV.html';
	$x->TemplateDVP = 'templates/regimenes_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: regimenes_init
	$render = true;
	if(function_exists('regimenes_init')) {
		$args = [];
		$render = regimenes_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: regimenes_header
	$headerCode = '';
	if(function_exists('regimenes_header')) {
		$args = [];
		$headerCode = regimenes_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: regimenes_footer
	$footerCode = '';
	if(function_exists('regimenes_footer')) {
		$args = [];
		$footerCode = regimenes_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
