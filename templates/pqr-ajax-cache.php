<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'pqr';

		/* data for selected record, or defaults if none is selected */
		var data = {
			barrio: <?php echo json_encode(array('id' => $rdata['barrio'], 'value' => $rdata['barrio'], 'text' => $jdata['barrio'])); ?>,
			regimen: <?php echo json_encode(array('id' => $rdata['regimen'], 'value' => $rdata['regimen'], 'text' => $jdata['regimen'])); ?>,
			eps: <?php echo json_encode(array('id' => $rdata['eps'], 'value' => $rdata['eps'], 'text' => $jdata['eps'])); ?>,
			gerente: <?php echo json_encode($jdata['gerente']); ?>,
			teleps: <?php echo json_encode($jdata['teleps']); ?>,
			maileps: <?php echo json_encode($jdata['maileps']); ?>,
			cc2: <?php echo json_encode(array('id' => $rdata['cc2'], 'value' => $rdata['cc2'], 'text' => $jdata['cc2'])); ?>,
			cc3: <?php echo json_encode(array('id' => $rdata['cc3'], 'value' => $rdata['cc3'], 'text' => $jdata['cc3'])); ?>,
			motivo: <?php echo json_encode(array('id' => $rdata['motivo'], 'value' => $rdata['motivo'], 'text' => $jdata['motivo'])); ?>,
			obmotivo: <?php echo json_encode(array('id' => $rdata['obmotivo'], 'value' => $rdata['obmotivo'], 'text' => $jdata['obmotivo'])); ?>,
			servicio: <?php echo json_encode(array('id' => $rdata['servicio'], 'value' => $rdata['servicio'], 'text' => $jdata['servicio'])); ?>,
			enfermedad: <?php echo json_encode(array('id' => $rdata['enfermedad'], 'value' => $rdata['enfermedad'], 'text' => $jdata['enfermedad'])); ?>
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

		/* saved value for eps */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'eps' && d.id == data.eps.id)
				return { results: [ data.eps ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for eps autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'eps' && d.id == data.eps.id) {
				$j('#gerente' + d[rnd]).html(data.gerente);
				$j('#teleps' + d[rnd]).html(data.teleps);
				$j('#maileps' + d[rnd]).html(data.maileps);
				return true;
			}

			return false;
		});

		/* saved value for cc2 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'cc2' && d.id == data.cc2.id)
				return { results: [ data.cc2 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for cc3 */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'cc3' && d.id == data.cc3.id)
				return { results: [ data.cc3 ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for motivo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'motivo' && d.id == data.motivo.id)
				return { results: [ data.motivo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for obmotivo */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'obmotivo' && d.id == data.obmotivo.id)
				return { results: [ data.obmotivo ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for servicio */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'servicio' && d.id == data.servicio.id)
				return { results: [ data.servicio ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for enfermedad */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'enfermedad' && d.id == data.enfermedad.id)
				return { results: [ data.enfermedad ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

