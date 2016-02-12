<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

	$("#showavanzata").click(function(){
		$("#csemplice").hide("blind","",300,function(){
			$("#cavanzata").show("blind","",300);
		});
	});
	
	$("#showsemplice").click(function(){
		$("#cavanzata").hide("blind","",300,function(){
			$("#csemplice").show("blind","",300);
		});
	});
	
</script>
	

