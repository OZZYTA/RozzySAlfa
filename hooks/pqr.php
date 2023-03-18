<?php

	function pqr_init(&$options, $memberInfo, &$args) {
	
		return TRUE;
	}
		

	function pqr_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function pqr_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function pqr_before_insert(&$data, $memberInfo, &$args) {
		
		return TRUE;
	}



	function pqr_after_insert($data, $memberInfo, &$args) {
		require_once __DIR__ . '/MPDF/vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();

		// Buffer the following html with PHP so we can store it to a variable later
		ob_start();
		
		$hoy = date("d/m/y h:i:sa");
		$correo = sqlValue("select correo from pqr where id='" . makeSafe($data['id']) . "'");
		$maileps = sqlValue("select maileps from pqr where id='" . makeSafe($data['id']) . "'");
		$consecutivo = sqlValue("select consecutivo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		if ($consecutivo==""){
			$id= sqlValue("select id from pqr where id='" . makeSafe($data['selectedID']) . "'");
		}else{
		$id=$consecutivo;}
		$fecha= sqlValue("select fecha from pqr where id='" . makeSafe($data['id']) . "'");
		$tipoid= sqlValue("select tipoid from pqr where id='" . makeSafe($data['id']) . "'");
		$doc=sqlValue("select doc from pqr where id='" . makeSafe($data['id']) . "'");
		$nombres=sqlValue("select nombres from pqr where id='" . makeSafe($data['id']) . "'");
		$apellidos=sqlValue("select apellidos from pqr where id='" . makeSafe($data['id']) . "'");
		$eps=sqlValue("select eps from pqr where id='" . makeSafe($data['id']) . "'");
		$motivo=sqlValue("select motivo from pqr where id='" . makeSafe($data['id']) . "'");
		$descripcion=sqlValue("select descripcion from pqr where id='" . makeSafe($data['id']) . "'");
		$sexo=sqlValue("select genero from pqr where id='" . makeSafe($data['id']) . "'");
		$estado=sqlValue("select estado from pqr where id='" . makeSafe($data['id']) . "'");
		$cel=sqlValue("select telefono from pqr where id='" . makeSafe($data['id']) . "'");
		$correo=sqlValue("select correo from pqr where id='" . makeSafe($data['id']) . "'");
		$regimen=sqlValue("select regimen from pqr where id='" . makeSafe($data['id']) . "'");
		$obmotivo=sqlValue("select obmotivo from pqr where id='" . makeSafe($data['id']) . "'");
		$enfermedad=sqlValue("select enfermedad from pqr where id='" . makeSafe($data['id']) . "'");
		$consecutivo=sqlValue("select consecutivo from pqr where id='" . makeSafe($data['id']) . "'");
		$copia=$memberInfo['email'];
		$edad = sqlValue("select edad from pqr where id='" . makeSafe($data['id']) . "'");	
		$telefono = sqlValue("select telefono from pqr where id='" . makeSafe($data['id']) . "'");
		$direccion = sqlValue("select direccion from pqr where id='" . makeSafe($data['id']) . "'");
		$barrio = sqlValue("select barrio from pqr where id='" . makeSafe($data['id']) . "'");
		$poblacion = sqlValue("select poblacion from pqr where id='" . makeSafe($data['id']) . "'");
		$regimen = sqlValue("select regimen from pqr where id='" . makeSafe($data['id']) . "'");
		$cie10 = sqlValue("select enfermedad from pqr where id='" . makeSafe($data['id']) . "'");
		$enfermedad = sqlValue("select descripcion from cie10 where cie10='$cie10'");
		$eps = sqlValue("select eps from pqr where id='" . makeSafe($data['id']) . "'");
		$acudiente = sqlValue("select acudiente from pqr where id='" . makeSafe($data['id']) . "'");
		if ($acudiente==1){
			$nombreacu = sqlValue("select nombreacu from pqr where id='" . makeSafe($data['id']) . "'");
			$docacudiente = sqlValue("select docacudiente from pqr where id='" . makeSafe($data['id']) . "'");
		}else{
			$nombreacu = "";
			$docacudiente = "";
		}
		$ips = sqlValue("select servicio from pqr where id='" . makeSafe($data['id']) . "'");
		$referencia = sqlValue("select tipopqr from pqr where id='" . makeSafe($data['id']) . "'");
		$descripcion = sqlValue("select descripcion from pqr where id='" . makeSafe($data['id']) . "'");
		$motivo = sqlValue("select motivo from pqr where id='" . makeSafe($data['id']) . "'");
		$obmotivo = sqlValue("select obmotivo from pqr where id='" . makeSafe($data['id']) . "'");
		$asignado = $memberInfo['custom'][0];
		$oficio = sqlValue("select oficio from pqr where id='" . makeSafe($data['id']) . "'");
		if ($oficio==""){
			$oficio=$id;
		}
		$emailuser = $memberInfo['email'];
		$cargo = $memberInfo['custom'][1];
		$username=$memberInfo['username'];
		$groupID=$memberInfo['groupID'];
		$today = date_create($fecha);
		$fecha_format=date_format($today,"d-m-Y");
		function actual_date()  {  
		$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
		$year_now = date ("Y");  
		$month_now = date ("n");  
		$day_now = date ("j");    
		$date = $day_now . " de " . $months[$month_now] . " de " . $year_now;   
		return $date;    }  
		$date=actual_date();
		
		if ($consecutivo!=""){
			sqlValue("insert into consecutivos set id='$consecutivo'");
		}
		$pdfFilePathPQR = "PQR_No.".$id.".pdf";
		$pdfFilePathASW = "Respuesta_PQR_No.".$id.".pdf";
		$Output=$_SERVER["HTTP_HOST"];
		$folderPQR="/RozzySAlfa/documentos/PQR/";
		$folderASW="/RozzySAlfa/documentos/RESPUESTAS/";
		$OutputPQR=$Output.$folderPQR.$pdfFilePathPQR ;
		$OutputASW=$Output.$folderASW.$pdfFilePathASW ;
		$imagen = $Output."/hooks/adcLogo.png";
		
		$html = '<div id="printable"><header><center><img src="rotulo.png" alt="" width="940" align="absmiddle"/></center></header>
		
		<table width="100%" border="1">
		  <tbody>
			<tr bgcolor="#B3ACAC">
			  <td width="50%" bgcolor="#B3ACAC" height="24" valign="middle"><p><strong style="font-size: large; color: #000000;">Queja No. ' . $id . '</strong></p></td>
			  <td width="50%" valign="middle"><p><strong style="font-size: large; color: #000000;">Fecha: ' . $fecha . '</strong></p></td>
			</tr>
		  </tbody>
		</table><br>

		<table width="100%" border="1">

			<tr align="center" bgcolor="#E5E0E0">
			  <td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">USUARIO</strong></td>
		  </tr>

		</table>
		<table width="100%" border="0">
		  <tbody>
			<tr>
			  <td width="100%" height="173" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>TIPO DE DOCUMENTO</strong>: ' . $tipoid . '   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> ' . $doc . '<br>
								<strong>NOMBRE(S)</strong>: ' . $nombres . ' &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> ' . $apellidos . '<br>
								<strong>SEXO</strong>: ' . $sexo . '&ensp;  &ensp; &ensp; &ensp;<strong>EDAD</strong>:</strong> ' . $edad . '&ensp;  &ensp; &ensp; &ensp;<strong>TELEFONO:</strong> </strong>' . $telefono . '
								<br><strong>DIRECCION</strong>: ' . $direccion . '&ensp;  &ensp; &ensp; &ensp;<strong>BARRIO</strong>:</strong> ' . $barrio . '<br>
								<strong>TIPO DE REGIMEN</strong>: ' . $regimen . '&ensp;  &ensp; &ensp; &ensp;<strong>TIPO DE POBLACION</strong>:</strong> ' . $poblacion . '<br>
								<strong>ENFERMEDAD</strong>: ' . $enfermedad . '<br>
								<strong>ENTIDAD ADMINISTRADORA DEL PLAN DE BENEFICIOS EAPB</strong>: ' . $eps . '<br>
								<strong>Nombre del Acudiente (si es diferente al usuario)</strong>: ' . $nombreacu . '<br>
								<strong>Cedula del acudiente</strong>: ' . $docacudiente . '</span>
			  </p>
			</tr>
		  </tbody>
		</table>
		<table width="100%" border="1">
		  <tr align="center" bgcolor="#E5E0E0">
			<td colspan="0" nowrap="nowrap" bgcolor="#B3ACAC"><strong style="font-size: medium; color: #000000;">GENERALIDADES DE LA QUEJA</strong></td>
		  </tr>
		</table>
		<table width="100%" border="0">
		  <tbody>
			<tr>
			  <td colspan="2" valign="top" style="text-align: justify"><p><span style="color: #000000; font-size: small;"><strong>IPS O DROGUERIA QUE PRESTA EL SERVICIO</strong>: ' . $ips . ' <strong> &ensp;  &ensp; &ensp; &ensp;</strong><br>
				  <strong>REFERENCIA DE LA QUEJA(S)</strong>: ' . $referencia . ' &ensp;&ensp;&ensp;&ensp;<br>
				  <strong>DESCRIPCION</strong>: ' . $descripcion . '&ensp;<br>
				  <strong>MOTIVO</strong>: ' . $motivo . '<br>
				  <strong>OBSERVACION A MOTIVO</strong>: ' . $obmotivo . '&ensp;</span>  &ensp;
				</p>
			  </tr>
			<tr>
			  <td width="50%" valign="top"><p><strong style="color: #000000; font-size: small;">Firma del Usuario:</strong></p>
				<p>&nbsp;</p><br>
				<p>br><br><span style="color: #000000"><strong> __________________________________________ </strong><br>
			<strong>C.C ______________________________________</strong></span></p>          
			  <td width="50%" valign="bottom" style="text-align: right; font-size: x-small; color: #000000;"><br>Nombre y cargo del Funcionario de la SSM             
			</tr>
			<tr>
			  <td colspan="2" valign="top" style="text-align: right; font-size: x-small; color: #000000;"><p>Proyectó: ' . $asignado . ' - ' . $cargo . '  <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>Correo E. ' . $emailuser . '</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>  
			  </tr>
		  </tbody>
		</table>
		<footer><center><img src="footer.png" alt="" width="600" height="63" align="absmiddle"/></center></footer>
		</form>
		</div>';

		// send the captured HTML from the output buffer to the mPDF class for processing
		$mpdf->WriteHTML($html);
		$pdfFilePath = "PQR_No.$id.pdf";
		$mpdf->Output("./documentos/PQR/".$pdfFilePath, "F");
		
		
		if ($correo!="NO TIENE"){
		sqlValue("insert into mails set idpqr='$id', fecha='$hoy', eps='$eps', user='$username', groupID='$groupID', correo='$correo', asunto='Su PQR ha sido Registrada', cuerpo='Señor usuario, ha sido registrada la siguiente PQR en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
		---------------------------------------------------------------------------------------------------------------------------------<br>
			
			<b>Identificador de PQR:</b> ".$id."<br>
			<b>Fecha:</b> ".$fecha."<br>
			<b>Documento:</b> ".$tipoid.". ".$doc."<br>
			<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
			<b>Celular de PQR:</b> ".$cel."<br>
			<b>Correo Electrónico de PQR:</b> ".$correo."<br>
			<b>EPS:</b> ".$eps."<br>
			<b>Regimen:</b> ".$regimen."<br>
			<b>Motivo de la PQR:</b> ".$motivo."<br>
			<b>Observación al motivo:</b> ".$obmotivo."<br>
			<b>Estado:</b> ".$estado."<br>
			<b>Descripción:</b> ".$descripcion."<br>
			<b>Diagnóstico:</b> ".$enfermedad."<br><br>
			
			Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
			
			Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
			
			Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
			
			ATT. <br><br>
			Secretaria de Salud<br>
			Municipio de San José de Cúcuta.<br>
			by Medicontrol SAS'");	}
		
		$success = sendmail(array(
		'to' => $correo,
		'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
		'subject' => 'Su PQR ha sido Registrada',
		'message' => "Señor usuario, ha sido registrada la siguiente PQR en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
		---------------------------------------------------------------------------------------------------------------------------------<br>
			
			<b>Identificador de PQR:</b> ".$id."<br>
			<b>Fecha:</b> ".$fecha."<br>
			<b>Documento:</b> ".$tipoid.". ".$doc."<br>
			<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
			<b>Celular de PQR:</b> ".$cel."<br>
			<b>Correo Electrónico de PQR:</b> ".$correo."<br>
			<b>EPS:</b> ".$eps."<br>
			<b>Regimen:</b> ".$regimen."<br>
			<b>Motivo de la PQR:</b> ".$motivo."<br>
			<b>Observación al motivo:</b> ".$obmotivo."<br>
			<b>Estado:</b> ".$estado."<br>
			<b>Descripción:</b> ".$descripcion."<br>
			<b>Diagnóstico:</b> ".$enfermedad."<br><br>
			
			Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
			
			Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
			
			
			Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
			
			ATT. <br><br>
			Secretaria de Salud<br>
			Municipio de San José de Cúcuta.<br><img src=".$imagen.">
			<br>By Medicontrol SAS<br>"		
			
		));
		
		sqlValue("INSERT IGNORE INTO membership_userrecords (`pkValue`,`tableName`) SELECT id, 'mails' from mails");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.groupID = (SELECT mails.groupID FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.groupID is not null) WHERE `tableName`='mails'");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.memberID = (SELECT mails.user FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.user is not null) WHERE `tableName`='mails'");
		
		sendmail(array(
		'to' => $copia,
		'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
		'subject' => 'Copia: Ha sido registrada una PQR #'.$id.', '.$tipoid.'.'.$doc,
		'message' => "Ha sido registrada la siguiente PQR en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
		---------------------------------------------------------------------------------------------------------------------------------<br>
			
			<b>Identificador de PQR:</b> ".$id."<br>
			<b>Fecha:</b> ".$fecha."<br>
			<b>Documento:</b> ".$tipoid.". ".$doc."<br>
			<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
			<b>Celular de PQR:</b> ".$cel."<br>
			<b>Correo Electrónico de PQR:</b> ".$correo."<br>
			<b>EPS:</b> ".$eps."<br>
			<b>Regimen:</b> ".$regimen."<br>
			<b>Motivo de la PQR:</b> ".$motivo."<br>
			<b>Observación al motivo:</b> ".$obmotivo."<br>
			<b>Estado:</b> ".$estado."<br>
			<b>Descripción:</b> ".$descripcion."<br><br>
			
			Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
			
			Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
			
			Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
			
			ATT. <br><br>
			Secretaria de Salud<br>
			Municipio de San José de Cúcuta.<br><img src=".$imagen.">
			<br>by Medicontrol SAS<br>"
			
			
		));
		
		
		?>
			<?php
			// Require composer autoload
			require_once __DIR__ . '/MPDF/vendor/autoload.php';
			$mpdf = new \Mpdf\Mpdf();

			// Buffer the following html with PHP so we can store it to a variable later
			ob_start();

			$html = ' <div id="printable"><header><center><img src="rotulo.png" alt="" width="850" align="absmiddle"/></center></header>
			<table width="100%" border="0">
				  <tbody>
					<tr>
					  <td width="750" colspan="2" style="font-size: x-small; color: #000000;"><p><span style="color: #000000">San José de Cúcuta, ' . $date . '</span></p>
					  <p><br>
					  </p>
					  <p>&nbsp;</p>
					  <p><strong>Señor (a)</strong><br>
						<strong>' . $nombres . ' ' . $apellidos . '</strong><br>
						<strong>' . $direccion . '                  </strong> <br>
						<strong>Cúcuta </strong></p></td><br><br>
					</tr>
					<tr>
					  <td style="font-size: x-small; color: #000000;">&nbsp;</td>
					  <td style="text-align: right"><span style="text-align: right; font-size: x-small; color: #000000;"><strong>Asunto: Repuesta  a Queja No. ' . $oficio . '</strong><br>
						  <strong>Peticionario:</strong> <strong>' . $nombres . ' ' . $apellidos . '</strong><br>
					  <strong>Entidad  objeto de la Petición ' . $eps . '</strong></span></td>
					</tr>
					 <tr>
					   <td colspan="3" valign="top" style="text-align: justify; font-size: x-small; color: #000000;"><p>&nbsp;</p>
						 <p>Respetado, Señor (a):&nbsp;<strong>' . $nombres . ' ' . $apellidos . '</strong>,</p>
						 <p>&nbsp;</p>
						 <p>La Secretaria de Salud Municipal de Cúcuta ha recibido su queja el día <strong>' . $fecha_format . ', </strong> radicada en esta  entidad a través&nbsp;la Oficina Del Servicio de Atención a la Comunidad SAC.<br><br>
						Para mayor facilidad le informo que la misma&nbsp;quedó  radicada bajo el Número <strong> ' . $oficio . '</strong> de fecha <strong>' . $fecha_format . ', </strong>en la  cual manifiesta de manera libre y voluntaria la posible vulneración  de&nbsp;sus&nbsp;derechos&nbsp;en&nbsp;salud&nbsp;por&nbsp;indebida&nbsp;atención&nbsp;y/o  por encontrar barreras en la prestación de los servicios de salud  por&nbsp;parte de la entidad objeto de la comunicación.</p><br>
					  <p>A su vez, la Secretaria de Salud Municipal de Cúcuta <strong><em>actuando </em></strong>en el marco de competencias  conferidas en la Ley 715 de 2001, articulo 44, numeral 44.1.3.&rdquo; gestionar  supervisar el acceso a la prestación de los servicios de salud de la población  de su jurisdicción&rdquo;.  Y de conformidad con  lo establecido en el Decreto 780 de 2016 &ldquo;…<strong><em>Sección 1.  Seguimiento y control Artículo 2.6.1.2.1.1 Seguimiento y control del 
					  régimen  subsidiado.</em></strong><em> Las entidades territoriales vigilarán permanentemente que las EPS cumplan con  todas sus obligaciones frente a los usuarios. De evidenciarse fallas o incumplimientos  en las obligaciones de las EPS, estas serán objeto de requerimiento por parte  de las entidades territoriales para que subsanen los incumplimientos y de no  hacerlo, remitirán a la Superintendencia Nacional de Salud, los informes  correspondientes. Según lo previsto por la ley, 
					  la vigilancia incluirá el  seguimiento a los procesos de afiliación, el reporte de novedades, la garantía  del acceso a los servicios, la red contratada para la prestación de los  servicios de salud, el suministro de medicamentos, el pago a la red prestadora  de servicios, la satisfacción de los usuarios, la oportunidad en la prestación  de los servicios, la prestación de servicios de promoción y prevención, así  como otros que permitan mejorar la calidad en la atención al afiliado, 
					  sin  perjuicio de las demás obligaciones establecidas en las normas vigentes.</em></p><br>
					  <p>Procede a realizar todas las acciones tendientes para restablecer sus derechos  conculcados; para lo cual le   informo  que su petición ha sido trasladada  a esa entidad, con la instrucción&nbsp;de&nbsp;ser&nbsp;atendida y resuelta  de manera efectiva y darle respuesta escrita, a la dirección física o electrónica aportada por usted, con la mayor inmediatez posible y en todo caso, sin exceder el término de  cinco (5) días hábiles a partir de su recibo.</p>
					  <p>&nbsp;</p>
					  <p>En&nbsp;el evento de que la entidad no atienda o no dé  respuesta a su solicitud en los términos indicados,  sírvase&nbsp;informar&nbsp;a esta Secretaria de Salud de Cúcuta citando el  número único de radicación dado a su comunicación.</p>
					  <p>&nbsp;</p>
					  <p>Con el traslado a la entidad, se agota el trámite inicial de  su reclamación, sin perjuicio que,  en&nbsp;ejercicio&nbsp;de&nbsp;sus&nbsp;competencias, este&nbsp;ente  territorial, realice las actividades de seguimiento sobre el cumplimiento de  los derechos en&nbsp;salud&nbsp;y la debida atención y protección  al usuario. </p>
					  <br><p>Cordialmente,</p>
					  <p><strong>&nbsp;</strong></p>
					  <p>&nbsp;</p>
			<br><br><p><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong><br>
					  Subsecretario de  Aseguramiento y Control en Salud </p>   </tr>
			  <tr>
			  <td colspan="2"></tbody>
			</table>
			<footer><center>
			  <p>&nbsp;</p>
			  <p><img src="footer.png" alt="" width="650" align="absmiddle"/></p>
			</center></footer>
			</div>



			';

					// send the captured HTML from the output buffer to the mPDF class for processing
			$mpdf->WriteHTML($html);
			$pdfFilePath = "Respuesta_PQR_No.$id.pdf";
			$mpdf->Output("./documentos/RESPUESTAS/".$pdfFilePath, "F");



			?>	 
		
		
		<?php
		
		

		if(!$success){
		// something went wrong with mail sending .. you should handle it here ..
		}

		return TRUE;
	}

	function pqr_before_update(&$data, $memberInfo, &$args) {
		$OrderID = makeSafe($data['selectedID']);
		$res = sql("select * from pqr where id='{$OrderID}'", $eo);
		$GLOBALS['old_data'] = db_fetch_assoc($res);
		return TRUE;
	}

	function pqr_after_update($data, $memberInfo, &$args) {
		$test = utf8_encode("ñàèóñ");
		echo utf8_decode($test); 	
		$hoy = date("d/m/y h:i:sa");
		$mailsuper = sqlValue("select `eps`.`correo` FROM `eps` where eps.razonsocial='SUPERSALUD'");
		$correo = sqlValue("select correo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$maileps = sqlValue("select `eps`.`correo` FROM `eps` LEFT JOIN `pqr` ON `pqr`.`eps`=`eps`.`razonsocial` WHERE id='" . makeSafe($data['selectedID']) . "'");
		$consecutivo = sqlValue("select consecutivo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		if ($consecutivo==""){
			$id= sqlValue("select id from pqr where id='" . makeSafe($data['selectedID']) . "'");
		}else{
		$id=$consecutivo;}
		$fecha= sqlValue("select fecha from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$tipoid= sqlValue("select tipoid from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$doc=sqlValue("select doc from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$nombres=sqlValue("select nombres from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$apellidos=sqlValue("select apellidos from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$eps=sqlValue("select eps from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$cc2 = sqlValue("select correo2 from eps where razonsocial='$eps'");
		$cc3 = sqlValue("select correo3 from eps where razonsocial='$eps'");
		$motivo=sqlValue("select motivo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$condicion=sqlValue("select condicion from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$descripcion=sqlValue("select descripcion from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$estado=sqlValue("select estado from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$cel=sqlValue("select telefono from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$correo=sqlValue("select correo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$regimen=sqlValue("select regimen from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$obmotivo=sqlValue("select obmotivo from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$mailuser=sqlValue("select mailuser from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$enfermedad=sqlValue("select enfermedad from pqr where id='" . makeSafe($data['selectedID']) . "'");
		$notificado="NOTIFICADA A EPS";
		$supersalud="REMITIDA A SUPERSALUD";
		$consecutivo=sqlValue("select consecutivo from pqr where id='" . makeSafe($data['id']) . "'");
		$copia=$memberInfo['email'];
		$username=$memberInfo['username'];
		$groupID=$memberInfo['groupID'];
		$pdfFilePathPQR = "PQR_No.".$id.".pdf";
		$pdfFilePathASW = "Respuesta_PQR_No.".$id.".pdf";
		$pdfFilePathCIE = "ActaDeCierre_PQR_No.".$id.".pdf";
		$Output=$_SERVER["HTTP_HOST"];
		$folderPQR="/RozzySAlfa/documentos/PQR/";
		$folderASW="/RozzySAlfa/documentos/RESPUESTAS/";
		$folderCIE="/RozzySAlfa/documentos/ACTAS_CIERRE/";
		$OutputPQR=$Output.$folderPQR.$pdfFilePathPQR ;
		$OutputASW=$Output.$folderASW.$pdfFilePathASW ;
		$OutputCIE=$Output.$folderCIE.$pdfFilePathCIE ;
		$imagen = $Output."/hooks/adcLogo.png";
		
		if ($consecutivo!=""){
			sqlValue("INSERT INTO consecutivos set id='$consecutivo'");
		}
		
		if ($correo!="NO TIENE"){
		if($data['estado']!==$GLOBALS['old_data']['estado']){
			
			if ($condicion=="CERRADA"){
				// Require composer autoload
				require_once __DIR__ . '/MPDF/vendor/autoload.php';
				$mpdf = new \Mpdf\Mpdf();

				// Buffer the following html with PHP so we can store it to a variable later
				ob_start();

				$html = ' <div id="printable"><header><center><img src="rotulo.png" alt="" width="800" align="absmiddle"/></center></header>
				<table width="100%" border="0">
				  <tbody>
					<tr>
					  <td width="750" bgcolor="#E7E4E4" style="font-size: medium; color: #000000; text-align: center;"><p><strong>ACTA DE CIERRE PQR No. ' . $consecutivo . ' &ensp;  &ensp; &ensp; &ensp;Fecha: ' . $date . '</strong></p></td>
					</tr>
				  </tbody>
				</table><br>
				<table width="100%" border="0">
				  <tbody>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u style="color: #000000;">DATOS  DEL USUARIO:</u></strong></p></td>
					</tr>
					<tr style="font-size: small">
					  <td colspan="2" style="font-size: x-small"><p><span style="text-align: justify; color: #000000;"><strong>NOMBRE(S)</strong>: ' . $nombres . ' &ensp;&ensp;&ensp;&ensp; <strong>APELLIDO(S)</strong>:</strong> ' . $apellidos . '<br>
						  <strong>TIPO DE DOCUMENTO</strong>: ' . $tipoid . '   <strong> &ensp;  &ensp; &ensp; &ensp; No. DE DOCUMENTO:</strong> ' . $documento . '</span>      
						<p><br>
					</tr>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>GENERALIDADES  DE LA QUEJA</u></strong><u>:</u></p></td>
					</tr>
					<tr style="font-size: small; color: #000000;">
					  <td colspan="2" style="font-size: x-small"><p><strong>MOTIVO</strong> ' . $motivo . ' <br>
					  <strong>FECHA </strong>' . $fecha . ' <strong></strong></p>
					  <p>&nbsp;</p></td>
					</tr>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>DESCRIPCIÓN  DEL TRAMITE:</u></strong></p></td>
					</tr>
					<tr style="text-align: justify; color: #000000; font-size: small;"> 
					  <td colspan="2" style="font-size: x-small; text-align: justify"><p>Por medio de oficio de solicitud a la  entidad <strong>' . $eps . ' ,</strong> sobre la queja  presentada por el (la) Señor (a) mencionada anteriormente donde refiere que &ldquo;<strong><em>' . $descripcion . ' &rdquo;.</em><br></strong></p>
						<p><br>
					  </p></td>
					</tr>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center">&nbsp;</p>
					  <p align="center"><strong><u>CONCLUSIÓN  DEL TRAMITE:</u></strong></p></td>
					</tr>
					<tr style="text-align: justify; color: #000000; font-size: small;">
					  <td colspan="2" style="font-size: x-small"><p>La entidad <strong>' . $eps . ' </strong> informo que &ldquo;<strong>' . $conclusion . ' &rdquo;.</em></strong>      
						<p><br>
					</tr>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>ESTADO:</u></strong></p></td>
					</tr>
					<tr style="font-size: small; color: #000000;">
					  <td colspan="2" style="font-size: x-small"><p>Estado de la PQR: <strong>' . $estado . ' .</strong><br>
						Condición de la PQR: <strong>' . $condicion . ' .</strong><br>
					  Indicador: <strong>' . $indicador . ' .</strong></p>
					  <p>&nbsp;</p></td>
					</tr>
					<tr style="color: #000000">
					  <td colspan="2" style="font-size: medium; color: #000000; text-align: center;"><p align="center"><strong><u>APROBACIÓN:</u></strong></p></td>
					</tr>
					<tr style="font-size: small; color: #000000;">
					  <td width="50%" valign="top" style="font-size: x-small"><p><strong>Quejoso <br><br>                                                                         </strong><br><br>
					  </p>
						<p><br>
						  <br>
						</p>
						<p>Firma  _____________________________________                          
					  <br>CC. _______________________________________                       </td>
					  <td width="50%" valign="top" style="font-size: x-small"><p><strong>Subsecretario de Aseguramiento y Control en  Salud</strong>     <br> <br> 
						<br>
					  </p>
						<p><br>
						  <br><br>
						</p>
						<p>Firma _____________________________________
					  <br><strong>FRANKLIN ALEXIS HERNANDEZ PEÑALOZA</strong></td>
					</tr>
					<tr>
					  <td style="font-size: x-small">&nbsp;</td>
					  <td style="font-size: x-small">&nbsp;</td>
					</tr>
					<tr>
					  <td height="85" colspan="2" style="font-size: xx-small; text-align: right;"><p>Nombre y cargo del Funcionario de la SSM:</p>
						<p>&nbsp; </p>
					  <p>Proyectó: ' . $asignado . '  - ' . $cargo . '   <br>Revisó y aprobó: Franklin Alexis Hernández Peñaloza - Subsecretario de Aseguramiento y Control en Salud<br>
					  Correo E. ' . $emailuser . ' </p></td>
					</tr>
					
				  </tbody>
				</table>

				<br>
				<footer><center>
				  <p><span style="text-align: center"></span>&ensp;  &ensp; &ensp; &ensp;&ensp;  &ensp; &ensp; &ensp;<img src="footer.png" alt="" width="550" align="center"></p>
				</center></footer>
				</div>



				';

				// send the captured HTML from the output buffer to the mPDF class for processing
				$mpdf->WriteHTML($html);
				$pdfFilePath = "ActaDeCierre_PQR_No.$id.pdf";
				$mpdf->Output("./documentos/ACTAS_CIERRE/".$pdfFilePath, "F");


				
				sql("insert into mails set idpqr='$id', fecha='$hoy', eps='$eps', correo='$correo', user='$username', groupID='$groupID', asunto='Ha sido resuelta su PQR - Estado: CERRADA', cuerpo='Señor usuario, Su PQR ha cambiado de condición, y ha sido CERRADA, encuentre a continuación la información: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>CONDICIÓN: ".$condicion."<br></b><br>
				
				Aquí puede verificar acta de <a href=".$OutputCIE.">cierre. <br><br> </a>
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br>
				by Medicontrol SAS'", $eo);	
			
			
			$success = sendmail(array(
			'to' => $correo,
			'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
			'subject' => 'Ha sido resuelta su PQR - Estado: CERRADA',
			'message' => "Señor usuario, Su PQR ha cambiado de condición, y ha sido CERRADA, encuentre a continuación la información: <br>
			---------------------------------------------------------------------------------------------------------------------------------<br>
				
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>CONDICIÓN: ".$condicion."<br></b><br>
				
				Aquí puede verificar acta de <a href=".$OutputCIE.">cierre. <br><br> </a>
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br><img src=".$imagen.">
				<br>by Medicontrol SAS<br>"
				
			));
			
			$success = sendmail(array(
			'to' => $copia,
			'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
			'subject' => 'Ha sido resuelta su PQR - Estado: CERRADA',
			'message' => "Señor usuario, Su PQR ha cambiado de condición, y ha sido CERRADA, encuentre a continuación la información: <br>
			---------------------------------------------------------------------------------------------------------------------------------<br>
				
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>CONDICIÓN: ".$condicion."<br></b><br>
				
				Aquí puede verificar acta de <a href=".$OutputCIE.">cierre. <br><br> </a>
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br><img src=".$imagen.">
				<br>by Medicontrol SAS<br>"
				
			));
				
			}
			
			else{
			sql("insert into mails set idpqr='$id', fecha='$hoy', eps='$eps', correo='$correo', user='$username', groupID='$groupID', asunto='Ha Cambiado el Estado de su PQR', cuerpo='Señor usuario, ha cambiado el estado de su PQR radicada en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
				<b>Identificador de PQR:".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>Descripción:</b> ".$descripcion."<br>
				<b>Diagnóstico:</b> ".$enfermedad."<br><br>
				
				Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br>
				by Medicontrol SAS'", $eo);
				
				
				
			$success = sendmail(array(
			'to' => $correo,
			'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
			'subject' => 'Ha Cambiado el Estado de su PQR',
			'message' => "Señor usuario, ha cambiado el estado de su PQR radicada en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
			---------------------------------------------------------------------------------------------------------------------------------<br>
				
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>Descripción:</b> ".$descripcion."<br><br>
				
				Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br><img src=".$imagen.">
				<br>by Medicontrol SAS<br>"
				
			));
			
			$success = sendmail(array(
			'to' => $copia,
			'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
			'subject' => 'Copia: Ha Cambiado el Estado de una PQR',
			'message' => "Señor usuario, ha cambiado el estado de su PQR radicada en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
			---------------------------------------------------------------------------------------------------------------------------------<br>
				
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>Descripción:</b> ".$descripcion."<br><br>
				
				Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a> y <a href=".$OutputASW.">respuesta</a>. <br><br> 
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br><img src=".$imagen.">
				<br>by Medicontrol SAS<br>"
				
			));
			
			}
			
		
			
		}}				
				if ($data['estado'] == $notificado and $maileps!=""){
				sql("insert into mails set idpqr='$id', fecha='$hoy', eps='$eps', correo='$maileps,$cc2,$cc3', user='$username', groupID='$groupID',  asunto='PQR Registrada - Medicontrol SAS #".$id.", ".$tipoid.".".$doc."', cuerpo='Señores ".$eps.", Ha sido registrada una nueva PQR para su entidad en nuestro sistema de vigilancia y gestión.<br>
				La Secretaria de Salud del Municipio de San José de Cúcuta, en ejercicio de sus funciones de interventoria y auditoria, les recuerda el deber
				y la obligación de dar solución y cierre a estas Peticiones, Quejas o Reclamos en los terminos establecidos, con el fin de asegurar el bienestar
				de los usuarios. <br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Fecha:</b> ".$fecha."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Régimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>Descripción:</b> ".$descripcion."<br>
				<b>Diagnóstico:</b> ".$enfermedad."<br><br>
				
				Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
				Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br>
				by Medicontrol SAS'", $eo);
				
				$success = sendmail(array(
				'to' => $maileps,$cc2,$cc3,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => 'PQR Registrada - Secretaria de Salud de Cúcuta #'.$id.', '.$tipoid.'.'.$doc,
				'message' => 'Señores '.$eps.", Ha sido registrada una nueva PQR para su entidad en nuestro sistema de vigilancia y gestión.<br>
				La Secretaria de Salud del Municipio de San José de Cúcuta, en ejercicio de sus funciones de interventoria y auditoria, les recuerda el deber
				y la obligación de dar solución y cierre a estas Peticiones, Quejas o Reclamos en los terminos establecidos, con el fin de asegurar el bienestar
				de los usuarios. <br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					Se les recuerda que se debe agilizar su gestión y resolución en los terminos establecidos por la normatividad para el tipo de PQR que representa.<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
				
				if ($cc2!=""){
				$success = sendmail(array(
				'to' => $cc2,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => 'PQR Registrada - Secretaria de Salud de Cúcuta #'.$id.', '.$tipoid.'.'.$doc,
				'message' => 'Señores '.$eps.", Ha sido registrada una nueva PQR para su entidad en nuestro sistema de vigilancia y gestión.<br>
				La Secretaria de Salud del Municipio de San José de Cúcuta, en ejercicio de sus funciones de interventoria y auditoria, les recuerda el deber
				y la obligación de dar solución y cierre a estas Peticiones, Quejas o Reclamos en los terminos establecidos, con el fin de asegurar el bienestar
				de los usuarios. <br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					Se les recuerda que se debe agilizar su gestión y resolución en los terminos establecidos por la normatividad para el tipo de PQR que representa.<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
				}
				else if ($cc3!=""){
				$success = sendmail(array(
				'to' => $cc3,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => 'PQR Registrada - Secretaria de Salud de Cúcuta #'.$id.', '.$tipoid.'.'.$doc,
				'message' => 'Señores '.$eps.", Ha sido registrada una nueva PQR para su entidad en nuestro sistema de vigilancia y gestión.<br>
				La Secretaria de Salud del Municipio de San José de Cúcuta, en ejercicio de sus funciones de interventoria y auditoria, les recuerda el deber
				y la obligación de dar solución y cierre a estas Peticiones, Quejas o Reclamos en los terminos establecidos, con el fin de asegurar el bienestar
				de los usuarios. <br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					Se les recuerda que se debe agilizar su gestión y resolución en los terminos establecidos por la normatividad para el tipo de PQR que representa.<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
				}
				
				$success = sendmail(array(
				'to' => $copia,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => 'Copia: PQR Registrada - Secretaria de Salud de Cúcuta #'.$id.', '.$tipoid.'.'.$doc,
				'message' => 'Señores '.$eps.", Ha sido registrada una nueva PQR para su entidad en nuestro sistema de vigilancia y gestión.<br>
				La Secretaria de Salud del Municipio de San José de Cúcuta, en ejercicio de sus funciones de interventoria y auditoria, les recuerda el deber
				y la obligación de dar solución y cierre a estas Peticiones, Quejas o Reclamos en los terminos establecidos, con el fin de asegurar el bienestar
				de los usuarios. <br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					Se les recuerda que se debe agilizar su gestión y resolución en los terminos establecidos por la normatividad para el tipo de PQR que representa.<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
				
				
				}
				elseif ($data['estado'] == $supersalud){
				sql("insert into mails set idpqr='$id', fecha='$hoy', eps='$eps', correo='$mailsuper', user='$username', groupID='$groupID', asunto='PQR terminos vencidos - SSM Cúcuta #".$id.", ".$tipoid.".".$doc."', cuerpo='Señores SUPERSALUD, Nos compete informarles que el dia ".$fecha." fue radicada en nuestro sistema de gestión y vigilancia RozzyS,
una PQR para la EPS ".$eps.", la cual despues de notificar, vigilar y acompañar, continua sin solución habiendose vencido los terminos establecidos para el cierre de la misma. Es nuestro deber allegarles la información que a ella respecta, con el objetivo de señalar el incumplimiento de la EPS ante el ente de control.<br><br>
				A continuación remitimos el detalle de la PQR: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
				<b>Identificador de PQR:</b> ".$id."<br>
				<b>Documento:</b> ".$tipoid.". ".$doc."<br>
				<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
				<b>Celular de PQR:</b> ".$cel."<br>
				<b>Correo Electrónico de PQR:</b> ".$correo."<br>
				<b>EPS:</b> ".$eps."<br>
				<b>Regimen:</b> ".$regimen."<br>
				<b>Motivo de la PQR:</b> ".$motivo."<br>
				<b>Observación al motivo:</b> ".$obmotivo."<br>
				<b>Estado:</b> ".$estado."<br>
				<b>Descripción:</b> ".$descripcion."<br>
				<b>Diagnóstico:</b> ".$enfermedad."<br><br>
				
				Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
				
				Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
				
				Gracias por Confiar en Nosotros, estamos para servirle.<br><br>
				
				ATT. <br><br>
				Secretaria de Salud<br>
				Municipio de San José de Cúcuta.<br>
				by Medicontrol SAS'", $eo);
				
				
				$success = sendmail(array(
				'to' => $mailsuper,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => "PQR terminos vencidos - SSM Cúcuta #".$id.", ".$tipoid.'.'.$doc,
				'message' => 'Señores Supersalud,<br><br> Nos compete informarles que el día '.$fecha.', fue radicada en nuestro sistema de gestión y vigilancia RozzyS,
					una PQR para la EPS '.$eps.", la cual despues de notificar, vigilar y acompañar, continua sin solución habiendose vencido los terminos establecidos
					para el cierre de la misma. Es nuestro deber allegarles la información que a ella respecta, con el objetivo de señalar el incumplimiento de la EPS ante
					el ente de control: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
				
				$success = sendmail(array(
				'to' => $copia,
				'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
				'subject' => "Copia: PQR terminos vencidos - SSM Cúcuta #".$id.", ".$tipoid.'.'.$doc,
				'message' => 'Señores Supersalud,<br><br> Nos compete informarles que el día '.$fecha.', fue radicada en nuestro sistema de gestión y vigilancia RozzyS,
					una PQR para la EPS '.$eps.", la cual despues de notificar, vigilar y acompañar, continua sin solución habiendose vencido los terminos establecidos
					para el cierre de la misma. Es nuestro deber allegarles la información que a ella respecta, con el objetivo de señalar el incumplimiento de la EPS ante
					el ente de control: <br>
				---------------------------------------------------------------------------------------------------------------------------------<br>
					
					<b>Identificador de PQR:</b> ".$id."<br>
					<b>Fecha:</b> ".$fecha."<br>
					<b>Documento:</b> ".$tipoid.". ".$doc."<br>
					<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
					<b>Celular de PQR:</b> ".$cel."<br>
					<b>Correo Electrónico de PQR:</b> ".$correo."<br>
					<b>EPS:</b> ".$eps."<br>
					<b>Regimen:</b> ".$regimen."<br>
					<b>Motivo de la PQR:</b> ".$motivo."<br>
					<b>Observación al motivo:</b> ".$obmotivo."<br>
					<b>Estado:</b> ".$estado."<br>
					<b>Descripción:</b> ".$descripcion."<br><br>
					
					Aquí puede verificar acta de <a href=".$OutputPQR.">radicación</a>. <br><br>
					
					Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
					
					ATT. <br><br>
					Secretaria de Salud<br>
					Municipio de San José de Cúcuta.<br><img src=".$imagen.">
					<br>by Medicontrol SAS<br>"
				
				));
		
		
		
				
		}
		
		sqlValue("INSERT IGNORE INTO membership_userrecords (`pkValue`,`tableName`) SELECT id, 'mails' from mails");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.groupID = (SELECT mails.groupID FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.groupID is not null) WHERE `tableName`='mails'");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.memberID = (SELECT mails.user FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.user is not null) WHERE `tableName`='mails'");
		
		return TRUE;
	
	}
	function pqr_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {
		$hoy = date("d/m/y h:i:sa");
		$correo = sqlValue("select correo from pqr where id='" . makeSafe($data['id']) . "'");
		$maileps = sqlValue("select maileps from pqr where id='" . makeSafe($data['id']) . "'");
		if ($consecutivo==""){
			$id= sqlValue("select id from pqr where id='" . makeSafe($data['selectedID']) . "'");
		}else{
		$id=$consecutivo;}
		$fecha= sqlValue("select fecha from pqr where id='" . makeSafe($data['id']) . "'");
		$tipoid= sqlValue("select tipoid from pqr where id='" . makeSafe($data['id']) . "'");
		$doc=sqlValue("select doc from pqr where id='" . makeSafe($data['id']) . "'");
		$nombres=sqlValue("select nombres from pqr where id='" . makeSafe($data['id']) . "'");
		$apellidos=sqlValue("select apellidos from pqr where id='" . makeSafe($data['id']) . "'");
		$eps=sqlValue("select eps from pqr where id='" . makeSafe($data['id']) . "'");
		$motivo=sqlValue("select motivo from pqr where id='" . makeSafe($data['id']) . "'");
		$descripcion=sqlValue("select descripcion from pqr where id='" . makeSafe($data['id']) . "'");
		$estado=sqlValue("select estado from pqr where id='" . makeSafe($data['id']) . "'");
		$cel=sqlValue("select telefono from pqr where id='" . makeSafe($data['id']) . "'");
		$correo=sqlValue("select correo from pqr where id='" . makeSafe($data['id']) . "'");
		$regimen=sqlValue("select regimen from pqr where id='" . makeSafe($data['id']) . "'");
		$obmotivo=sqlValue("select obmotivo from pqr where id='" . makeSafe($data['id']) . "'");
		$mailuser=sqlValue("select mailuser from pqr where id='" . makeSafe($data['id']) . "'");
		$enfermedad=sqlValue("select enfermedad from pqr where id='" . makeSafe($data['id']) . "'");
		$copia=$memberInfo['email'];
		$pdfFilePathPQR = "PQR_No.".$id.".pdf";
		$pdfFilePathASW = "Respuesta_PQR_No.".$id.".pdf";
		$Output=$_SERVER["HTTP_HOST"];
		$folderPQR="/RozzySAlfa/documentos/PQR/";
		$folderASW="/RozzySAlfa/documentos/RESPUESTAS/";
		$OutputPQR=$Output.$folderPQR.$pdfFilePathPQR ;
		$OutputASW=$Output.$folderASW.$pdfFilePathASW ;
		$imagen = $Output."/hooks/adcLogo.png";
		
		$success = 	sendmail(array(
		'to' => $copia,
		'name' => 'RozzyS - Alcaldía de Cúcuta - By Medicontrol',
		'subject' => 'Ha sido eliminada la PQR #'.$id.', '.$tipoid.'.'.$doc,
		'message' => "Ha sido eliminada una PQR registrada en nuestra plataforma RozzyS para su respectiva vigilancia y gestión: <br>
		---------------------------------------------------------------------------------------------------------------------------------<br>
			
			<b>Identificador de PQR:</b> ".$id."<br>
			<b>Fecha:</b> ".$fecha."<br>
			<b>Documento:</b> ".$tipoid.". ".$doc."<br>
			<b>Nombre Completo:</b> ".$nombres." ".$apellidos."<br>
			<b>Celular de PQR:</b> ".$cel."<br>
			<b>Correo Electrónico de PQR:</b> ".$correo."<br>
			<b>EPS:</b> ".$eps."<br>
			<b>Regimen:</b> ".$regimen."<br>
			<b>Motivo de la PQR:</b> ".$motivo."<br>
			<b>Observación al motivo:</b> ".$obmotivo."<br>
			<b>Estado:</b> ".$estado."<br>
			<b>Descripción:</b> ".$descripcion."<br>
			<br><br>
			
			Favor dar respuesta a este mensaje al <b>correo electrónico:</b> ".$memberInfo['email'].".<br><br>
			
			ATT. <br><br>
			Secretaria de Salud<br>
			Municipio de San José de Cúcuta.<br><img src=".$imagen.">
			<br>by Medicontrol SAS<br>"
		));

		if(!$success){
		// something went wrong with mail sending .. you should handle it here ..
		}
		sqlValue("INSERT IGNORE INTO membership_userrecords (`pkValue`,`tableName`) SELECT id, 'mails' from mails");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.groupID = (SELECT mails.groupID FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.groupID is not null) WHERE `tableName`='mails'");
		sqlValue("UPDATE membership_userrecords SET membership_userrecords.memberID = (SELECT mails.user FROM mails WHERE mails.id = membership_userrecords.pkValue and mails.user is not null) WHERE `tableName`='mails'");
		
		return TRUE;
	}

	function pqr_after_delete($selectedID, $memberInfo, &$args) {

		return TRUE;
	}

	function pqr_dv($selectedID, $memberInfo, &$html, &$args) {
		
		if($memberInfo['group'] != 'Admins' and $memberInfo['group'] != 'Auxiliares'){
			
			ob_start(); ?>
			<script>
			$j(function(){
				if($j('[name=SelectedID]').val().length) {
					if($j('#tipoid').val().length>0){
						$j('#tipoid').prop('readonly', true);
					}	
					if($j('#procedencia').val().length>0){
						$j('#procedencia').prop('readonly', true);
					}
					if($j('#doc').val().length>0){
						$j('#doc').prop('readonly', true);
					}
					if($j('#nombres').val().length>0){
						$j('#nombres').prop('readonly', true);
					}
					if($j('#apellidos').val().length>0){
						$j('#apellidos').prop('readonly', true);
					}
					if($j('#descripcion').val().length>0){
						$j('#descripcion').prop('readonly', true);
					}
					if($j('#detalle1').val().length>0){
						$j('#detalle1').prop('readonly', true);
					}
					if($j('#detalle2').val().length>0){
						$j('#detalle2').prop('readonly', true);
					}
					if($j('#detalle3').val().length>0){
						$j('#detalle3').prop('readonly', true);
					}
					if($j('#detalle4').val().length>0){
						$j('#detalle4').prop('readonly', true);
					}
				}
			})
			</script>
			<?php
			$new_layout = ob_get_contents();
			ob_end_clean();

			$html .= $new_layout;
		}
		
		
		
		
		
		
		$mi=$memberInfo['group'];
		if ($mi !='SSM'){
			if ($mi!='Admins'){
		$html.="<script>\$j('#sac').attr('disabled', true);</script>";
		}}
		
		
		
		if ($mi!='SSM'){
		$html.="<script>\$j('#selected_records_print_multiple_dv_sdv').attr('disabled', true);</script>";
		}
		/* if this is the print preview, don't modify the detail view */
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>		
		
		
		
		
		<script>
			$j(function(){
				<?php if($selectedID){ ?>
					$j('#pqr_dv_action_buttons .btn-toolbar').append(
						'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
							'<button type="button" class="btn btn-default btn-lg" onclick="atras()">' +
								'<i class="glyphicon glyphicon-chevron-left"></i> Atrás</button>' +
							'<button type="button" class="btn btn-default btn-lg" onclick="print_pqr()">' +
								'<i class="glyphicon glyphicon-print"></i> Imprimir PQR</button>' +
							'<button type="button" class="btn btn-default btn-lg" id="oficio_print" onclick="print_respuesta()">' +
								'<i class="glyphicon glyphicon-print"></i> Respuesta</button>' +
							'<button type="button" class="btn btn-default btn-lg" id="printcierre" onclick="print_cierre()">' +
								'<i class="glyphicon glyphicon-print"></i>Acta de Cierre</button>' +
						'</div>'
					);
				<?php } ?>
		});
			
			function atras(){
				var host = document.referrer;
				var page= location.protocol + '//' + location.host + '/RozzySPRO/pqr_view.php'
				if(host==page){
					window.history.go(-2);
				}else {
					window.history.go(-1);
				} 
			}
			

			
			function print_pqr(){
				var selected_id='<?php echo urlencode($selectedID);?>';
				window.location = "pqr_pdf.php?SelectedID=" + selected_id;}
				
			function print_respuesta(){
				var selected_id='<?php echo urlencode($selectedID);?>';
				window.location = "respuesta_pdf.php?SelectedID=" + selected_id;}
				
			function print_cierre(){
				var selected_id='<?php echo urlencode($selectedID);?>';
				window.location = "ActaCierre_pdf.php?SelectedID=" + selected_id;}
			
			
		</script>
		
		
		

		
		<div id="form-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#Informacion-Usuario" data-toggle="tab">Información del Usuario</a></li>
				<li><a href="#Radicacion" data-toggle="tab">Radicación</a></li>
				<li><a href="#Gestion" data-toggle="tab">Gestión</a></li>
			</ul>
			
			<ul class="tab-content">
				<div class="tab-pane active form-horizontal" id="Informacion-Usuario"></div>
				<div class="tab-pane form-horizontal" id="Radicacion"></div>
				<div class="tab-pane form-horizontal" id="Gestion"></div>
			</ul>
		</div>
		
		<style>
			#form-tabs .nav-tabs a{ display: block !important; }
		</style>
		
		<script>
			$j(function(){
				$j('#form-tabs').appendTo('#pqr_dv_form');
				
				/* fields to move to the informacion info tab */
				$j('#id').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#fecha').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#tipoid').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#procedencia').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#doc').parents('.form-group').appendTo('#Informacion-Usuario');	
				$j('#nombres').parents('.form-group').appendTo('#Informacion-Usuario');	
				$j('#apellidos').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#genero').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#nacimiento').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#edad').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#direccion').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#barrio').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#comuna').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#telefono').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#notel').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#correo').parents('.form-group').appendTo('#Informacion-Usuario');
				$j('#nocorreo').parents('.form-group').appendTo('#Informacion-Usuario');

				
				/* fields to move to the radicacion info tab */
				$j('#sac').parents('.form-group').appendTo('#Radicacion');
				$j('#consecutivo').parents('.form-group').appendTo('#Radicacion');
				$j('#oficio').parents('.form-group').appendTo('#Radicacion');
				$j('#tipopqr').parents('.form-group').appendTo('#Radicacion');
				$j('#poblacion').parents('.form-group').appendTo('#Radicacion');
				$j('#regimen').parents('.form-group').appendTo('#Radicacion');
				$j('#eps').parents('.form-group').appendTo('#Radicacion');
				$j('#otraeps').parents('.form-group').appendTo('#Radicacion');
				$j('#gerente').parents('.form-group').appendTo('#Radicacion');
				$j('#teleps').parents('.form-group').appendTo('#Radicacion');
				$j('#maileps').parents('.form-group').appendTo('#Radicacion');
				$j('#acudiente').parents('.form-group').appendTo('#Radicacion');
				$j('#nombreacu').parents('.form-group').appendTo('#Radicacion');
				$j('#docacudiente').parents('.form-group').appendTo('#Radicacion');
				$j('#ref').parents('.form-group').appendTo('#Radicacion');
				$j('#motivo').parents('.form-group').appendTo('#Radicacion');
				$j('#obmotivo').parents('.form-group').appendTo('#Radicacion');
				$j('#fechainc').parents('.form-group').appendTo('#Radicacion');
				$j('#enfermedad').parents('.form-group').appendTo('#Radicacion');
				$j('#servicio').parents('.form-group').appendTo('#Radicacion');
				$j('#descripcion').parents('.form-group').appendTo('#Radicacion');
				
				
				/* fields to move to the gestion info tab */
				$j('#estado').parents('.form-group').appendTo('#Gestion');
				$j('#condicion').parents('.form-group').appendTo('#Gestion');
				$j('#cierre').parents('.form-group').appendTo('#Gestion');
				$j('#conclusion').parents('.form-group').appendTo('#Gestion');
				$j('#dias').parents('.form-group').appendTo('#Gestion');
				$j('#diacierre').parents('.form-group').appendTo('#Gestion');
				$j('#indicador').parents('.form-group').appendTo('#Gestion');
				$j('#detalle1').parents('.form-group').appendTo('#Gestion');
				$j('#fecha1').parents('.form-group').appendTo('#Gestion');
				$j('#detalle2').parents('.form-group').appendTo('#Gestion');
				$j('#fecha2').parents('.form-group').appendTo('#Gestion');
				$j('#detalle3').parents('.form-group').appendTo('#Gestion');
				$j('#fecha3').parents('.form-group').appendTo('#Gestion');
				$j('#detalle4').parents('.form-group').appendTo('#Gestion');
				$j('#fallecido').parents('.form-group').appendTo('#Gestion');
				$j('#status').parents('.form-group').appendTo('#Gestion');
				$j('#periodo').parents('.form-group').appendTo('#Gestion');
				$j('#asignado').parents('.form-group').appendTo('#Gestion');
				$j('#observaciones').parents('.form-group').appendTo('#Gestion');
			})
		</script>
		
		<?php
		$tabs = ob_get_contents();
		ob_end_clean();
		$html .= $tabs;
		
	}


	function pqr_csv($query, $memberInfo, &$args) {

		return $query;
	}


	function pqr_batch_actions(&$args){

		return array(
			array(
			'title' => 'No Contactado',
			'function' => 'change_to_notcontacted',
			'icon' => 'remove'
			),

		);
	}

function pqr_save_pdf(&$args){

		return array(
			array(
			'title' => 'No Contactado',
			'function' => 'change_to_notcontacted',
			'icon' => 'remove'
			),

		);
	}
	?>