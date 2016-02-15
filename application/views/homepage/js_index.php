<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	
	<?php if ($this->session->nocons==1) :?>
	swal({title:"", text:"Operazione non consentita", timer:1700, showConfirmButton:false, type: "warning"});
	<?php endif ?>
		
	$("#showavanzata").click(function(){
		$("#csemplice").hide("blind","",300,function(){
			$("#cavanzata").show("blind","",550);
		});
	});
	
	$("#showsemplice").click(function(){
		$("#cavanzata").hide("blind","",550,function(){
			$("#csemplice").show("blind","",300);
		});
	});
	
</script>
	

