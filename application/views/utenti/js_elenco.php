<script>	

		
	$(document).ready(function() {	
		
		<?php if ($this->session->eliminautente==1) :?>
		swal({title:"", text:"Utente eliminato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noeliminautente==1) :?>
		swal({title:"", text:"Errore durante l'eliminazione. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>	

		$("#utenti_table").tablesorter({
			widthFixed: true, 
			widgets: ["filter"],
			headers: {
				'.noorder': {
					sorter:false
				}
			}
		}) 
		.tablesorterPager({
			container: $(".pagin"),
			output: '{startRow} - {endRow} di {filteredRows} (tot. {totalRows})'  
		}); 
		
	});
	
</script>
	

