<script>
	$(document).ready(function() {
		
		<?php if ($this->session->eliminalibro==1) :?>
		swal({title:"", text:"Libro eliminato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noeliminalibro==1) :?>
		swal({title:"", text:"Errore durante l'eliminazione. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		$("#libri_table").tablesorter({
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
			output: '{startRow}-{endRow} di {totalRows} risultati'
		}); 
	
	});
	
</script>
	

