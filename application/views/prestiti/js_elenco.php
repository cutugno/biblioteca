<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>

<script>	
		
	$(document).ready(function() {
		
		$.tablesorter.addParser({
			id: 'past',
			is: function(s, table, cell, $cell) {
			  return false;
			},
			format: function(s, table, cell, cellIndex) {
			  var $cell = $(cell);
			  return $cell.attr('data-past') || s;
			},
			parsed: true, // lascia se parser serve anche da filtro
			type: 'numeric'
		});
		
		$("#prestiti_table").tablesorter({
			widthFixed: true, 
			widgets: ["filter"],
			headers: {
				'.noorder': {
					sorter:false
				},
				'.past' : { sorter: 'past' }
			},
			widgetOptions: {
				filter_functions: {
					'.past': {
						"oggi"      : function(e, n, f, i, $r, c, data) { return e <= 1; },
						"7 giorni"      : function(e, n, f, i, $r, c, data) { return e <= 7; },
						"1 mese"      : function(e, n, f, i, $r, c, data) { return e <= 31; },
						"6 mesi"      : function(e, n, f, i, $r, c, data) { return e <= 180; },
						"1 anno"      : function(e, n, f, i, $r, c, data) { return e <= 365; }
					}
				}
			}
		}) 
		.tablesorterPager({
			container: $(".pagin"),
			output: '{startRow}-{endRow} di {totalRows} risultati'
		}); 
		
	});
	
</script>
	

