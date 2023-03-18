<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5 = @file_get_contents(dirname(__FILE__) . '/setup.md5');
	$thisMD5 = md5(@file_get_contents(dirname(__FILE__) . '/updateDB.php'));

	// check if setup already run
	if($thisMD5 != $prevMD5) {
		// $silent is set if this file is included from setup.php
		if(!isset($silent)) $silent = true;

		// set up tables
		setupTable(
			'pqr', " 
			CREATE TABLE IF NOT EXISTS `pqr` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`consecutivo` INT NULL,
				UNIQUE `consecutivo_unique` (`consecutivo`),
				`oficio` VARCHAR(18) NULL,
				`fecha` DATE NULL,
				`tipoid` VARCHAR(5) NOT NULL,
				`procedencia` VARCHAR(40) NULL,
				`doc` VARCHAR(40) NOT NULL,
				`nombres` CHAR(60) NOT NULL,
				`apellidos` CHAR(60) NOT NULL,
				`genero` VARCHAR(5) NOT NULL,
				`nacimiento` DATE NOT NULL,
				`edad` INT(3) NULL,
				`direccion` VARCHAR(100) NOT NULL,
				`barrio` VARCHAR(40) NOT NULL,
				`comuna` VARCHAR(40) NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`notel` VARCHAR(40) NULL,
				`correo` VARCHAR(100) NOT NULL,
				`nocorreo` VARCHAR(40) NULL,
				`sac` VARCHAR(2) NULL,
				`tipopqr` VARCHAR(20) NOT NULL,
				`poblacion` VARCHAR(40) NOT NULL,
				`regimen` VARCHAR(40) NOT NULL,
				`eps` VARCHAR(40) NOT NULL,
				`otraeps` VARCHAR(40) NULL,
				`gerente` VARCHAR(40) NULL,
				`teleps` VARCHAR(40) NULL,
				`maileps` VARCHAR(40) NULL,
				`cc2` VARCHAR(40) NULL,
				`cc3` VARCHAR(40) NULL,
				`acudiente` VARCHAR(40) NULL,
				`nombreacu` VARCHAR(40) NULL,
				`docacudiente` BIGINT NULL,
				`ref` VARCHAR(40) NOT NULL,
				`motivo` VARCHAR(40) NOT NULL,
				`obmotivo` VARCHAR(100) NOT NULL,
				`fechainc` DATE NOT NULL,
				`servicio` VARCHAR(100) NOT NULL,
				`enfermedad` VARCHAR(10) NOT NULL,
				`descripcie10` VARCHAR(10) NULL,
				`descripcion` TEXT NOT NULL,
				`estado` VARCHAR(40) NOT NULL,
				`condicion` VARCHAR(40) NOT NULL,
				`cierre` DATE NULL,
				`conclusion` TEXT NULL,
				`dias` VARCHAR(40) NULL,
				`diascierre` VARCHAR(40) NULL,
				`indicador` VARCHAR(40) NULL,
				`detalle1` TEXT NULL,
				`fecha1` VARCHAR(40) NULL,
				`detalle2` TEXT NULL,
				`fecha2` VARCHAR(40) NULL,
				`detalle3` TEXT NULL,
				`fecha3` VARCHAR(40) NULL,
				`detalle4` TEXT NULL,
				`fallecido` VARCHAR(40) NULL,
				`status` VARCHAR(40) NULL,
				`periodo` VARCHAR(40) NULL,
				`asignado` VARCHAR(40) NULL,
				`ingresada` VARCHAR(40) NULL DEFAULT '1',
				`cargada` VARCHAR(40) NULL,
				`emailuser` VARCHAR(40) NULL,
				`observaciones` VARCHAR(255) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('pqr', ['barrio','regimen','eps','cc2','cc3','motivo','obmotivo','servicio','enfermedad',]);

		setupTable(
			'Encuesta', " 
			CREATE TABLE IF NOT EXISTS `Encuesta` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`fecha` DATE NULL,
				`tipoid` VARCHAR(40) NOT NULL,
				`doc` VARCHAR(40) NOT NULL,
				`nombres` VARCHAR(40) NOT NULL,
				`apellidos` VARCHAR(40) NOT NULL,
				`eps` VARCHAR(40) NOT NULL,
				`ipsprim` VARCHAR(100) NULL,
				`tratoser` VARCHAR(40) NOT NULL,
				`cita` VARCHAR(40) NOT NULL,
				`tratoasis` VARCHAR(40) NOT NULL,
				`expprof` VARCHAR(40) NOT NULL,
				`bioser` VARCHAR(40) NOT NULL,
				`area` VARCHAR(40) NOT NULL,
				`pyp` VARCHAR(40) NOT NULL,
				`prenatal` VARCHAR(40) NOT NULL,
				`cyd` VARCHAR(40) NOT NULL,
				`vacunas` VARCHAR(40) NOT NULL,
				`pfm` VARCHAR(40) NOT NULL,
				`citologia` VARCHAR(40) NOT NULL,
				`sservicio` VARCHAR(40) NOT NULL,
				`incomodo` VARCHAR(40) NOT NULL,
				`otro` VARCHAR(40) NULL,
				`why` TEXT NULL,
				`urgencia` VARCHAR(40) NOT NULL,
				`citaoportuna` VARCHAR(40) NOT NULL,
				`aspectoeps` VARCHAR(40) NOT NULL,
				`fisicas` VARCHAR(40) NOT NULL,
				`aseo` VARCHAR(40) NOT NULL,
				`capacitacion` VARCHAR(40) NOT NULL,
				`autorizaciones` VARCHAR(40) NOT NULL,
				`general` VARCHAR(40) NOT NULL,
				`horario` VARCHAR(40) NOT NULL,
				`formulario` VARCHAR(40) NOT NULL,
				`farmacia` VARCHAR(40) NOT NULL,
				`fisicasfarma` VARCHAR(40) NOT NULL,
				`oporfarmacia` VARCHAR(40) NOT NULL,
				`totalidad` VARCHAR(40) NOT NULL,
				`cambio` VARCHAR(40) NOT NULL,
				`volver` VARCHAR(40) NOT NULL,
				`orientacion` VARCHAR(40) NOT NULL,
				`embalaje` VARCHAR(40) NOT NULL,
				`revision` VARCHAR(40) NOT NULL,
				`observaciones` TEXT NULL,
				`user` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('Encuesta', ['eps','ipsprim',]);

		setupTable(
			'barrios', " 
			CREATE TABLE IF NOT EXISTS `barrios` ( 
				`nombre` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`nombre`),
				`comuna` VARCHAR(40) NOT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'soportes', " 
			CREATE TABLE IF NOT EXISTS `soportes` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`doc` INT UNSIGNED NULL,
				`soporte1` VARCHAR(40) NULL,
				`soporte2` VARCHAR(40) NULL,
				`soporte3` VARCHAR(40) NULL,
				`soporte4` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('soportes', ['doc',]);

		setupTable(
			'eps', " 
			CREATE TABLE IF NOT EXISTS `eps` ( 
				`razonsocial` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`razonsocial`),
				`regimen` VARCHAR(40) NULL,
				`gerente` VARCHAR(40) NULL,
				`telefono` VARCHAR(40) NULL,
				`correo` VARCHAR(200) NULL,
				`correo2` VARCHAR(100) NULL,
				`correo3` VARCHAR(100) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('eps', ['regimen',]);

		setupTable(
			'motivos', " 
			CREATE TABLE IF NOT EXISTS `motivos` ( 
				`motivo` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`motivo`)
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'obmotivos', " 
			CREATE TABLE IF NOT EXISTS `obmotivos` ( 
				`motivo` VARCHAR(40) NULL,
				`observacion` VARCHAR(100) NOT NULL,
				PRIMARY KEY (`observacion`)
			) CHARSET utf8",
			$silent
		);
		setupIndexes('obmotivos', ['motivo',]);

		setupTable(
			'cie10', " 
			CREATE TABLE IF NOT EXISTS `cie10` ( 
				`cie10` VARCHAR(10) NOT NULL,
				PRIMARY KEY (`cie10`),
				`descripcion` VARCHAR(100) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'ips', " 
			CREATE TABLE IF NOT EXISTS `ips` ( 
				`nombre` VARCHAR(100) NOT NULL,
				PRIMARY KEY (`nombre`),
				`municipio` VARCHAR(40) NULL,
				`correo` VARCHAR(40) NULL,
				`direccion` VARCHAR(60) NULL,
				`telefono` VARCHAR(40) NULL,
				`gerente` VARCHAR(60) NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'mails', " 
			CREATE TABLE IF NOT EXISTS `mails` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`idpqr` VARCHAR(40) NULL,
				`fecha` VARCHAR(40) NULL,
				`eps` VARCHAR(40) NULL,
				`correo` VARCHAR(40) NULL,
				`asunto` VARCHAR(120) NULL,
				`cuerpo` LONGTEXT NULL,
				`user` VARCHAR(40) NULL,
				`groupID` INT NULL
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'covid', " 
			CREATE TABLE IF NOT EXISTS `covid` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`fecha` DATE NULL,
				`tipodoc` VARCHAR(40) NOT NULL,
				`doc` VARCHAR(40) NOT NULL,
				`nombre` VARCHAR(40) NOT NULL,
				`genero` VARCHAR(40) NOT NULL,
				`nacimiento` DATE NOT NULL,
				`edad` MEDIUMINT(3) NOT NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`regimen` VARCHAR(40) NULL,
				`eps` VARCHAR(40) NOT NULL,
				`embarazo` VARCHAR(40) NOT NULL,
				`patologia` VARCHAR(40) NULL DEFAULT '0',
				`fallecido` VARCHAR(40) NULL,
				`cual` VARCHAR(10) NULL,
				`atencion` TEXT NOT NULL,
				`tratamiento` VARCHAR(40) NOT NULL,
				`medicamentos` VARCHAR(40) NOT NULL,
				`vigilancia` VARCHAR(40) NOT NULL,
				`percepcion` VARCHAR(40) NOT NULL,
				`medicinageneral` VARCHAR(40) NULL,
				`oportunidad` VARCHAR(40) NULL,
				`observacion` TEXT NULL,
				`status` VARCHAR(40) NOT NULL,
				`responsable` VARCHAR(40) NULL,
				`periodo` VARCHAR(40) NULL,
				`asignado` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('covid', ['regimen','eps','cual',]);

		setupTable(
			'regimenes', " 
			CREATE TABLE IF NOT EXISTS `regimenes` ( 
				`nombre` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`nombre`)
			) CHARSET utf8",
			$silent
		);

		setupTable(
			'otros', " 
			CREATE TABLE IF NOT EXISTS `otros` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`fecha` DATE NULL,
				`asunto` VARCHAR(40) NOT NULL,
				`sexo` VARCHAR(40) NOT NULL,
				`tipodoc` VARCHAR(40) NOT NULL,
				`procedencia` VARCHAR(40) NULL,
				`documento` VARCHAR(40) NOT NULL,
				`nombres` VARCHAR(40) NOT NULL,
				`apellidos` VARCHAR(40) NOT NULL,
				`nacimiento` DATE NOT NULL,
				`edad` VARCHAR(40) NULL,
				`direccion` VARCHAR(40) NOT NULL,
				`barrio` VARCHAR(40) NOT NULL,
				`comuna` VARCHAR(40) NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`regimen` VARCHAR(40) NOT NULL,
				`eapb` VARCHAR(40) NOT NULL,
				`otraeps` VARCHAR(40) NULL,
				`gerente` VARCHAR(40) NULL,
				`poblacion` VARCHAR(40) NOT NULL,
				`acudiente` VARCHAR(40) NULL,
				`docacu` VARCHAR(40) NULL,
				`nombreacu` VARCHAR(40) NULL,
				`descripcion` VARCHAR(40) NULL,
				`fechaentrega` DATE NULL,
				`soporte1` VARCHAR(40) NULL,
				`soporte2` VARCHAR(40) NULL,
				`soporte3` VARCHAR(40) NULL,
				`asignado` VARCHAR(40) NULL,
				`cargo` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('otros', ['barrio','regimen','eapb',]);

		setupTable(
			'prass', " 
			CREATE TABLE IF NOT EXISTS `prass` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`fecha` DATE NULL,
				`documento` VARCHAR(40) NULL,
				`nombrepaciente` VARCHAR(40) NOT NULL,
				`regimen` VARCHAR(40) NULL,
				`eps` VARCHAR(40) NOT NULL,
				`direccion` VARCHAR(40) NOT NULL,
				`telefono` VARCHAR(40) NOT NULL,
				`consulta` VARCHAR(40) NOT NULL,
				`fechaconsulta` DATE NULL,
				`prueba` VARCHAR(40) NOT NULL,
				`fechaprueba` DATE NULL,
				`estado` VARCHAR(40) NOT NULL,
				`observacion` VARCHAR(255) NULL,
				`encargado` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('prass', ['regimen','eps',]);

		setupTable(
			'oportunidad', " 
			CREATE TABLE IF NOT EXISTS `oportunidad` ( 
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (`id`),
				`tipodoc` VARCHAR(40) NOT NULL,
				`doc` VARCHAR(40) NOT NULL,
				`nombres` VARCHAR(60) NOT NULL,
				`apellidos` VARCHAR(60) NOT NULL,
				`regimen` VARCHAR(40) NOT NULL,
				`eps` VARCHAR(40) NOT NULL,
				`fechanac` DATE NOT NULL,
				`edad` VARCHAR(3) NULL,
				`atencionreq` VARCHAR(40) NOT NULL,
				`fechaorden` DATE NULL,
				`fechacita` DATE NULL,
				`calificacion` VARCHAR(40) NOT NULL,
				`observaciones` TEXT NULL,
				`asignado` VARCHAR(40) NULL
			) CHARSET utf8",
			$silent
		);
		setupIndexes('oportunidad', ['regimen','eps',]);



		// save MD5
		@file_put_contents(dirname(__FILE__) . '/setup.md5', $thisMD5);
	}


	function setupIndexes($tableName, $arrFields) {
		if(!is_array($arrFields) || !count($arrFields)) return false;

		foreach($arrFields as $fieldName) {
			if(!$res = @db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")) continue;
			if(!$row = @db_fetch_assoc($res)) continue;
			if($row['Key']) continue;

			@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
		}
	}


	function setupTable($tableName, $createSQL = '', $silent = true, $arrAlter = '') {
		global $Translation;
		$oldTableName = '';
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)) {
			$matches = [];
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/i", $arrAlter[0], $matches)) {
				$oldTableName = $matches[1];
			}
		}

		if($res = @db_query("SELECT COUNT(1) FROM `$tableName`")) { // table already exists
			if($row = @db_fetch_array($res)) {
				echo str_replace(['<TableName>', '<NumRecords>'], [$tableName, $row[0]], $Translation['table exists']);
				if(is_array($arrAlter)) {
					echo '<br>';
					foreach($arrAlter as $alter) {
						if($alter != '') {
							echo "$alter ... ";
							if(!@db_query($alter)) {
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							} else {
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				} else {
					echo $Translation['table uptodate'];
				}
			} else {
				echo str_replace('<TableName>', $tableName, $Translation['couldnt count']);
			}
		} else { // given tableName doesn't exist

			if($oldTableName != '') { // if we have a table rename query
				if($ro = @db_query("SELECT COUNT(1) FROM `$oldTableName`")) { // if old table exists, rename it.
					$renameQuery = array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)) {
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					} else {
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				} else { // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			} else { // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)) {
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				} else {
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo '</div>';

		$out = ob_get_clean();
		if(!$silent) echo $out;
	}
