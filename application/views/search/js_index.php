<script>
	$(document).ready(function() {
		
		<?php if ($this->session->eliminalibro==1) :?>
		swal({title:"", text:"Libro eliminato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noeliminalibro==1) :?>
		swal({title:"", text:"Errore durante l'eliminazione. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		<?php if ($this->session->registratoreso==1) :?>
		swal({title:"", text:"Reso registrato", timer:1500, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noregistratoreso==1) :?>
		swal({title:"", text:"Errore durante l'inserimento del reso. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		$.tablesorter.addParser({
			id: 'disp',
			is: function(s, table, cell, $cell) {
			  return false;
			},
			format: function(s, table, cell, cellIndex) {
			  var $cell = $(cell);
			  return $cell.attr('data-disp') || s;
			},
			parsed: true, // lascia se parser serve anche da filtro
			type: 'numeric'
		});
		
		$("#libri_table").tablesorter({
			widthFixed: true, 
			widgets: ["filter"],
			headers: {
				'.noorder': {
					sorter:false
				},
				'.disp' : { sorter: 'disp' }
			},
			widgetOptions: {
				filter_functions: {
					'.disp': {
						"SI"      : function(e, n, f, i, $r, c, data) { return e === "1"; },
						"NO"      : function(e, n, f, i, $r, c, data) { return e === "0"; },
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
	

