<script>	

		
	$(document).ready(function() {		

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
	

