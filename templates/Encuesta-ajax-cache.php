<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Encuesta';

		/* data for selected record, or defaults if none is selected */
		var data = {
			eps: <?php echo json_encode(array('id' => $rdata['eps'], 'value' => $rdata['eps'], 'text' => $jdata['eps'])); ?>,
			ipsprim: <?php echo json_encode(array('id' => $rdata['ipsprim'], 'value' => $rdata['ipsprim'], 'text' => $jdata['ipsprim'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for eps */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'eps' && d.id == data.eps.id)
				return { results: [ data.eps ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ipsprim */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ipsprim' && d.id == data.ipsprim.id)
				return { results: [ data.ipsprim ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

