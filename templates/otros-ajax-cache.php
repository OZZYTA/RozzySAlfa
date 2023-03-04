<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'otros';

		/* data for selected record, or defaults if none is selected */
		var data = {
			barrio: <?php echo json_encode(array('id' => $rdata['barrio'], 'value' => $rdata['barrio'], 'text' => $jdata['barrio'])); ?>,
			regimen: <?php echo json_encode(array('id' => $rdata['regimen'], 'value' => $rdata['regimen'], 'text' => $jdata['regimen'])); ?>,
			eapb: <?php echo json_encode(array('id' => $rdata['eapb'], 'value' => $rdata['eapb'], 'text' => $jdata['eapb'])); ?>,
			gerente: <?php echo json_encode($jdata['gerente']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for barrio */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'barrio' && d.id == data.barrio.id)
				return { results: [ data.barrio ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for regimen */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'regimen' && d.id == data.regimen.id)
				return { results: [ data.regimen ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for eapb */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'eapb' && d.id == data.eapb.id)
				return { results: [ data.eapb ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for eapb autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'eapb' && d.id == data.eapb.id) {
				$j('#gerente' + d[rnd]).html(data.gerente);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

