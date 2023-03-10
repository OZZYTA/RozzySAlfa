<?php

// Data functions (insert, update, delete, form) for table eps

// This script and data application were generated by AppGini 5.97
// Download AppGini for free from https://bigprof.com/appgini/download/

function eps_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('eps');
	if(!$arrPerm['insert']) return false;

	$data = [
		'razonsocial' => Request::val('razonsocial', ''),
		'regimen' => Request::lookup('regimen', ''),
		'gerente' => Request::val('gerente', ''),
		'telefono' => Request::val('telefono', ''),
		'correo' => Request::val('correo', ''),
		'correo2' => Request::val('correo2', ''),
		'correo3' => Request::val('correo3', ''),
	];

	if($data['razonsocial'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Nombre': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: eps_before_insert
	if(function_exists('eps_before_insert')) {
		$args = [];
		if(!eps_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('eps', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = $data['razonsocial'];

	update_calc_fields('eps', $recID, calculated_fields()['eps']);

	// hook: eps_after_insert
	if(function_exists('eps_after_insert')) {
		$res = sql("SELECT * FROM `eps` WHERE `razonsocial`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=[];
		if(!eps_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('eps', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) eps_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function eps_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function eps_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('eps', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: eps_before_delete
	if(function_exists('eps_before_delete')) {
		$args = [];
		if(!eps_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	// child table: pqr
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `pqr` WHERE `eps`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: pqr
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `pqr` WHERE `cc2`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: pqr
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `pqr` WHERE `cc3`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'pqr', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: Encuesta
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `Encuesta` WHERE `eps`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'Encuesta', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'Encuesta', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: covid
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `covid` WHERE `eps`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'covid', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'covid', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: otros
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `otros` WHERE `eapb`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'otros', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'otros', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: prass
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `prass` WHERE `eps`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'prass', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'prass', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	// child table: oportunidad
	$res = sql("SELECT `razonsocial` FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);
	$razonsocial = db_fetch_row($res);
	$rires = sql("SELECT COUNT(1) FROM `oportunidad` WHERE `eps`='" . makeSafe($razonsocial[0]) . "'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'oportunidad', $RetMsg);
		return $RetMsg;
	} elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation['confirm delete'];
		$RetMsg = str_replace('<RelatedRecords>', $rirow[0], $RetMsg);
		$RetMsg = str_replace('<TableName>', 'oportunidad', $RetMsg);
		$RetMsg = str_replace('<Delete>', '<input type="button" class="button" value="' . $Translation['yes'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '&delete_x=1&confirmed=1\';">', $RetMsg);
		$RetMsg = str_replace('<Cancel>', '<input type="button" class="button" value="' . $Translation[ 'no'] . '" onClick="window.location = \'eps_view.php?SelectedID=' . urlencode($selected_id) . '\';">', $RetMsg);
		return $RetMsg;
	}

	sql("DELETE FROM `eps` WHERE `razonsocial`='{$selected_id}'", $eo);

	// hook: eps_after_delete
	if(function_exists('eps_after_delete')) {
		$args = [];
		eps_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='eps' AND `pkValue`='{$selected_id}'", $eo);
}

function eps_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('eps', $selected_id, 'edit')) return false;

	$data = [
		'razonsocial' => Request::val('razonsocial', ''),
		'regimen' => Request::lookup('regimen', ''),
		'gerente' => Request::val('gerente', ''),
		'telefono' => Request::val('telefono', ''),
		'correo' => Request::val('correo', ''),
		'correo2' => Request::val('correo2', ''),
		'correo3' => Request::val('correo3', ''),
	];

	if($data['razonsocial'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Nombre': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('eps', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: eps_before_update
	if(function_exists('eps_before_update')) {
		$args = ['old_data' => $old_data];
		if(!eps_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'eps', 
		backtick_keys_once($set), 
		['`razonsocial`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="eps_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}

	$data['selectedID'] = $data['razonsocial'];
	$newID = $data['razonsocial'];

	$eo = ['silentErrors' => true];

	update_calc_fields('eps', $data['selectedID'], calculated_fields()['eps']);

	// hook: eps_after_update
	if(function_exists('eps_after_update')) {
		$res = sql("SELECT * FROM `eps` WHERE `razonsocial`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['razonsocial'];
		$args = ['old_data' => $old_data];
		if(!eps_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update ownership data
	sql("UPDATE `membership_userrecords` SET `dateUpdated`='" . time() . "', `pkValue`='{$data['razonsocial']}' WHERE `tableName`='eps' AND `pkValue`='" . makeSafe($selected_id) . "'", $eo);

	// if PK value changed, update $selected_id
	$selected_id = $newID;
}

function eps_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm = getTablePermissions('eps');
	if(!$arrPerm['insert'] && $selected_id=='') return $Translation['tableAccessDenied'];
	$AllowInsert = ($arrPerm['insert'] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_regimen = thisOr($_REQUEST['filterer_regimen'], '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: regimen
	$combo_regimen = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm['view']) return $Translation['tableAccessDenied'];

		// mm: who is the owner?
		$ownerGroupID = sqlValue("SELECT `groupID` FROM `membership_userrecords` WHERE `tableName`='eps' AND `pkValue`='" . makeSafe($selected_id) . "'");
		$ownerMemberID = sqlValue("SELECT LCASE(`memberID`) FROM `membership_userrecords` WHERE `tableName`='eps' AND `pkValue`='" . makeSafe($selected_id) . "'");

		if($arrPerm['view'] == 1 && getLoggedMemberID() != $ownerMemberID) return $Translation['tableAccessDenied'];
		if($arrPerm['view'] == 2 && getLoggedGroupID() != $ownerGroupID) return $Translation['tableAccessDenied'];

		// can edit?
		$AllowUpdate = 0;
		if(($arrPerm['edit'] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm['edit'] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm['edit'] == 3) {
			$AllowUpdate = 1;
		}

		$res = sql("SELECT * FROM `eps` WHERE `razonsocial`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'eps_view.php', false);
		}
		$combo_regimen->SelectedData = $row['regimen'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$combo_regimen->SelectedData = $filterer_regimen;
	}
	$combo_regimen->HTML = '<span id="regimen-container' . $rnd1 . '"></span><input type="hidden" name="regimen" id="regimen' . $rnd1 . '" value="' . html_attr($combo_regimen->SelectedData) . '">';
	$combo_regimen->MatchText = '<span id="regimen-container-readonly' . $rnd1 . '"></span><input type="hidden" name="regimen" id="regimen' . $rnd1 . '" value="' . html_attr($combo_regimen->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_regimen__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['regimen'] : htmlspecialchars($filterer_regimen, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(regimen_reload__RAND__) == 'function') regimen_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function regimen_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#regimen-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_regimen__RAND__.value, t: 'eps', f: 'regimen' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="regimen"]').val(resp.results[0].id);
							$j('[id=regimen-container-readonly__RAND__]').html('<span id="regimen-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=regimenes_view_parent]').hide(); } else { $j('.btn[id=regimenes_view_parent]').show(); }


							if(typeof(regimen_update_autofills__RAND__) == 'function') regimen_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'eps', f: 'regimen' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_regimen__RAND__.value = e.added.id;
				AppGini.current_regimen__RAND__.text = e.added.text;
				$j('[name="regimen"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=regimenes_view_parent]').hide(); } else { $j('.btn[id=regimenes_view_parent]').show(); }


				if(typeof(regimen_update_autofills__RAND__) == 'function') regimen_update_autofills__RAND__();
			});

			if(!$j("#regimen-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_regimen__RAND__.value, t: 'eps', f: 'regimen' },
					success: function(resp) {
						$j('[name="regimen"]').val(resp.results[0].id);
						$j('[id=regimen-container-readonly__RAND__]').html('<span id="regimen-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=regimenes_view_parent]').hide(); } else { $j('.btn[id=regimenes_view_parent]').show(); }

						if(typeof(regimen_update_autofills__RAND__) == 'function') regimen_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_regimen__RAND__.value, t: 'eps', f: 'regimen' },
				success: function(resp) {
					$j('[id=regimen-container__RAND__], [id=regimen-container-readonly__RAND__]').html('<span id="regimen-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=regimenes_view_parent]').hide(); } else { $j('.btn[id=regimenes_view_parent]').show(); }

					if(typeof(regimen_update_autofills__RAND__) == 'function') regimen_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/eps_templateDV.html';
	$templateCode = @file_get_contents($template_file);

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Detalles de la EPS', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return eps_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return eps_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	} else {
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return eps_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		} else {
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly = '';
		$jsReadOnly .= "\tjQuery('#razonsocial').replaceWith('<div class=\"form-control-static\" id=\"razonsocial\">' + (jQuery('#razonsocial').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#regimen').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#regimen_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#gerente').replaceWith('<div class=\"form-control-static\" id=\"gerente\">' + (jQuery('#gerente').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#telefono').replaceWith('<div class=\"form-control-static\" id=\"telefono\">' + (jQuery('#telefono').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#correo').replaceWith('<div class=\"form-control-static\" id=\"correo\">' + (jQuery('#correo').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#correo2').replaceWith('<div class=\"form-control-static\" id=\"correo2\">' + (jQuery('#correo2').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#correo3').replaceWith('<div class=\"form-control-static\" id=\"correo3\">' + (jQuery('#correo3').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} elseif($AllowInsert) {
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(regimen)%%>', $combo_regimen->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(regimen)%%>', $combo_regimen->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(regimen)%%>', urlencode($combo_regimen->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('regimen' => array('regimenes', 'Regimen'), );
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] /* && !$_REQUEST['Embedded']*/) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(razonsocial)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(regimen)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(gerente)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(telefono)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(correo)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(correo2)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(correo3)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(razonsocial)%%>', safe_html($urow['razonsocial']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(razonsocial)%%>', html_attr($row['razonsocial']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(razonsocial)%%>', urlencode($urow['razonsocial']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(regimen)%%>', safe_html($urow['regimen']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(regimen)%%>', html_attr($row['regimen']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(regimen)%%>', urlencode($urow['regimen']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(gerente)%%>', safe_html($urow['gerente']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(gerente)%%>', html_attr($row['gerente']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(gerente)%%>', urlencode($urow['gerente']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(telefono)%%>', safe_html($urow['telefono']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(telefono)%%>', html_attr($row['telefono']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(telefono)%%>', urlencode($urow['telefono']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(correo)%%>', safe_html($urow['correo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(correo)%%>', html_attr($row['correo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo)%%>', urlencode($urow['correo']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(correo2)%%>', safe_html($urow['correo2']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(correo2)%%>', html_attr($row['correo2']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo2)%%>', urlencode($urow['correo2']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(correo3)%%>', safe_html($urow['correo3']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(correo3)%%>', html_attr($row['correo3']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo3)%%>', urlencode($urow['correo3']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(razonsocial)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(razonsocial)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(regimen)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(regimen)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(gerente)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(gerente)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(telefono)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(telefono)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(correo)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(correo2)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo2)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(correo3)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(correo3)%%>', urlencode(''), $templateCode);
	}

	// process translations
	$templateCode = parseTemplate($templateCode);

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('eps');
	if($selected_id) {
		$jdata = get_joined_record('eps', $selected_id);
		if($jdata === false) $jdata = get_defaults('eps');
		$rdata = $row;
	}
	$templateCode .= loadView('eps-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: eps_dv
	if(function_exists('eps_dv')) {
		$args=[];
		eps_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}