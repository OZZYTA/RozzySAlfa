<?php
// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/pqr.php");
	include_once("{$currDir}/pqr_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('pqr');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'pqr';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`pqr`.`id`" => "id",
		"`pqr`.`consecutivo`" => "consecutivo",
		"`pqr`.`oficio`" => "oficio",
		"if(`pqr`.`fecha`,date_format(`pqr`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`pqr`.`tipoid`" => "tipoid",
		"`pqr`.`procedencia`" => "procedencia",
		"`pqr`.`doc`" => "doc",
		"`pqr`.`nombres`" => "nombres",
		"`pqr`.`apellidos`" => "apellidos",
		"`pqr`.`genero`" => "genero",
		"if(`pqr`.`nacimiento`,date_format(`pqr`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`pqr`.`edad`" => "edad",
		"`pqr`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`pqr`.`comuna`" => "comuna",
		"`pqr`.`telefono`" => "telefono",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`notel`, 'check', 'unchecked'), '\"></i>')" => "notel",
		"`pqr`.`correo`" => "correo",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`nocorreo`, 'check', 'unchecked'), '\"></i>')" => "nocorreo",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`sac`, 'check', 'unchecked'), '\"></i>')" => "sac",
		"`pqr`.`tipopqr`" => "tipopqr",
		"`pqr`.`poblacion`" => "poblacion",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EPS */" => "eps",
		"`pqr`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente de la EPS */" => "gerente",
		"IF(    CHAR_LENGTH(`eps1`.`telefono`), CONCAT_WS('',   `eps1`.`telefono`), '') /* Telefono EPS */" => "teleps",
		"IF(    CHAR_LENGTH(`eps1`.`correo`), CONCAT_WS('',   `eps1`.`correo`), '') /* Email EPS */" => "maileps",
		"IF(    CHAR_LENGTH(`eps2`.`correo2`), CONCAT_WS('',   `eps2`.`correo2`), '') /* Cc2 */" => "cc2",
		"IF(    CHAR_LENGTH(`eps3`.`correo3`), CONCAT_WS('',   `eps3`.`correo3`), '') /* Cc3 */" => "cc3",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`acudiente`, 'check', 'unchecked'), '\"></i>')" => "acudiente",
		"`pqr`.`nombreacu`" => "nombreacu",
		"`pqr`.`docacudiente`" => "docacudiente",
		"`pqr`.`ref`" => "ref",
		"IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') /* Motivo */" => "motivo",
		"IF(    CHAR_LENGTH(`obmotivos1`.`observacion`), CONCAT_WS('',   `obmotivos1`.`observacion`), '') /* Observaci&#243;n Motivo */" => "obmotivo",
		"if(`pqr`.`fechainc`,date_format(`pqr`.`fechainc`,'%d/%m/%Y'),'')" => "fechainc",
		"IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') /* IPS o Farmacia prestadora del servicio */" => "servicio",
		"IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') /* Enfermedad o patologia */" => "enfermedad",
		"`pqr`.`descripcie10`" => "descripcie10",
		"`pqr`.`descripcion`" => "descripcion",
		"`pqr`.`estado`" => "estado",
		"`pqr`.`condicion`" => "condicion",
		"if(`pqr`.`cierre`,date_format(`pqr`.`cierre`,'%d/%m/%Y'),'')" => "cierre",
		"`pqr`.`conclusion`" => "conclusion",
		"`pqr`.`dias`" => "dias",
		"`pqr`.`diascierre`" => "diascierre",
		"`pqr`.`indicador`" => "indicador",
		"`pqr`.`detalle1`" => "detalle1",
		"`pqr`.`fecha1`" => "fecha1",
		"`pqr`.`detalle2`" => "detalle2",
		"`pqr`.`fecha2`" => "fecha2",
		"`pqr`.`detalle3`" => "detalle3",
		"`pqr`.`fecha3`" => "fecha3",
		"`pqr`.`detalle4`" => "detalle4",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`fallecido`, 'check', 'unchecked'), '\"></i>')" => "fallecido",
		"`pqr`.`status`" => "status",
		"`pqr`.`periodo`" => "periodo",
		"`pqr`.`asignado`" => "asignado",
		"`pqr`.`ingresada`" => "ingresada",
		"`pqr`.`cargada`" => "cargada",
		"`pqr`.`emailuser`" => "emailuser",
		"`pqr`.`observaciones`" => "observaciones",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`pqr`.`id`',
		2 => '`pqr`.`consecutivo`',
		3 => 3,
		4 => '`pqr`.`fecha`',
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => '`pqr`.`nacimiento`',
		12 => '`pqr`.`edad`',
		13 => 13,
		14 => '`barrios1`.`nombre`',
		15 => 15,
		16 => 16,
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => 21,
		22 => 22,
		23 => '`regimenes1`.`nombre`',
		24 => '`eps1`.`razonsocial`',
		25 => 25,
		26 => '`eps1`.`gerente`',
		27 => '`eps1`.`telefono`',
		28 => '`eps1`.`correo`',
		29 => '`eps2`.`correo2`',
		30 => '`eps3`.`correo3`',
		31 => 31,
		32 => 32,
		33 => '`pqr`.`docacudiente`',
		34 => 34,
		35 => '`motivos1`.`motivo`',
		36 => '`obmotivos1`.`observacion`',
		37 => '`pqr`.`fechainc`',
		38 => '`ips1`.`nombre`',
		39 => 39,
		40 => 40,
		41 => 41,
		42 => 42,
		43 => 43,
		44 => '`pqr`.`cierre`',
		45 => 45,
		46 => 46,
		47 => 47,
		48 => 48,
		49 => 49,
		50 => 50,
		51 => 51,
		52 => 52,
		53 => 53,
		54 => 54,
		55 => 55,
		56 => 56,
		57 => 57,
		58 => 58,
		59 => 59,
		60 => 60,
		61 => 61,
		62 => 62,
		63 => 63,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`pqr`.`id`" => "id",
		"`pqr`.`consecutivo`" => "consecutivo",
		"`pqr`.`oficio`" => "oficio",
		"if(`pqr`.`fecha`,date_format(`pqr`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`pqr`.`tipoid`" => "tipoid",
		"`pqr`.`procedencia`" => "procedencia",
		"`pqr`.`doc`" => "doc",
		"`pqr`.`nombres`" => "nombres",
		"`pqr`.`apellidos`" => "apellidos",
		"`pqr`.`genero`" => "genero",
		"if(`pqr`.`nacimiento`,date_format(`pqr`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`pqr`.`edad`" => "edad",
		"`pqr`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`pqr`.`comuna`" => "comuna",
		"`pqr`.`telefono`" => "telefono",
		"`pqr`.`notel`" => "notel",
		"`pqr`.`correo`" => "correo",
		"`pqr`.`nocorreo`" => "nocorreo",
		"`pqr`.`sac`" => "sac",
		"`pqr`.`tipopqr`" => "tipopqr",
		"`pqr`.`poblacion`" => "poblacion",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EPS */" => "eps",
		"`pqr`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente de la EPS */" => "gerente",
		"IF(    CHAR_LENGTH(`eps1`.`telefono`), CONCAT_WS('',   `eps1`.`telefono`), '') /* Telefono EPS */" => "teleps",
		"IF(    CHAR_LENGTH(`eps1`.`correo`), CONCAT_WS('',   `eps1`.`correo`), '') /* Email EPS */" => "maileps",
		"IF(    CHAR_LENGTH(`eps2`.`correo2`), CONCAT_WS('',   `eps2`.`correo2`), '') /* Cc2 */" => "cc2",
		"IF(    CHAR_LENGTH(`eps3`.`correo3`), CONCAT_WS('',   `eps3`.`correo3`), '') /* Cc3 */" => "cc3",
		"`pqr`.`acudiente`" => "acudiente",
		"`pqr`.`nombreacu`" => "nombreacu",
		"`pqr`.`docacudiente`" => "docacudiente",
		"`pqr`.`ref`" => "ref",
		"IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') /* Motivo */" => "motivo",
		"IF(    CHAR_LENGTH(`obmotivos1`.`observacion`), CONCAT_WS('',   `obmotivos1`.`observacion`), '') /* Observaci&#243;n Motivo */" => "obmotivo",
		"if(`pqr`.`fechainc`,date_format(`pqr`.`fechainc`,'%d/%m/%Y'),'')" => "fechainc",
		"IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') /* IPS o Farmacia prestadora del servicio */" => "servicio",
		"IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') /* Enfermedad o patologia */" => "enfermedad",
		"`pqr`.`descripcie10`" => "descripcie10",
		"`pqr`.`descripcion`" => "descripcion",
		"`pqr`.`estado`" => "estado",
		"`pqr`.`condicion`" => "condicion",
		"if(`pqr`.`cierre`,date_format(`pqr`.`cierre`,'%d/%m/%Y'),'')" => "cierre",
		"`pqr`.`conclusion`" => "conclusion",
		"`pqr`.`dias`" => "dias",
		"`pqr`.`diascierre`" => "diascierre",
		"`pqr`.`indicador`" => "indicador",
		"`pqr`.`detalle1`" => "detalle1",
		"`pqr`.`fecha1`" => "fecha1",
		"`pqr`.`detalle2`" => "detalle2",
		"`pqr`.`fecha2`" => "fecha2",
		"`pqr`.`detalle3`" => "detalle3",
		"`pqr`.`fecha3`" => "fecha3",
		"`pqr`.`detalle4`" => "detalle4",
		"`pqr`.`fallecido`" => "fallecido",
		"`pqr`.`status`" => "status",
		"`pqr`.`periodo`" => "periodo",
		"`pqr`.`asignado`" => "asignado",
		"`pqr`.`ingresada`" => "ingresada",
		"`pqr`.`cargada`" => "cargada",
		"`pqr`.`emailuser`" => "emailuser",
		"`pqr`.`observaciones`" => "observaciones",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`pqr`.`id`" => "ID",
		"`pqr`.`consecutivo`" => "ID PQR",
		"`pqr`.`oficio`" => "Oficio",
		"`pqr`.`fecha`" => "Fecha",
		"`pqr`.`tipoid`" => "Tipo de Doc",
		"`pqr`.`procedencia`" => "Pa&#237;s de procedencia del documento",
		"`pqr`.`doc`" => "Numero de Identificaci&#243;n:",
		"`pqr`.`nombres`" => "Nombres",
		"`pqr`.`apellidos`" => "Apellidos",
		"`pqr`.`genero`" => "Genero",
		"`pqr`.`nacimiento`" => "Nacimiento",
		"`pqr`.`edad`" => "Edad",
		"`pqr`.`direccion`" => "Direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "Barrio",
		"`pqr`.`comuna`" => "Comuna",
		"`pqr`.`telefono`" => "Telefono",
		"`pqr`.`notel`" => "No tiene telefono",
		"`pqr`.`correo`" => "Correo Electr&#243;nico",
		"`pqr`.`nocorreo`" => "No tiene correo electr&#243;nico",
		"`pqr`.`sac`" => "PQR SAC?",
		"`pqr`.`tipopqr`" => "Asunto",
		"`pqr`.`poblacion`" => "Poblacion",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "Regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EPS */" => "EPS",
		"`pqr`.`otraeps`" => "Otra EPS",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente de la EPS */" => "Gerente de la EPS",
		"IF(    CHAR_LENGTH(`eps1`.`telefono`), CONCAT_WS('',   `eps1`.`telefono`), '') /* Telefono EPS */" => "Telefono EPS",
		"IF(    CHAR_LENGTH(`eps1`.`correo`), CONCAT_WS('',   `eps1`.`correo`), '') /* Email EPS */" => "Email EPS",
		"IF(    CHAR_LENGTH(`eps2`.`correo2`), CONCAT_WS('',   `eps2`.`correo2`), '') /* Cc2 */" => "Cc2",
		"IF(    CHAR_LENGTH(`eps3`.`correo3`), CONCAT_WS('',   `eps3`.`correo3`), '') /* Cc3 */" => "Cc3",
		"`pqr`.`acudiente`" => "PQR presentada por Acudiente?",
		"`pqr`.`nombreacu`" => "Nombre Completo del Acudiente",
		"`pqr`.`docacudiente`" => "Numero de Documento del Acudiente",
		"`pqr`.`ref`" => "Referencia de la Queja",
		"IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') /* Motivo */" => "Motivo",
		"IF(    CHAR_LENGTH(`obmotivos1`.`observacion`), CONCAT_WS('',   `obmotivos1`.`observacion`), '') /* Observaci&#243;n Motivo */" => "Observaci&#243;n Motivo",
		"`pqr`.`fechainc`" => "Fecha del Incidente/Solicitud",
		"IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') /* IPS o Farmacia prestadora del servicio */" => "IPS o Farmacia prestadora del servicio",
		"IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') /* Enfermedad o patologia */" => "Enfermedad o patologia",
		"`pqr`.`descripcie10`" => "Descripcie10",
		"`pqr`.`descripcion`" => "Descripcion",
		"`pqr`.`estado`" => "Estado",
		"`pqr`.`condicion`" => "Condicion",
		"`pqr`.`cierre`" => "Fecha de Cierre",
		"`pqr`.`conclusion`" => "Conclusi&#243;n al Cierre:",
		"`pqr`.`dias`" => "Dias en apertura",
		"`pqr`.`diascierre`" => "Dias para resoluci&#243;n",
		"`pqr`.`indicador`" => "Indicador",
		"`pqr`.`detalle1`" => "Gesti&#243;n 1",
		"`pqr`.`fecha1`" => "Fecha Gesti&#243;n 1",
		"`pqr`.`detalle2`" => "Gesti&#243;n 2",
		"`pqr`.`fecha2`" => "Fecha Gesti&#243;n 2",
		"`pqr`.`detalle3`" => "Gesti&#243;n 3",
		"`pqr`.`fecha3`" => "Fecha Gesti&#243;n 3",
		"`pqr`.`detalle4`" => "Gesti&#243;n 4",
		"`pqr`.`fallecido`" => "Fallecido",
		"`pqr`.`status`" => "Status",
		"`pqr`.`periodo`" => "Periodo",
		"`pqr`.`asignado`" => "Asignado a",
		"`pqr`.`ingresada`" => "Ingresada",
		"`pqr`.`cargada`" => "Cargada",
		"`pqr`.`emailuser`" => "Emailuser",
		"`pqr`.`observaciones`" => "Observaciones",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`pqr`.`id`" => "id",
		"`pqr`.`consecutivo`" => "consecutivo",
		"`pqr`.`oficio`" => "oficio",
		"if(`pqr`.`fecha`,date_format(`pqr`.`fecha`,'%d/%m/%Y'),'')" => "fecha",
		"`pqr`.`tipoid`" => "tipoid",
		"`pqr`.`procedencia`" => "procedencia",
		"`pqr`.`doc`" => "doc",
		"`pqr`.`nombres`" => "nombres",
		"`pqr`.`apellidos`" => "apellidos",
		"`pqr`.`genero`" => "genero",
		"if(`pqr`.`nacimiento`,date_format(`pqr`.`nacimiento`,'%d/%m/%Y'),'')" => "nacimiento",
		"`pqr`.`edad`" => "edad",
		"`pqr`.`direccion`" => "direccion",
		"IF(    CHAR_LENGTH(`barrios1`.`nombre`), CONCAT_WS('',   `barrios1`.`nombre`), '') /* Barrio */" => "barrio",
		"`pqr`.`comuna`" => "comuna",
		"`pqr`.`telefono`" => "telefono",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`notel`, 'check', 'unchecked'), '\"></i>')" => "notel",
		"`pqr`.`correo`" => "correo",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`nocorreo`, 'check', 'unchecked'), '\"></i>')" => "nocorreo",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`sac`, 'check', 'unchecked'), '\"></i>')" => "sac",
		"`pqr`.`tipopqr`" => "tipopqr",
		"`pqr`.`poblacion`" => "poblacion",
		"IF(    CHAR_LENGTH(`regimenes1`.`nombre`), CONCAT_WS('',   `regimenes1`.`nombre`), '') /* Regimen */" => "regimen",
		"IF(    CHAR_LENGTH(`eps1`.`razonsocial`), CONCAT_WS('',   `eps1`.`razonsocial`), '') /* EPS */" => "eps",
		"`pqr`.`otraeps`" => "otraeps",
		"IF(    CHAR_LENGTH(`eps1`.`gerente`), CONCAT_WS('',   `eps1`.`gerente`), '') /* Gerente de la EPS */" => "gerente",
		"IF(    CHAR_LENGTH(`eps1`.`telefono`), CONCAT_WS('',   `eps1`.`telefono`), '') /* Telefono EPS */" => "teleps",
		"IF(    CHAR_LENGTH(`eps1`.`correo`), CONCAT_WS('',   `eps1`.`correo`), '') /* Email EPS */" => "maileps",
		"IF(    CHAR_LENGTH(`eps2`.`correo2`), CONCAT_WS('',   `eps2`.`correo2`), '') /* Cc2 */" => "cc2",
		"IF(    CHAR_LENGTH(`eps3`.`correo3`), CONCAT_WS('',   `eps3`.`correo3`), '') /* Cc3 */" => "cc3",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`acudiente`, 'check', 'unchecked'), '\"></i>')" => "acudiente",
		"`pqr`.`nombreacu`" => "nombreacu",
		"`pqr`.`docacudiente`" => "docacudiente",
		"`pqr`.`ref`" => "ref",
		"IF(    CHAR_LENGTH(`motivos1`.`motivo`), CONCAT_WS('',   `motivos1`.`motivo`), '') /* Motivo */" => "motivo",
		"IF(    CHAR_LENGTH(`obmotivos1`.`observacion`), CONCAT_WS('',   `obmotivos1`.`observacion`), '') /* Observaci&#243;n Motivo */" => "obmotivo",
		"if(`pqr`.`fechainc`,date_format(`pqr`.`fechainc`,'%d/%m/%Y'),'')" => "fechainc",
		"IF(    CHAR_LENGTH(`ips1`.`nombre`), CONCAT_WS('',   `ips1`.`nombre`), '') /* IPS o Farmacia prestadora del servicio */" => "servicio",
		"IF(    CHAR_LENGTH(`cie101`.`cie10`) || CHAR_LENGTH(`cie101`.`descripcion`), CONCAT_WS('',   `cie101`.`cie10`, ' - ', `cie101`.`descripcion`), '') /* Enfermedad o patologia */" => "enfermedad",
		"`pqr`.`descripcie10`" => "descripcie10",
		"`pqr`.`descripcion`" => "descripcion",
		"`pqr`.`estado`" => "estado",
		"`pqr`.`condicion`" => "condicion",
		"if(`pqr`.`cierre`,date_format(`pqr`.`cierre`,'%d/%m/%Y'),'')" => "cierre",
		"`pqr`.`conclusion`" => "conclusion",
		"`pqr`.`dias`" => "dias",
		"`pqr`.`diascierre`" => "diascierre",
		"`pqr`.`indicador`" => "indicador",
		"`pqr`.`detalle1`" => "detalle1",
		"`pqr`.`fecha1`" => "fecha1",
		"`pqr`.`detalle2`" => "detalle2",
		"`pqr`.`fecha2`" => "fecha2",
		"`pqr`.`detalle3`" => "detalle3",
		"`pqr`.`fecha3`" => "fecha3",
		"`pqr`.`detalle4`" => "detalle4",
		"concat('<i class=\"glyphicon glyphicon-', if(`pqr`.`fallecido`, 'check', 'unchecked'), '\"></i>')" => "fallecido",
		"`pqr`.`status`" => "status",
		"`pqr`.`periodo`" => "periodo",
		"`pqr`.`asignado`" => "asignado",
		"`pqr`.`ingresada`" => "ingresada",
		"`pqr`.`cargada`" => "cargada",
		"`pqr`.`emailuser`" => "emailuser",
		"`pqr`.`observaciones`" => "observaciones",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['barrio' => 'Barrio', 'regimen' => 'Regimen', 'eps' => 'EPS', 'cc2' => 'Cc2', 'cc3' => 'Cc3', 'motivo' => 'Motivo', 'obmotivo' => 'Observaci&#243;n Motivo', 'servicio' => 'IPS o Farmacia prestadora del servicio', 'enfermedad' => 'Enfermedad o patologia', ];

	$x->QueryFrom = "`pqr` LEFT JOIN `barrios` as barrios1 ON `barrios1`.`nombre`=`pqr`.`barrio` LEFT JOIN `regimenes` as regimenes1 ON `regimenes1`.`nombre`=`pqr`.`regimen` LEFT JOIN `eps` as eps1 ON `eps1`.`razonsocial`=`pqr`.`eps` LEFT JOIN `eps` as eps2 ON `eps2`.`razonsocial`=`pqr`.`cc2` LEFT JOIN `eps` as eps3 ON `eps3`.`razonsocial`=`pqr`.`cc3` LEFT JOIN `motivos` as motivos1 ON `motivos1`.`motivo`=`pqr`.`motivo` LEFT JOIN `obmotivos` as obmotivos1 ON `obmotivos1`.`observacion`=`pqr`.`obmotivo` LEFT JOIN `ips` as ips1 ON `ips1`.`nombre`=`pqr`.`servicio` LEFT JOIN `cie10` as cie101 ON `cie101`.`cie10`=`pqr`.`enfermedad` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
	$x->AllowFilters = (getLoggedAdmin() !== false);
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 25;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'pqr_view.php';
	$x->RedirectAfterInsert = 'pqr_view.php?SelectedID=#ID#';
	$x->TableTitle = 'PQR';
	$x->TableIcon = 'resources/table_icons/user_comment.png';
	$x->PrimaryKey = '`pqr`.`id`';
	$x->DefaultSortField = '`pqr`.`cierre`';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 114, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['ID PQR', 'Oficio', 'Fecha', 'Tipo de Doc', 'Numero de Identificaci&#243;n:', 'Nombres', 'Apellidos', 'Genero', 'Edad', 'Telefono', 'Correo Electr&#243;nico', 'Asunto', 'Regimen', 'EPS', 'Motivo', 'Enfermedad o patologia', 'Estado', 'Condicion', 'Fecha de Cierre', 'Dias en apertura', 'Indicador', 'Fallecido', 'Periodo', 'Asignado a', ];
	$x->ColFieldName = ['consecutivo', 'oficio', 'fecha', 'tipoid', 'doc', 'nombres', 'apellidos', 'genero', 'edad', 'telefono', 'correo', 'tipopqr', 'regimen', 'eps', 'motivo', 'enfermedad', 'estado', 'condicion', 'cierre', 'dias', 'indicador', 'fallecido', 'periodo', 'asignado', ];
	$x->ColNumber  = [2, 3, 4, 5, 7, 8, 9, 10, 12, 16, 18, 21, 23, 24, 35, 39, 42, 43, 44, 46, 48, 56, 58, 59, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/pqr_templateTV.html';
	$x->SelectedTemplate = 'templates/pqr_templateTVS.html';
	$x->TemplateDV = 'templates/pqr_templateDV.html';
	$x->TemplateDVP = 'templates/pqr_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: pqr_init
	$render = true;
	if(function_exists('pqr_init')) {
		$args = [];
		$render = pqr_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: pqr_header
	$headerCode = '';
	if(function_exists('pqr_header')) {
		$args = [];
		$headerCode = pqr_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: pqr_footer
	$footerCode = '';
	if(function_exists('pqr_footer')) {
		$args = [];
		$footerCode = pqr_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}