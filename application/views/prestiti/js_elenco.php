<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>

<script>	
	
	<?php if ($this->session->registratoreso==1) :?>
	swal({title:"", text:"Reso registrato", timer:1500, showConfirmButton:false, type: "success"});
	<?php endif ?>
	
	<?php if ($this->session->noregistratoreso==1) :?>
	swal({title:"", text:"Errore durante l'inserimento del reso. Riprova", timer:2000, showConfirmButton:false, type: "error"});
	<?php endif ?>
	
	<?php if ($this->session->prestitoannullato==1) :?>
	swal({title:"", text:"Prestito annullato", timer:1500, showConfirmButton:false, type: "success"});
	<?php endif ?>
	
	<?php if ($this->session->errorprestitoannullato==1) :?>
	swal({title:"", text:"Errore durante l'annullamento del prestito. Riprova", timer:2000, showConfirmButton:false, type: "error"});
	<?php endif ?>
	
	<?php if ($this->session->noprestitoannullato==1) :?>
	swal({title:"", text:"Prestito non annullabile", timer:1500, showConfirmButton:false, type: "warning"});
	<?php endif ?>
	
	<?php if ($this->session->nonesiprestitoannullato==1) :?>
	swal({title:"", text:"Prestito inesistente", timer:1500, showConfirmButton:false, type: "error"});
	<?php endif ?>
		
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
				'.past'  : { sorter: 'past' },
				'.past2' : { sorter: 'past' }
			},
			widgetOptions: {
				filter_functions: {
					'.past': {
						"non reso"    : function(e, n, f, i, $r, c, data) { return e < 0; },
						"oggi"        : function(e, n, f, i, $r, c, data) { return e == 0; },
						"7 giorni"    : function(e, n, f, i, $r, c, data) { return e >= 0 && e <=7; },
						"1 mese"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 31; },
						"6 mesi"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 180; },
						"1 anno"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 365; },
						"oltre"       : function(e, n, f, i, $r, c, data) { return e > 365; }
					},
					'.past2': {						
						"oggi"        : function(e, n, f, i, $r, c, data) { return e == 0; },
						"7 giorni"    : function(e, n, f, i, $r, c, data) { return e >= 0 && e <=7; },
						"1 mese"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 31; },
						"6 mesi"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 180; },
						"1 anno"      : function(e, n, f, i, $r, c, data) { return e >= 0 && e <= 365; },
						"oltre"       : function(e, n, f, i, $r, c, data) { return e > 365; }
					}
				}
			}
		}) 
		.tablesorterPager({
			container: $(".pagin"),
			output: '{startRow} - {endRow} di {filteredRows} (tot. {totalRows})'  
		}); 
		
	});
	
</script>
	

