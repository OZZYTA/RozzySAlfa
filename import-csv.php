<?php
	define('PREPEND_PATH', '');
	$app_dir = dirname(__FILE__);
	include_once("{$app_dir}/lib.php");

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'pqr' => function($data, $options = []) {
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['nacimiento'])) $data['nacimiento'] = guessMySQLDateTime($data['nacimiento']);
			if(isset($data['barrio'])) $data['barrio'] = pkGivenLookupText($data['barrio'], 'pqr', 'barrio');
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'pqr', 'regimen');
			if(isset($data['eps'])) $data['eps'] = pkGivenLookupText($data['eps'], 'pqr', 'eps');
			if(isset($data['cc2'])) $data['cc2'] = pkGivenLookupText($data['cc2'], 'pqr', 'cc2');
			if(isset($data['cc3'])) $data['cc3'] = pkGivenLookupText($data['cc3'], 'pqr', 'cc3');
			if(isset($data['motivo'])) $data['motivo'] = pkGivenLookupText($data['motivo'], 'pqr', 'motivo');
			if(isset($data['obmotivo'])) $data['obmotivo'] = pkGivenLookupText($data['obmotivo'], 'pqr', 'obmotivo');
			if(isset($data['fechainc'])) $data['fechainc'] = guessMySQLDateTime($data['fechainc']);
			if(isset($data['servicio'])) $data['servicio'] = pkGivenLookupText($data['servicio'], 'pqr', 'servicio');
			if(isset($data['enfermedad'])) $data['enfermedad'] = pkGivenLookupText($data['enfermedad'], 'pqr', 'enfermedad');
			if(isset($data['cierre'])) $data['cierre'] = guessMySQLDateTime($data['cierre']);
			if(isset($data['gerente'])) $data['gerente'] = thisOr($data['eps'], pkGivenLookupText($data['gerente'], 'pqr', 'gerente'));
			if(isset($data['teleps'])) $data['teleps'] = thisOr($data['eps'], pkGivenLookupText($data['teleps'], 'pqr', 'teleps'));
			if(isset($data['maileps'])) $data['maileps'] = thisOr($data['eps'], pkGivenLookupText($data['maileps'], 'pqr', 'maileps'));

			return $data;
		},
		'Encuesta' => function($data, $options = []) {
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['eps'])) $data['eps'] = pkGivenLookupText($data['eps'], 'Encuesta', 'eps');
			if(isset($data['ipsprim'])) $data['ipsprim'] = pkGivenLookupText($data['ipsprim'], 'Encuesta', 'ipsprim');

			return $data;
		},
		'barrios' => function($data, $options = []) {

			return $data;
		},
		'soportes' => function($data, $options = []) {
			if(isset($data['doc'])) $data['doc'] = pkGivenLookupText($data['doc'], 'soportes', 'doc');

			return $data;
		},
		'eps' => function($data, $options = []) {
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'eps', 'regimen');

			return $data;
		},
		'motivos' => function($data, $options = []) {

			return $data;
		},
		'obmotivos' => function($data, $options = []) {
			if(isset($data['motivo'])) $data['motivo'] = pkGivenLookupText($data['motivo'], 'obmotivos', 'motivo');

			return $data;
		},
		'cie10' => function($data, $options = []) {

			return $data;
		},
		'ips' => function($data, $options = []) {

			return $data;
		},
		'mails' => function($data, $options = []) {

			return $data;
		},
		'covid' => function($data, $options = []) {
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['nacimiento'])) $data['nacimiento'] = guessMySQLDateTime($data['nacimiento']);
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'covid', 'regimen');
			if(isset($data['eps'])) $data['eps'] = pkGivenLookupText($data['eps'], 'covid', 'eps');
			if(isset($data['cual'])) $data['cual'] = pkGivenLookupText($data['cual'], 'covid', 'cual');

			return $data;
		},
		'regimenes' => function($data, $options = []) {

			return $data;
		},
		'otros' => function($data, $options = []) {
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['nacimiento'])) $data['nacimiento'] = guessMySQLDateTime($data['nacimiento']);
			if(isset($data['barrio'])) $data['barrio'] = pkGivenLookupText($data['barrio'], 'otros', 'barrio');
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'otros', 'regimen');
			if(isset($data['eapb'])) $data['eapb'] = pkGivenLookupText($data['eapb'], 'otros', 'eapb');
			if(isset($data['fechaentrega'])) $data['fechaentrega'] = guessMySQLDateTime($data['fechaentrega']);
			if(isset($data['gerente'])) $data['gerente'] = thisOr($data['eapb'], pkGivenLookupText($data['gerente'], 'otros', 'gerente'));

			return $data;
		},
		'prass' => function($data, $options = []) {
			if(isset($data['fecha'])) $data['fecha'] = guessMySQLDateTime($data['fecha']);
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'prass', 'regimen');
			if(isset($data['eps'])) $data['eps'] = pkGivenLookupText($data['eps'], 'prass', 'eps');
			if(isset($data['fechaconsulta'])) $data['fechaconsulta'] = guessMySQLDateTime($data['fechaconsulta']);
			if(isset($data['fechaprueba'])) $data['fechaprueba'] = guessMySQLDateTime($data['fechaprueba']);

			return $data;
		},
		'oportunidad' => function($data, $options = []) {
			if(isset($data['regimen'])) $data['regimen'] = pkGivenLookupText($data['regimen'], 'oportunidad', 'regimen');
			if(isset($data['eps'])) $data['eps'] = pkGivenLookupText($data['eps'], 'oportunidad', 'eps');
			if(isset($data['fechanac'])) $data['fechanac'] = guessMySQLDateTime($data['fechanac']);
			if(isset($data['fechaorden'])) $data['fechaorden'] = guessMySQLDateTime($data['fechaorden']);
			if(isset($data['fechacita'])) $data['fechacita'] = guessMySQLDateTime($data['fechacita']);

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'pqr' => function($data, $options = []) { return true; },
		'Encuesta' => function($data, $options = []) { return true; },
		'barrios' => function($data, $options = []) { return true; },
		'soportes' => function($data, $options = []) { return true; },
		'eps' => function($data, $options = []) { return true; },
		'motivos' => function($data, $options = []) { return true; },
		'obmotivos' => function($data, $options = []) { return true; },
		'cie10' => function($data, $options = []) { return true; },
		'ips' => function($data, $options = []) { return true; },
		'mails' => function($data, $options = []) { return true; },
		'covid' => function($data, $options = []) { return true; },
		'regimenes' => function($data, $options = []) { return true; },
		'otros' => function($data, $options = []) { return true; },
		'prass' => function($data, $options = []) { return true; },
		'oportunidad' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include("{$app_dir}/hooks/import-csv.php");

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
