<script>
		
	$(document).ready(function() {	
		
		<?php if ($this->session->updatepassword==1) :?>
		swal({title:"", text:"Password aggiornata", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noupdatepassword==1) :?>
		swal({title:"", text:"Errore durante l'aggiornamento. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
	});
		
</script>
	

