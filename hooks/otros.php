<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function otros_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_header($contentType, $memberInfo, &$args) {
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

	function otros_footer($contentType, $memberInfo, &$args) {
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

	function otros_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function otros_after_delete($selectedID, $memberInfo, &$args) {

	}

	function otros_dv($selectedID, $memberInfo, &$html, &$args) {
		
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>
		<script>
		
		$j(function(){
				<?php if($selectedID){ ?>
				$j('#otros_dv_action_buttons .btn-toolbar').append(
				'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">'+
					'<button type="button" class="btn btn-default btn-lg" id="backbutton" onclick="atras()">'+
						'<i class="glyphicon glyphicon-chevron-left"></i> Atrás </button><br>'+
				'</div>'
				);
		<?php } ?>
		});
		
		$j(function(){
				<?php if($selectedID){ ?>
				$j('#otros_dv_action_buttons .btn-toolbar').append(
				'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">'+
					'<button type="button" class="btn btn-default btn-lg" id="printremi" onclick="print_remision()">'+
						'<i class="glyphicon glyphicon-print"></i> Boleta de remisión </button>'+
				'</div>'
				);
		<?php } ?>
		});
			
			function atras(){
				var host = document.referrer;
				var page= location.protocol + '//' + location.host + '/RozzySPRO/otros_view.php'
				if(host==page){
					window.history.go(-2);
				}else {
					window.history.go(-1);
				} 
			}
			

			
			function print_remision(){
				var selected_id='<?php echo urlencode($selectedID);?>';
				window.location = "remisiones_pdf.php?SelectedID=" + selected_id;}
			
			
		</script>
		
		
		<?php
		$form_code=ob_get_contents();
		ob_end_clean();
		
		$html .= $form_code;

		
		
	}

	function otros_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function otros_batch_actions(&$args) {

		return [];
	}
