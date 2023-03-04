function kogroups_html($table, &$groups, $after = '') {
	ob_start(); ?>
		<?php
			foreach ($groups as $group => $groupinfo) {
				$style = (isset($groupinfo['style']) ? $groupinfo['style'] : 'horizontal');
				echo "<div id='{$group}-holder' class=\"panel panel-default form-group form-{$style}\">";
				if (!empty($groupinfo['name'])) {

					$collapseicon = '';
					$collapse_default_open_class = '';
					$collapse_data_toggle = ($groupinfo['collapse']==0 ? '' : "data-toggle='collapse'");

					if (isset($groupinfo['collapse']) && $groupinfo['collapse'] == 1){
						$collapseicon = "<span class='{$group}-collapse-icon glyphicon glyphicon-chevron-up'></span>";
						$collapse_default_open_class = 'collapse in';
					} else if (isset($groupinfo['collapse']) && $groupinfo['collapse'] == 2) {
						$collapseicon = "<span class='{$group}-collapse-icon glyphicon glyphicon-chevron-down'></span>";
						$collapse_default_open_class = 'collapse';
					}

					if (isset($groupinfo['collapse']) && $groupinfo['collapse'] > 0){
						$paneltitle = "<a {$collapse_data_toggle} href='#{$group}'>{$groupinfo[name]}</a>";
					} else {
						$paneltitle = "{$groupinfo[name]}";
					}

					echo "<div class='panel-heading'>{$collapseicon}{$paneltitle}</div>";
				}

				echo "<div id='{$group}' class='panel-body {$collapse_default_open_class}'>";
				echo "</div>";
				echo "</div>";
			}
		?>
	<script>
		$j(function(){
		<?php
			foreach ($groups as $group => $groupinfo) {
				if (!empty($groupinfo['name'])) {
					echo "\$j('#{$group}').on('shown.bs.collapse', function() {
	   						 \$j('.{$group}-collapse-icon').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
	  						});\n";

					echo "\$j('#{$group}').on('hidden.bs.collapse', function() {
   							 \$j('.{$group}-collapse-icon').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
  							});\n";
				}
				if (isset($groupinfo['position_after'])){
					echo "\$j('#{$groupinfo['position_after']}').parents('.form-group').after(\$j('#{$group}-holder'));\n";
				} else {
					echo "\$j('fieldset').prepend(\$j('#{$group}-holder'));\n";
				}

				foreach ($groupinfo['fields'] as $groupfield) {
					if ($groupfield[0] != '#') {
						echo "\$j('#{$groupfield}').parents('.form-group').appendTo('#{$group}');\n";
					} else {
						echo "\$j('{$groupfield}').appendTo('#{$group}');\n";
					}

			 	}
			}
		?>
		})
	</script>
	<?php
	$html = ob_get_contents();
	ob_end_clean();
	return $html;

