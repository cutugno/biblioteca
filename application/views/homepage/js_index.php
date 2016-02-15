<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	
	<?php if ($this->session->nocons==1) :?>
	swal({title:"", text:"Operazione non consentita", timer:1700, showConfirmButton:false, type: "warning"});
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
	

