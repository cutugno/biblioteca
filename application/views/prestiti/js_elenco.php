<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo site_url('js/tablesorter-filter-formatter.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>

<script>
	
		
	$(document).ready(function() {
		
		$("#prestiti_table").tablesorter({
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
	

