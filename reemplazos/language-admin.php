<?php

	// IMPORTANT:
	// ==========
	// When translating, only translate the strings that are
	// TO THE RIGHT OF the equal sign (=).
	//
	// Do NOT translate the strings between square brackets ([]) or <>
	//
	// Also, leave the text between < and > untranslated.
	//
	// =====================================================

	// incHeader.php
	$Translation['membership management'] = "Gestión de Miembros";
	$Translation['password mismatch'] = "La contraseña no coincide.";
	$Translation['error'] = "Error";
	$Translation['invalid email'] = "Email o correo electrónico inválido";
	$Translation['sending mails'] = "Enviar correos puede demorar algún tiempo. Por favor, no cierre esta página hasta que vea el mensaje 'Hecho'.";
	$Translation['complete step 4'] = "Complete el paso 4 seleccionando el miembro al que desea transferir registros.";
	$Translation['info'] = "Información";
	$Translation['sure move member'] = '¿Está seguro de que desea mover miembro \'<MEMBER>\' y sus datos del grupo \'<OLDGROUP>\' al grupo \'<NEWGROUP>\'?';
	$Translation['sure move data of member'] = '¿Está seguro de que desea mover los datos de los miembros \'<OLDMEMBER>\' del grupo \'<OLDGROUP>\' al miembro \'<NEWMEMBER>\' del grupo \'<NEWGROUP>\'?';
	$Translation['sure move all members'] = '¿Está seguro de que desea mover todos los miembros y datos del grupo \'<OLDGROUP>\' al grupo \'<NEWGROUP>\'?';
	$Translation['sure move data of all members'] = '¿Está seguro de que desea mover los datos de todos los miembros del grupo \'<OLDGROUP>\' al miembro \'<MEMBER>\' del grupo \'<NEWGROUP>\'?';
	$Translation['toggle navigation'] = "Alternar la navegación";
	$Translation['admin area'] = "Área de administración";
	$Translation['groups'] = "Grupos";
	$Translation['view groups'] = "Ver Grupos";
	$Translation['add group'] = "Agregar Grupo";
	$Translation['edit anonymous permissions'] = "Editar permisos anónimos";
	$Translation['members'] = "Miembros";
	$Translation['view members'] = "Ver Miembros";
	$Translation['add member'] = "Agregar Miembro";
	$Translation["view members' records"] = "Ver registros de los miembros";  
	$Translation["utilities"] = "Utilidades"; 
	$Translation["admin settings"] = "Configuraciones de administración"; 
	$Translation["rebuild thumbnails"] = "Reconstruir Miniaturas"; 
	$Translation['rebuild fields'] = "Reconstruir campos";
	$Translation['import CSV'] = "Importar datos CSV";
	$Translation['batch transfer'] = "Asistente para transferencia en lotes";
	$Translation['mail all users'] = "Enviar correo a todos los usuarios";
	$Translation['AppGini forum'] = "Soporte RozzyS";
	$Translation["user's area"] = 'Área del usuario';
	$Translation["sign out"] = "Cerrar sesión";
	$Translation["attention"] = "¡Atención!";
	$Translation['security risk admin'] = 'Está utilizando el nombre de usuario y la contraseña de administrador predeterminados. Esto es un gran riesgo para la seguridad. Por favor, cambie al menos la contraseña de administrador de la página <a href="pageSettings.php">Configuraciones de administración</a> <em>inmediatamente</em>.';
	$Translation['security risk'] = 'Está utilizando la contraseña de administrador predeterminada. Esto es un gran riesgo para la seguridad. Cambie la contraseña de administrador de la página <a href="pageSettings.php">Configuraciones de administración</a> <em>inmediatamente</em>.' ;
	$Translation['plugins'] = 'Plugins';

	//pageAssignOwners.php
	$Translation["assigned table records to group"] = "Asignado <NUMBER> registros de la tabla '<TABLE>' al grupo '<GROUP>'";
	$Translation["assigned table records to group and member"] = "Asignado <NUMBER> registros de la tabla '<TABLE>' al grupo '<GROUP>' , miembro '<MEMBERID>'";
	$Translation['data ownership assign'] = "Asignar propiedad a dNuevo grupo de propietariosatos que no tienen propietarios";
	$Translation['records ownership done'] = "Todos los registros de todas las tablas tienen propietarios ahora.<br>Volver a la <a href='pageHome.php'>Portada de Administración</a>.";
	$Translation['select group'] = "Seleccionar grupo";
	$Translation['data ownership'] = "A veces, es posible que tenga tablas con datos que se especificaron antes de implementar este sistema de administración de RozzyS, o que se hayan introducido con otras aplicaciones que no forman parte del sistema de RozzyS. Estos datos actualmente no tienen propietarios. Esta página le permite asignar grupos de propietarios y miembros propietarios a estos datos.";
	$Translation["table"] = "Tabla";
	$Translation["records with no owners"] = "Registros sin propietarios";
	$Translation["new owner group"] = "Nuevo grupo de propietarios";
	$Translation["new owner member"] = "Nuevo miembro propietario*";	
	$Translation["cancel"] = "Cancelar";
	$Translation["assign new owners"] = "Asignar nuevos propietarios";
	$Translation["please wait"] = "Por favor espere ...";	
	$Translation["if no owner member assigned"] = '* Si no asigna ningún miembro propietario aquí, todavía puede utilizar el <a href="pageTransferOwnership.php">Asistente de transferencia en lote/batch</a> más tarde.';
	
	//pageDeleteGroup.php
	$Translation["can not delete group remove members"] = 'No se puede eliminar este grupo. Por favor, quite los miembros primero.';
	$Translation["can not delete group transfer records"] = 'No se puede eliminar este grupo. Por favor, transfiera sus registros de datos a otro grupo primero..';
	
	//pageEditGroup.php
	$Translation["group exists error"] = "Error: El nombre del grupo ya existe. Debe elegir un nombre de grupo único.";
	$Translation["group not found error"] = "Error: Grupo no encontrado!";								 	
	$Translation["edit group"] = "Editar Grupo '<GROUPNAME>'";
	$Translation["add new group"] = "Agregar nuevo grupo";
	$Translation["anonymous group attention"] = "¡Atención! Este es el grupo anónimo.";
	$Translation["show tool tips"] = "Mostrar sugerencias de herramientas a medida que el ratón se mueve sobre las opciones";
	$Translation["group name"] = "Nombre del grupo";
	$Translation["readonly group name"] = "El nombre del grupo anónimo es de solo lectura aquí.";
	$Translation["anonymous group name"] = "Si nombra al grupo '<ANONYMOUSGROUP>', será considerado el grupo anónimo<br>que define los permisos de los visitantes invitados que no inician sesión en el sistema.";
	$Translation["description"] = "Descripción";
	$Translation["allow visitors sign up"] = '¿Permitir que los visitantes se registren?';
	$Translation["admin add users"] = "No. Solo el administrador puede agregar usuarios.";
	$Translation["admin approve users"] = "Sí, y el administrador debe aprobarlos.";
	$Translation["automatically approve users"] = "Sí, y aprobarlos automáticamente.";
	$Translation["group table permissions"] = "Tabla de permisos para este grupo";
	$Translation["no"] = "No";
	$Translation["owner"] = "Propietario";
	$Translation["group"] = "Grupo";
	$Translation["all"] = "Todos";
	$Translation["insert"] = "Insertar";
	$Translation["view"] = "Ver";
	$Translation["edit"] = "Editar";
	$Translation["delete"] = "Borrar";
	$Translation["save changes"] = "Guardar cambios";
	
	//pageEditMember.php
	$Translation["username error"] = "Error: El nombre de usuario ya existe o es inválido. Asegúrese de proporcionar un nombre de usuario que contenga de 4 a 20 caracteres válidos.";
	$Translation["member not found"] = "Error: Miembro no encontrado!";
	$Translation["user has special permissions"] = "Este usuario tiene permisos especiales que anulan sus permisos de grupo.";
	$Translation["user has group permissions"] = 'Este usuario hereda los <a href="pageEditGroup.php?groupID=<GROUPID>">permisos de su grupo</a>.';
	$Translation["set user special permissions"] = 'Establezca permisos especiales para este usuario';
	$Translation["sure continue"] = "Si ha realizado algún cambio en este miembro y aún no los ha guardado, se perderán si continúa. ¿Está seguro de que desea continuar?";
	$Translation["edit member"] = "Editar miembro <MEMBERID>" ;
	$Translation["add new member"] = "Agregar nuevo miembro";
	$Translation["anonymous guest member"] = "¡Atención! Este es el miembro anónimo (invitado).";
	$Translation["admin member"] = '¡Atención! Este es el miembro administrador. No puede cambiar el nombre de usuario, contraseña o correo electrónico de este miembro aquí, pero puede hacerlo en la página <a href="pageSettings.php">configuración de administración</a>.';
	$Translation["member username"] = "Nombre de usuario del miembro";
	$Translation["check availability"] = "Comprobar disponibilidad";
	$Translation["read only username"] = "El nombre de usuario del miembro invitado es de solo lectura.";
	$Translation["password"] = "Contraseña";
	$Translation["change password"] = "Escriba una contraseña solo si desea cambiar la contraseña <br>del miembro. De lo contrario, deje este campo vacío.";
	$Translation["confirm password"] = "Confirmar contraseña";
	$Translation["email"] = "Email";
	$Translation["approved"] = "Aprobado?";
	$Translation["banned"] = "Bloqueado?";
	$Translation["comments"] = "Comentarios";
	$Translation["back to members"] = "Volver a miembros";
	$Translation["member added"] = "Miembro <USERNAME> agregado exitosamente";
	
	//pageEditMemberPermissions.php
	$Translation["member permissions saved"] = "Los permisos de los miembros se han guardado correctamente.";
	$Translation["member permissions reset"] = "Los permisos de miembro se han restablecido al mismo que su grupo.";
	$Translation["user table permissions"] = "Permisos de tabla para el usuario <a href='pageEditMember.php?memberID=<MEMBER>' title='Ver detalles de miembro'><MEMBERID></a> de grupo <a href='pageEditGroup.php?groupID=<GROUPID>'  title='Ver detalles y permisos de grupo'><GROUP></a>";
	$Translation["no member permissions"] = 'Este miembro no posee actualmente ningún permiso especial. Esta lista muestra los permisos de su grupo.';
	$Translation["reset member permissions"] = "Restablecer permisos de miembro";
	$Translation["remove special permissions"] = 'Esto eliminaría todos los permisos especiales de este usuario y tendrá los mismos permisos que su grupo. ¿Seguro que quieres hacer eso?';
	
	//pageEditOwnership.php
	$Translation["invalid table"] = "Tabla inválida.";
	$Translation["invalid primary key"] = "Valor de clave primaria inválida";
	$Translation["record not found"] = "Registro no encontrado ... si fue importado externamente, intente asignando un propietario desde el área de administración.";
	$Translation["invalid username"] = "Nombre de usuario inválido";
	$Translation["record not found error"] = "Error: Registro no encontrado!";
	$Translation["edit Record Ownership"] = "Editar registro de propietario";
	$Translation["owner group"] = "Propietario del grupo";
	$Translation["view all records by group"] = "Ver todos los registros asociados a este grupo";
	$Translation["owner member"] = "Miembro propietario";
	$Translation["view all records by member"] = "Ver todos los registros asociados a miembro";
	$Translation["switch record ownership"] = "Si quiere intercambiar el propietario o dueño de este registro a un miembro de otro grupo, usted debe cambiar primero el propietario o dueño del grupo y guardar cambios.";
	$Translation["record created on"] = "Registro creado en fecha";
	$Translation["record modified on"] = "Registro modificado en fecah";
	$Translation["view all records of table"] = "Ver todos los registros de esta tabla";
	$Translation["record data"] = "Dato del registro";
	$Translation["print"] = "Imprimir";
	$Translation["could not retrieve field list"] = "No es posible recuperar la lista de campos de la tabla '<TABLENAME>'";
	$Translation["field name"] = "Nombre del campo";
	$Translation["value"] = "Valor";
	
	//pageHome.php
	$Translation["visitor sign up"] = '<a href="../membership_signup.php" target="_blank">Registro de visitantes</a> está deshabilitado porque no hay grupos donde los visitantes puedan registrarse actualmente. Para permitir el registro de visitantes, configure al menos un grupo para permitir el registro de visitantes.';
	$Translation["table data without owner"] = 'Tienes datos en una o más tablas que no tienen propietario. Para asignar un grupo de propietarios para estos datos, haga <a href="pageAssignOwners.php">click aquí</a>.';
	$Translation["membership management homepage"] = "Página de inicio de gestión de membresía";
	$Translation["newest updates"] = "Actualizaciones más recientes";
	$Translation["view record details"] = "Ver detalles del registro";
	$Translation["newest entries"] = "Entradas más recientes";
	$Translation["available add-ons"] = "Complementos/add-ons habilitados";
	$Translation["more info"] = "Más información";
	$Translation["close"] = "Cerrar";
	$Translation["view add-ons"] = "Ver todos los complementos/add-ons";
	$Translation["top members"] = "Miembros Top";
	$Translation["edit member details"] = "Editar detalles de miembros";
	$Translation["view member records"] = "Ver registros de datos de miembros";
	$Translation["records"] = "registros";
	$Translation["members stats"] = "Estadísticas de miembros";
	$Translation["total groups"] = "Total de grupos";
	$Translation["active members"] = "Miembros activos";
	$Translation["view active members"] = "Ver miembros activos";
	$Translation["members awaiting approval"] = "Miembros en espera de aprobación";
	$Translation["view members awaiting approval"] = "Ver miembros esperando aprobación";
	$Translation["banned members"] = "Miembros bloqueados";
	$Translation["view banned members"] = "Ver miembros bloqueados";
	$Translation["total members"] = "Total de miembros";
	$Translation["view all members"] = "Ver todos los miembros";
	$Translation["BigProf tweets"]  = "Tweets DE BigProf Software";
	$Translation["follow BigProf"] = "Seguir a @bigprof";
	$Translation["loading bigprof feed"] = "Cargando feed de @bigprof ...";
	$Translation["remove feed"] = "Quitar feed";
	
	//pageMail.php
	$Translation["can not send mail"] = "Por el momento no puede enviar correos electrónicos. En remitente configurado para enviar correos electrónicos no es válido.	Por favor <a href='pageSettings.php'>corrija primero esto</a> e inténtelo nuevamente.";
	$Translation["all groups"] = "Todos los grupos";
	$Translation["no recipient"] = "No se pudo encontrar el destinatario. Asegúrese de proporcionar un destinatario válido.";
	$Translation["invalid subject line"] = "Línea de asunto no válida.";
	$Translation["no recipient found"] = "No se pudo encontrar ningún destinatario. Asegúrese de proporcionar un destinatario válido.";
	$Translation["mail queue not saved"] = "No se pudo guardar la cola de correo. Asegúrese de que el directorio '<CURRDIR>' poseee permisos de escritura (chmod 755 or chmod 777).";
	$Translation["send mail"]  = "Enviar mensaje de correo electrónico a un miembro o grupo";
	$Translation["send mail to all members"] = "Está enviando un correo electrónico a todos los miembros. Esto podría llevar mucho tiempo y afectar el rendimiento de su servidor. Si tiene una gran cantidad de miembros, no recomendamos enviar correos electrónicos a todos a la vez.";
	$Translation["from"] = "De";
	$Translation["change setting"] = "Cambiar esta configuración";
	$Translation["to"] = "Para";
	$Translation["subject"] = "Asunto";
	$Translation["message"] = "Mensaje";
	$Translation["send message"] = "Enviar Mensaje";
	
	//pagePrintRecord.php
	$Translation["record details"] = "Gestión de miembros -- Detalles de registros";
	$Translation['table name'] = "Tabla: <TABLENAME>";
	
	//pageRebuildFields.php
	$Translation['create or update table'] = "Un intento de <ACTION> al campo <i><FIELD></i> en la tabla <i><TABLE></i> ha sido realizado ejecutando lo siguiente: <pre><QUERY></pre> Los resultados se detallan abajo.";

	$Translation['view or rebuild fields'] = "Ver/Reconstruir campos";
	$Translation['show deviations only'] = "Mostrar solo desviaciones";
	$Translation['show all fields'] = "Mostrar todos los campos";
	$Translation['compare tables page'] = "Esta página compara las estructuras/esquemas de las tablas y campos así como fueron diseñadas en RozzyS con la estructura de la base de datos actual y permite coreegir cualquier desviación o diferencia.";
	$Translation['field'] = "Campo";
	$Translation['AppGini definition'] = "Definición RozzyS";
	$Translation['database definition'] = "Actual definición en la base de datos";
	$Translation['table name title'] = "Tabla <TABLENAME>";
	$Translation['does not exist'] = "No existe!";
	$Translation['create field'] = "Crear el campo ejecutando la consulta ADD COLUMN.";
	$Translation['create it'] = "Crea";
	$Translation['fix field'] = "Ajuste el campo ejecutando la consulta ALTER COLUMN para que su definición sea la misma que en RozzyS.";
	$Translation['fix it'] = "Corregir";
	$Translation['field update warning'] = "CUIDADO!! En algunos casos, esto podría provocar la perdida de datos, truncamiento, o corrupción de los mismos. Podría ser una mejor idea en algunas ocasiones actualizar el campo en RozzyS para coincidir con la base de datos. Está decidido a continuar?";
	$Translation['no deviations found'] = "No se han encontrado desviaciones o diferencias. Todos los campos están OK!";
	$Translation['error fields'] = "Se han encontrado <CREATENUM> campos inexistentes que necesitan ser creados.<br>Se han encontrado <UPDATENUM> campos diferentes deviating que necesitan ser actualizados.";
	
	//pageRebuildThumbnails.php
	$Translation['rebuild thumbnails'] = "Reconstruir miniaturas";
	$Translation['thumbnails utility'] = "Use esta utilidad si tiene uno o más campos de imágenes en una tabla que no posee miniaturas o tiene miniaturas con dimensiones incorrectas.";
	$Translation['rebuild thumbnails of table'] = "Reconstruir miniaturas de la tabla";
	$Translation['rebuild'] = "Reconstruir";
	$Translation['rebuild thumbnails of table_name'] = "Reconstruyendo miniaturas de la tabla '<i><TABLENAME></i>' ...";
	$Translation['do not close page message'] = "No cierre esta página hasta que vea un mensaje de confirmación de que las miniaturas han sido construidas.";	
	$Translation['rebuild thumbnails status'] = "Estado: aún se están reconstruyendo las miniaturas, por favor espere ...";
	$Translation['building field thumbnails'] =  "Construyendo miniaturas para el campo '<i><FIELD></i>' ...";
	$Translation['done'] = "Realizado.";
	$Translation['finished status'] = "Estado: finalizdo. Usted puede cerrar esta página ahora.";
	
	//pageSender.php
	$Translation['invalid mail queue'] = "Cola de email inválida.";
	$Translation['sending message failed'] = " -- Enviando mensaje a '<EMAIL>': Fallado.";
	$Translation['sending message ok'] = " -- Enviando mensaje a '<EMAIL>': Ok.";
	$Translation['done!'] = "Realizado!";
	$Translation['close page'] = "Usted debe cerrar esta página ahora or navegar a alguna otra página.";
	$Translation['mail log'] = "Registro de log de email:";
	
	//pageSettings.php
	$Translation['invalid security token'] = 'Token de seguridad inválido! Por favor <a href="pageSettings.php">recarga la página</a> e inténtelo de nuevo.';
	$Translation['unique admin username error'] = "El nuevo usuario administrador The new admin username ya ha sido tomado por otro miembro. Por favor asegúrese de que el nuevo usuario admin sea único.";	
	$Translation['unique anonymous username error'] = 'El nuevo nombre de usuario anónimo ya ha sido tomado por otro miembro. Por favor asegúrese de que el nombre de usuario proveído es único.';
	$Translation['unique anonymous group name error'] = 'El nuevo grupo anómino ya ha sido usado por otro grupo. Por favor asegúrese de que el nombre de grupo proveído es único.';
	$Translation['admin password mismatch'] = '"Contraseña de Admin" y "Confirmar contraseña" no coinciden.';
	$Translation['invalid sender email'] = '"Remitente de  email" inválido.';
	$Translation['errors occurred'] = "Han ocurrido los siguientes errores:";
	$Translation['go back'] = 'Por favor <a href="pageSettings.php" onclick="history.go(-1); return false;">vuelva atrás</a> para corregir el/los error(es) e intente de nuevo.';
	$Translation['record updated automatically'] = "Registro actualizado automáticamente en fecha <DATE>";
	$Translation['admin settings saved'] = "Configuraciones de Admin guardadas exitosamente.<br>Volver atrás <a href=\"pageSettings.php\">Configuraciones de Admin</a>.";
	$Translation['admin settings not saved'] = "Las Confguraciones de Admin no se han guardado. Motivos de falla: <ERROR><br>Volver a <a href=\"pageSettings.php\" onclick=\"history.go(-1); return false;\">Configuraciones de Admin</a>.";
	$Translation['show tool tips'] = 'Mostrar tool tips lal mover el mouse sobre las opciones';
	$Translation['admin username'] = "Nombre de usuario de Admin";
	$Translation['admin password'] = "Contraseña de Admin";
	$Translation['change admin password'] = "Ingrese una contraseña solo si desea cambiar la contraseña de Admin.";
	$Translation['sender email'] = "Remitente de email";
	$Translation['sender name and email'] = "Nombre del remitente e emair se utilizan en el campo 'Para' al enviar";
	$Translation['email messages'] = "Mensaje de correo electrónico a grupos o miembros.";
	$Translation['admin notifications'] = "Notificaciones de Admin";
	$Translation['no email notifications'] = "No hay correos electrónicos de notificación a admin.";
	$Translation['member waiting approval'] = "Notificar a admin solo cuando un nuevo miembro está esparando aprobación.";
	$Translation['new sign-ups'] = "Notificar a admin por todos los nuevos registros.";
	$Translation['sender name'] = "Nombre de remitente";
	$Translation['members custom field 1'] = "Campo personalizado de Miembros 1";
	$Translation['members custom field 2'] = "Campo personalizado de Miembros 2";
	$Translation['members custom field 3'] = "Campo personalizado de Miembros 3";
	$Translation['members custom field 4'] = "Campo personalizado de Miembros 4";
	$Translation['member approval email subject'] = "Aprobación de miembros<br>asunto de email";
	$Translation['member approval email subject control'] = "Cuando admin aprueba un miembro, el miembro es notificado por<br>email de que fue aprobado. Usted puede controlar el<br>email de aprobación en esta caja de texto,  y el contenido en la caja de dtexo de abajo.";
	$Translation['member approval email message'] = "Mensaje de email de <br>aprobación de miembro";
	$Translation['MySQL date'] = "Cadena de formato de <br>fecha MySQL";
	$Translation['MySQL reference'] = 'Por favor consultar <a href="http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date-format" target="_blank">las referencias MySQL</a> para posibles formatos.';
	$Translation['PHP short date'] = "Cadena de fecha<br> corta en PHP ";
	$Translation['PHP manual'] = 'Por favor consultar <a href="http://www.php.net/manual/en/function.date.php" target="_blank">el manual PHP </a> para posibles formatos.'; 
	$Translation['PHP long date'] = "Cadena de formato <br>de Fecha larga PHP ";
	$Translation['groups per page'] = "Grupos por página";
	$Translation['members per page'] = "Miembros por página";
	$Translation['records per page'] = "Registros por página";
	$Translation['default sign-up mode'] = "Modo de registro por defecto <br>para nuevos grupos";
	$Translation['no sign-up allowed'] = "No permitir registros. Solo el admin puede agregar miembros.";
	$Translation['admin approve members'] = "Registro habilitado, pero el admin debe aprobar miembros.";
	$Translation['automatically approve members'] = "egistro habilitado, y automáticamente se aprueban los miembros.";
	$Translation['anonymous group'] = "Nombre del grupo <br>anómino";
	$Translation['anonymous user name'] = "Nombre del usuario <br>anónimo";
	$Translation['hide twitter feed'] = "Ocultar el feed de Twitter en la portada de admin?";
	$Translation['twitter feed'] = "Nuestro feed de Twitter feed te ayuda a mantenerte informado sobre nuestras nuevaas noticias, recursos útiles, nuevos entregas, y muchos otros útiles tips.";
	
	//pageTransferOwnership.php
	$Translation['invalid source member'] = "Origen de miembro seleccionado no válida.";
	$Translation['invalid destination member'] = "Destino de miembro seleccionado no válida.";
	$Translation['moving member'] = "Moviendo miembro '<MEMBERID>' y sus datos del grupo '<SOURCEGROUP>' al grupo '<DESTINATIONGROUP>' ...";
	$Translation['data records transferred'] = "Miembro '<MEMBERID>' ahora pertenece al grupo '<NEWGROUP>'. Registro de datos transferidos: <DATARECORDS>.";
	$Translation['moving data'] = "Moviendo dato de miembreo '<SOURCEMEMBER>' desde el grupo '<SOURCEGROUP>' a miembro '<DESTINATIONMEMBER>' desde el grupo '<DESTINATIONGROUP>' ...";
	$Translation['member records status'] = "Miebmreo '<SOURCEMEMBER>' del grupo '<SOURCEGROUP>' tuvo <DATABEFORE> registros de datos. <TRANSFERSTATUS> a miembro '<DESTINATIONMEMBER>' del grupo '<DESTINATIONGROUP>'.";
	$Translation['moving all group members'] = "Moviendo todos los miembros y datos del grupo '<SOURCEGROUP>' al grupo '<DESTINATIONGROUP>' ...";
	$Translation['failed transferring group members'] = "La operación ha fallado. Ningún miembro ha sido transferido del grupo '<SOURCEGROUP>' al grupo '<DESTINATIONGROUP>'.";
	$Translation['group members transferred'] = "Todos los miembros del grupo '<SOURCEGROUP>' pertenecen ahora al grupo '<DESTINATIONGROUP>'. ";
	$Translation['failed transfer data records'] = "No obstante, los registros de datos han fallado en transferirse.";
	$Translation['data records were transferred'] = "<DATABEFORE> registros de datos fueron transferidos.";
	$Translation['moving group data to member'] = "Moviendo los datos de todos los miembros del grupo '<SOURCEGROUP>' a miembro '<DESTINATIONMEMBER>' del grupo '<DESTINATIONGROUP>' ...";
	$Translation['moving group data to member status'] = "<NUMBER> registro(s) fueron transferidos desde el grupo '<SOURCEGROUP>' a miembro '<DESTINATIONMEMBER>' del grupo '<DESTINATIONGROUP>'";
	$Translation['status'] = "ESTADO:";
	$Translation['batch transfer link'] = 'Para repetir la misma transferencia en lote mas tarde nuevamente, puede <a href= "pageTransferOwnership.php?sourceGroupID=<SOURCEGROUP>&amp;sourceMemberID=<SOURCEMEMBER>&amp;destinationGroupID=<DESTINATIONGROUP>&amp;destinationMemberID=<DESTINATIONMEMBER>&amp;moveMembers=<MOVEMEMBERS>">guardar o copiar este enlace/link</a>.';
	$Translation['ownership batch transfer'] = "Transferencia en lote de propiedad (ownership)";
	$Translation['step 1'] = "PASO 1:";
	$Translation['batch transfer wizard'] = "El asistente de transferencia en lote le permite transferir registros de uno o todos los miembros de un grupo (the <i>grupo de origen</i>) a miembros de otro grupo (the <i>destino de miembrosr</i> de un <i>grupo destino</i>)";
	$Translation['source group'] = "Grupo de origen";
	$Translation['update'] = "Actualizar";
	$Translation['next step'] = "Siguiente Paso";
	$Translation['group statistics'] = "Este grupo tiene <MEMBERS> miembros, y <RECORDS> registro de datos.";
	$Translation['step 2'] = "PASO 2:";
	$Translation['source member message'] = "El origen de miembros podría ser un miembro o todos los miembros de un grupo de origen.";
	$Translation['source member'] = "Origen del miembro";
	$Translation['all group members'] = "Todos los miembros de '<GROUPNAME>'";
	$Translation['member statistics'] = "Este miembro tiene <RECORDS> registro de datos.";
	$Translation['step 3'] = "PASO 3:";
	$Translation['destination group message'] = "El grupo destino puede ser el mismo o distinto al grupo de origen. Solo grupos que tienen miembors se listan abajo.";
	$Translation['destination group'] = "Grupo destino";
	$Translation['step 4'] = "PASO 4:";
	$Translation['destination member message'] = "El miembro destino será en nuevo propietario de los registros de datos del miembro origen.";
	$Translation['destination member'] = "Miembro destino";
	$Translation['begin transfer'] = "Iniciar transferencia";	
	$Translation['move records'] = "Puede incluso mover registros de uno o varios miembros a un miembro en el grupo destino, o mover miembro origen junto con sus registros de datos al grupo destino.";
	$Translation['move data records to member'] = "Mover registros de datos a este miembro:";
	$Translation['move source member to group'] = "Mover origen de miembro(s) y todos sus registros de datos al grupo '<GROUPNAME>'.";
	
	//pageUploadCSV.php
	$Translation['file not found error'] = "Error: Archivo/Fichero '<FILENAME>' no encontrado.";
	$Translation['preview and confirm CSV data'] = "Previsualizar dato del CSV luego confirmar su importación ...";
	$Translation['display csv file rows'] = "Mostrando los primeros 10 registros del archivo CSV ...";
	$Translation['change CSV settings'] = 'Cambiar configuraciones CSV';
	$Translation['import CSV data'] = 'Confirmar e importar dato CSV &gt;';
	$Translation['apply CSV settings'] = 'Aplicar configuraciones CSV';
	$Translation['importing CSV data'] = 'Importando datos CSV ...';
	$Translation['start at estimated record'] = "Iniciando en registro <RECORDNUMBER> de <RECORDS> registros estimados en total ...";
	$Translation['table backed up'] = "Tabla '<TABLE>' respaldada como '<TABLENAME>'.";
	$Translation['table backup not done'] = "Tabla '<TABLE>' está vaciá, por  lo tanto el respaldo no se ha realizado.";
	$Translation['importing batch'] = 'Importando lote <BATCH> de <BATCHNUM>: ';
	$Translation['ok'] = 'Ok';
	$Translation['records inserted or updated successfully'] = "<RECORDS> registros insertados/actualizados en <SECONDS> segundos.";
	$Translation['mission accomplished'] = "Misiónn cumplida!";
	$Translation['assign a records owner'] = "Asignar un propietario a los registros importados &gt;";
	$Translation['please wait and do not close'] = "Por favor espere y no cierre esta página ...";
	$Translation['hide advanced options'] = "Ocultar opciones avanzadas";
	$Translation['show advanced options'] = "Mostrar opciones avanzada";
	$Translation['import CSV to database'] = "Importar un archivo CSV a la base de datos";
	$Translation['import CSV to database page'] = "Esta página lo habilita a subir archivos CSV (por ejemplo, uno generado desde MS Excel) e importarlo a una de las tablas de la base de datos. Esto hace muy fácil el la población de la base de datos con datos de otras fuentes en luegar de ingresarlas manualmente cada registro de forma individual.";
	$Translation['populate table from CSV'] = "This is the table that you want to populate with data from the CSV file.";
	$Translation['CSV file'] = "Archivo/Fichero CSV";
	$Translation['preview CSV data'] = "Previsualizar dato CSV &gt;";
	$Translation['no table name provided'] = "No se ha proporcionado el nombre de la tabla.";
	$Translation['can not open CSV'] = "No puede abrir el archivo csv '<FILENAME>'.";
	$Translation['empty CSV file'] = "El archivo csv '<FILENAME>' está vacío.";		
	$Translation['no CSV file data'] = "El archivo csv '<FILENAME>' no posee datos para su lectura." ;
	$Translation['field separator'] = "Separador de campo";
	$Translation['default comma'] = "Por defecto la coma (,)";
	$Translation['field delimiter'] = "Delimintador de campo";
	$Translation['default double-quote'] = 'Por defect la comilla doble (")';
	$Translation['maximum characters per line'] = "Máximo caracteres por línea";
	$Translation['trouble importing CSV'] = "Si tiene problemas importando el archivo CSV, intente incrementando este valor.";
	$Translation['ignore lines number'] = "Número de líneas a ignorar";
	$Translation['skip lines number'] = "Cambie este valor si quiere saltar un número específico de líneas en el archivo CSV.";
	$Translation['first line field names'] = "La primera línea del archivo contiene los nombres de los campos";
	$Translation['field names must match'] = "Los nombres de campos deben coincidir <b>exactamente</b> con los de la base de datos.";
	$Translation['update table records'] = "Actualizar los registros de la tabla si el valor su claver primaria coincide con los del archivo CSV.";
	$Translation['ignore CSV table records'] = "Si no está marcado, los registros que en el archivo CSV tienen la misma clave primaria que los de la tabla <b>serán ignorados</b>";
	$Translation['back up the table'] = "Respaldar la tabla antes de importar datos dentro de la misma.";
	
	//pageViewGroups.php
	$Translation['no matching results found'] = "No se encontraron resultados.";
	$Translation['search groups'] = "Buscar grupos";
	$Translation['find'] = "Buscar";
	$Translation['reset'] = "Resetear";
	$Translation['members count'] = "Cantidad de miembros";
	$Translation['Edit group'] = "Editar grupo";
	$Translation['confirm delete group'] = "¿Está seguro de borrar completamente este grupo?";
	$Translation['delete group'] = "Borrar grupo";
	$Translation['view group records'] = "Ver registros del grupo";
	$Translation['view group members'] = "Ver miembros del grupo";
	$Translation['send message to group'] = "Enviar mensaje a grupo";
	$Translation['previous'] = "Anterior";
	$Translation['displaying groups'] = "Mostrando grupos <GROUPNUM1> a <GROUPNUM2> de <GROUPS>";
	$Translation['next'] = "Siguiente";
	$Translation['key'] = "Clave/Key:";	
	$Translation['edit group details'] = "Editar detalles y persmisos del grupo.";
	$Translation['add member to group'] = "Agregar nuevo miembro a grupo.";
	$Translation['view data records'] = "Ver todos los registros ingresado por los miembros del grupo.";
	$Translation['list group members'] = "Listar todos los miembros de un grupo.";
	$Translation['send email to all members'] = "Enviar un mensaje de correo electrónico a todos los miembros de un grupo.";
	
	//pageViewMembers.php
	$Translation['search members'] = "Buscar miembros <SEARCH> en <HTMLSELECT>";
	$Translation['all fields'] = "Todos los campos";
	$Translation['any'] = "Cualquiera";
	$Translation['waiting approval'] = "Esperando aprobación";
	$Translation['active'] = "Activo";
	$Translation['Banned'] = "Bloqueado";
	$Translation['username'] = "Usuario";
	$Translation['sign up date'] = "Fecha de registro";
	$Translation['Status'] = "Estado";
	$Translation['Edit member'] = "Editar miembro";	
	$Translation['sure delete user'] = "¿Está seguro de eliminar el usuario \'<USERNAME>\'?";
	$Translation['delete member'] = "Borrar miembro";
	$Translation["approve this member"] = "Aprobar este miembro";
	$Translation["unban this member"] = "Desbloquear este miembro";
	$Translation["ban this member"] = "Bloquear este miembro";
	$Translation["View member records"] = "Ver registros del miembro";
	$Translation["send message to member"] = "Enviar mensaje a miembro";
	$Translation['displaying members'] = "Mostrando miembros <MEMBERNUM1> a <MEMBERNUM2> de <MEMBERS>";
	$Translation['activate member'] = "Activar miembro nuevo/bloqueado.";
	$Translation['ban member'] = "Bloquear (suspender) miembro.";
	$Translation['view entered member records'] = "Ver todos los registros ingresado por el miembro.";
	$Translation['send email to member'] = "Enviar mensaje de correo electrónico a miembro.";
	
	//pageViewRecords.php
	$Translation['data records'] = "Registro de datos";
	$Translation['show records'] = "Mostrando registro desde ";
	$Translation['all tables'] = "Todas las tablas";
	$Translation['sort records'] = "Ordenar registros por";
	$Translation['date created'] = "Creado en fecha";
	$Translation['date modified'] = "Modificado en fecha";
	$Translation['newer first'] = "Lo más nuevo primero";
	$Translation['older first'] = "Lo más viejo primero";
	$Translation['created'] = "Creado";
	$Translation['modified'] = "Modificado";
	$Translation['data'] = "Dato";
	$Translation['change record ownership'] = "Cambiar propietario de este registro";
	$Translation['sure delete record'] = "¿Está seguro de que quiere borrar este registro?";
	$Translation['delete record'] = "Borrar este registro";
	$Translation['displaying records'] = "Mostrando registros <RECORDNUM1> a <RECORDNUM2> de <RECORDS>";

	/* Added in RozzyS 5.51 */
	$Translation['maintenance mode admin notification'] = 'El Modo Mantenimiento está habilitado! 
	Puede deshabilitarlo desde la página de administración.';
	$Translation['maintenance mode message'] = 'Mensaje del Modo Mantenimiento';
	$Translation['maintenance mode'] = 'Modo Mantenimiento';
	$Translation['OFF'] = 'INACTIVADO - OFF';
	$Translation['ON'] = 'ACTIVADO - ON';
	$Translation['enable maintenance mode?'] = '¿Está seguro de activar el Modo Mantenimiento? Solo los administradores del sitio acceden en este modo!';
	$Translation['disable maintenance mode?'] = 'Está seguro de inactivar/deshabilitar el Modo Mantenimiento? Todos los usuarios estarán habilitados para acceder al sitio!';
	
	/* Added in RozzyS 5.60 */
	$Translation['csv file upload error'] = 'Ha ocurrido un error al procesar el archivo CSV solicitado.';
	$Translation['back and retry'] = 'Vuelva atrás e intente de nuevo';
	$Translation['upload or choose csv file'] = 'Subir un archivo CSV o abrir uno existente';
	$Translation['choose csv upload'] = 'Elija el archivo CSV a subir.';
	$Translation['no file chosen yet'] = 'Aún no ha seleccionado un archivo';
	$Translation['start upload'] = 'Iniciar subida';
	$Translation['select a table'] = 'Seleccione una tabla';
	$Translation['error reading csv data'] = 'Ha ocurrido un error en la lectura del dato CSV. Intente reseteando/ajustando las propiedades del CSV.';
	$Translation['belongs to'] = 'Pertenece a';
	$Translation['skip column'] = 'Saltar esta columna';
	$Translation['connection failed retrying'] = 'Conexión fallida. Intentando en <SECONDS> segundos ...';
	$Translation['connection failed timeout'] = 'Conexión expirada. Intente más tarde.';
	$Translation['sure delete csv'] = '¿Está seguro de querer borrar el archivo CSV [CSVFILE] del servidor?';
	$Translation['invalid csv file selected'] = 'El archivo elegido no es válido. Debe ser un archivo CSV.';
	$Translation['couldnt delete csv file'] = 'No se ha podido borrar este archico CSV.';
	$Translation['error backing up table'] = 'Error: No se pudo realizar la copia de seguridad de la tabla <TABLE>.';
	$Translation['no columns selected'] = 'Por favor seleccione al menos una columna a importar y asegúrese de que cada columna seleccionada pertenezca a una ÚNICO campo.';
	$Translation['csrf token expired or invalid'] = 'Oops! Algo salió mal con esta página. Por favor vuelva atrás y inténtelo de nuevo.';
	$Translation['back to groups'] = 'Volver a grupos';
	$Translation['member updated'] = "Miembro <USERNAME> actualizado exitosamente.";
	$Translation['fix errors before submitting'] = 'Por favor repare los errores marcados antes de enviar las página y sus datos!';

	/* Added in RozzyS 5.62 */
	$Translation['mail_function'] = 'Método de envío de emails';
	$Translation['smtp_server'] = 'Servidor SMTP';
	$Translation['smtp_encryption'] = 'Encriptación SMTP';
	$Translation['smtp_port'] = 'Puerto SMTP';
	$Translation['smtp_port_hint'] = 'Valores típicos son 25 (para SMTP no encriptado), 465 (usado en muchoas casos con encriptación SSL) o 587 (usualmente con encriptación TLS)';
	$Translation['smtp_user'] = 'Usuario SMTP';
	$Translation['smtp_pass'] = 'Contraseña SMTP';
	$Translation['configure mail settings'] = 'Configurar propiedades de e-mail';
	$Translation['display debugging info'] = 'Mostrar informacón de depuración o debugging';
	$Translation['debugging info hint'] = 'La información de depuración es muy útil si tiene problemas enviando e-mails a través de un servidor SMTP configurado';

	/* Added in RozzyS 5.70 */
	$Translation['create backup file'] = 'Crear archivo de backup';
	$Translation['database backups'] = 'Backups o Copias de Respaldo de base de datos';
	$Translation['no backups found'] = 'No se encontraron backups. Usted puede crear un nuevo backup haciendo click en el botón "Crear archivo de backup".';
	$Translation['available backups'] = 'Backups disponibles';
	$Translation['restore backup'] = 'Restaurar';
	$Translation['delete backup'] = 'Borrar';
	$Translation['backup restored'] = 'Backup restaurado exitosamente.';
	$Translation['backup deleted'] = 'Backup borrado exitosamente.';
	$Translation['restore error'] = 'Ocurrió un error mientras se restauraba la base de datos.';
	$Translation['backup delete error'] = 'Ocurrió un error mientras se borraba el backup';
	$Translation['confirm delete backup'] = '¿Está seguro de borrar este archivo de backup?';
	$Translation['confirm restore'] = 'La Restauración de su base de datos desde un archivo de backup podría SOBRE ESCRIBIR/PISAR todos los datos y usuarios/contrañas existentes, revirtierndo todo al estado de cuando el backup fue creado.\n\nDureante este proceso de restauración, el modo mantenimiento será activado para prevenir modificaciones en la base de datos por los usuarios, y será desactivado una vez que la restuaración haya finalizado.\n\n¿Está seguro que quiere continuar?';
	$Translation['confirm backup'] = 'Durante el proceso de backup, el modo mantenimeonto será activado para prevenir la modificación de la base de datos por los usuarios, y será desactivado una vez que el backup haya finalizado.\n\n¿Está seguro que quiere continuar?';
	$Translation['cant create backup folder'] = 'Error: No se pueda crear o escribir en la carpeta o directorio admin/backups. Por favor verifique los permisos y propiedades de su carpeta o directorio o contacte con su administrador de sistems para asistencia.';
	$Translation['fix all'] = 'REPARAR TODOS LOS CAMPOS';
	$Translation['backup before fix'] = 'Es altamente recomendable que primero cree un backup de la base de datos antes intentar cualquier reparación o ajustes aquí.';
	$Translation['about backups'] = 'Los Backups o Copias de Respaldo son realizados utilizando la herramienta de línea de comandos mysqldump. Si no se están creado backups, puede ser debido a que el servidor web no posee permisos para ejecutar mysqldump.';

	/* Added in RozzyS 5.73 */
	$Translation['server status disabled'] = 'El estado de servidor está deshabilidtado en esta aplicación. Para habilitarla, regenere la aplicación con la option "Habilitar el estado del servidor en el área de Administración" activada.';
	$Translation['server status'] = 'Estado del servidor';
	$Translation['db status'] = 'Estado de la base de datos';
	$Translation['generated by'] = 'Esta aplicación fue generada por Ozzyta by Medicontrol SAS <VERSION> el <DATETIME>.';
	$Translation['column table name'] = 'Nombre de tabla';
	$Translation['db storage'] = 'Almacenamiento de la Base de datos';
	$Translation['column size kb'] = 'Tamaño (KB)';
	$Translation['total'] = 'Total';
	$Translation['php info'] = 'PHP info';
	$Translation['files'] = 'archivos';
	$Translation['uploads info'] = 'Información de subida';