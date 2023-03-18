<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function covid_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_header($contentType, $memberInfo, &$args) {
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

	function covid_footer($contentType, $memberInfo, &$args) {
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

	function covid_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function covid_after_delete($selectedID, $memberInfo, &$args) {

	}

	function covid_dv($selectedID, $memberInfo, &$html, &$args){
		/* if this is the print preview, don't modify the detail view */
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>
		
		<script>
			$j(function(){
				<?php if($selectedID){ ?>
					$j('#covid_dv_action_buttons .btn-toolbar').append(
						'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
							'<button type="button" class="btn btn-default btn-lg" onclick="atras()">' +
								'<i class="glyphicon glyphicon-chevron-left"></i> Atras</button>' +
						'</div>'
					);
				<?php } ?>
		});
			
			function atras(){
				var host = document.referrer;
				var page= location.protocol + '//' + location.host + '/RozzySPRO/covid_view.php'
				if(host==page){
					window.history.go(-2);
				}else {
					window.history.go(-1);
				} 
			}
			
		</script>
		
		<?php
		$form_code = ob_get_contents();
		ob_end_clean();
		
		$html .= $form_code;
	}

	function covid_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function covid_batch_actions(&$args){

		return array(
			array(
			'title' => 'No Encuestado',
			'function' => 'change_to_notplayable',
			'icon' => 'remove'
			),

		);
	}
